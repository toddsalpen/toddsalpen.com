# README-DEPLOY — operator runbook

Everything you need to run, change and troubleshoot the database-driven music
section. This file is **excluded from the FTP sync**, so it never reaches the
server — it lives in the repo for you, not for visitors.

Companion facts:

* Web root **is** the FTP root (`server-dir: /`).
* Deploy fires on a **merged pull request to `main`**. A direct push to `main`
  does **not** deploy.
* Server: Apache + PHP 8.4 + Phalcon 5.19 (C extension) + PDO mysql,
  MariaDB 11.4, database `trinket1_toddsalpen`.
* No Composer, no `vendor/`, no build step. Everything is plain files.

---

## 1. First-time setup (do this once, in this order)

1. **Create the schema.** cPanel → phpMyAdmin → `trinket1_toddsalpen` →
   Import → `app/db/schema.sql`, then Import `app/db/seed.sql`.
   (Or, if you have shell/cron: `php app/bin/migrate.php --seed`.)
2. **Upload the app files.** Merge the PR; the FTP sync does the rest.
3. **Create the log directory by hand.** `app/storage/**` is excluded from the
   sync on purpose (logs must never be overwritten or downloaded), which means
   the FTP action will **not** create `app/storage/logs/`. Create it via cPanel
   File Manager and upload `app/storage/logs/.htaccess` into it. If you skip
   this, nothing breaks — the logger detects the missing directory and falls
   back to PHP's `error_log()`.
4. **Upload the credentials file by hand.** Copy
   `app/config/credentials.sample.php` → `credentials.php`, fill it in, and put
   it in **one** of these places:
   * **Preferred:** `/home/<cpuser>/.toddsalpen/credentials.php`, `chmod 600`,
     placed with cPanel File Manager. Above the web root, invisible to FTP,
     never touched by a deploy.
   * **Fallback:** `app/config/credentials.php`, `chmod 600`. Protected by
     `app/.htaccess`, the root `.htaccess`, and the `defined('TS_APP') || exit`
     line at the top of the file.

   `credentials.php` is in `.gitignore` and in the deploy `exclude:` list.
   **Never commit it.**
5. **Run the doctor.** `php app/bin/doctor.php` — it prints PASS/FAIL for the
   PHP version, the Phalcon extension, PDO mysql, `open_basedir` (which is what
   decides whether the preferred credentials location is usable at all), which
   credential source resolved, connection time, charset, the seed row counts
   (`platforms=8 albums=7 links=56 real_urls=49 placeholders=7`) and the
   fallback snapshot. It never prints the password.
6. **Regenerate the snapshot from the live database.**
   `php app/bin/export-fallback.php`
7. **Only then flip the homepage to the database** — see §2.

---

## 2. The two-step cutover

The rename `index.html` → `index.php` is the one genuinely risky moment: if
`index.php` fails, the homepage fails. So it is deliberately split in two.

**Step 1 — ship `index.php` with the database path disabled.**
`app/config/config.php` is committed with `'music' => ['source' => 'fallback']`.
The new page renders the grid from `app/data/albums-fallback.php`, exercising
the entire render path with zero database dependency. Merge the PR, let the FTP
sync delete `index.html`, and verify §3.

**Step 2 — flip to the database.**
Edit `app/config/config.php` on the server over FTP (or open a one-line PR) and
change `'source' => 'fallback'` to `'source' => 'db'`. Instantly revertible.
This flip **cannot break the page**: if the database misbehaves the renderer
falls back to the snapshot automatically, so the worst case is stale, not blank.

**Rollback at any point:** FTP-upload the original `index.html` and remove the
`DirectoryIndex index.php index.html` line from `/.htaccess`. Keep a copy of the
pre-change `index.html` outside the repo during the cutover window.

**If the site 500s the moment `.htaccess` lands:** delete the two
`php_flag` / `php_value` lines from `/.htaccess`. Some PHP-FPM hosts reject
them. `app/bootstrap.php` sets the same values with `ini_set()`, so removing
them costs nothing.

---

## 3. Post-deploy verification (not optional)

| Request | Expected |
|---|---|
| `GET /` | 200, HTML, 7 album cards |
| `GET /index.html` | **404** — proves the old file was really removed |
| `GET /app/config/credentials.php` | 403 or 404 — **never** 200, never contents |
| `GET /app/db/seed.sql` | 403 or 404 |
| `GET /app/storage/logs/app.log` | 403 or 404 |
| `GET /app/bootstrap.php` | 403 or 404 |

If any of those returns 200, `AllowOverride` is restricted on this host: move
credentials above the web root immediately, or ask the host to enable
`AllowOverride All`.

Content checks:

```
curl -s https://toddsalpen.com/ | grep -c 'album-card'        # 7
curl -s https://toddsalpen.com/ | grep -c 'open.spotify.com'  # 7
# repeat for music.apple.com, music.youtube.com, music.amazon.com,
# tidal.com, link.deezer.com, pandora.com  -> 7 each
curl -s https://toddsalpen.com/ | grep -c 'discography: snapshot'   # 0 once live on db
```

That last one is the check that catches a "working" site which is actually
serving the stale snapshot. With `config.debug = true` the same information
arrives as an `X-TS-Discography: fallback` response header.

---

## 4. Day-to-day content changes (no deploy needed — this is the point)

All of these are phpMyAdmin edits against `trinket1_toddsalpen`.
**After any of them, re-run `php app/bin/export-fallback.php`** so the safety
net does not drift away from reality.

1. **Add an album** — one `INSERT` into `albums` (`slug`, `title`, `genre`,
   `track_count`, `cover_image`, `sort_order`), then 8 rows in `platform_links`.
   Upload the cover art to `assets/img/` (square-ish: the CSS crops to 1:1).
   Leave `cover_alt` NULL and the renderer derives `"{title} Album"`.
2. **Fix a link** — one `UPDATE platform_links SET url = '…' WHERE …`.
3. **Hide an album** — `UPDATE albums SET is_published = 0 WHERE slug = '…'`.
4. **Reorder** — `UPDATE albums SET sort_order = …`. Gaps of 10 leave room to
   insert between two releases without renumbering.
5. **Add a platform** — `INSERT` into `platforms`, then a `platform_links` row
   per album. If the platform count goes above 8, add
   `flex-wrap: wrap; row-gap: .75rem` to `.album-links` in `styles.css` — eight
   36px icons already shrink to fit a 300px card and a ninth will not.
6. **Rotate the DB password** — edit `credentials.php` over FTP or File Manager
   only. Never in git.
7. **Where the logs are** — `app/storage/logs/app.log` and `php-error.log`.
   Not web-readable. If the directory is missing, entries go to the host's
   PHP error log instead.

Durable corrections (for example the two known-wrong URLs in §6) should also go
into a **new numbered migration** under `app/db/migrations/` *and* into
`app/db/seed.sql`, otherwise a future re-seed silently undoes them.

---

## 5. Migrations

```
php app/bin/migrate.php --dry-run     # print the plan, touch nothing
php app/bin/migrate.php               # apply schema-class migrations
php app/bin/migrate.php --seed        # also apply seed-class ones (filename contains "seed")
php app/bin/migrate.php --verbose     # echo each statement
php app/bin/migrate.php --force       # re-apply something already in the ledger
```

* Idempotent by construction: DDL is `IF NOT EXISTS`, data is
  `ON DUPLICATE KEY UPDATE`. DDL is **not** transactional in MariaDB, so a
  half-applied migration is fixed by re-running, not by rolling back.
* Acceptance test: run it twice. The second run must print `0 applied`.
* The ledger lives in the `migrations` table (`version`, `description`,
  `checksum`). Never edit an applied migration — the checksum warning is the
  first sign of divergence.
* The statement splitter depends on a documented invariant, repeated at the top
  of every `.sql` file: **no semicolons inside string literals, no `DELIMITER`
  blocks, no stored routines.** If a future migration needs any of those,
  convert that migration to a PHP file returning `string[]` rather than growing
  an SQL parser.
* phpMyAdmin Import is always a valid escape hatch and does the same thing.

---

## 6. Known data defects, reproduced on purpose

The seed is a faithful snapshot of what the hand-written HTML linked to, so two
copy-paste slips are preserved verbatim rather than silently "fixed":

| Album | Platform | Problem |
|---|---|---|
| The Four Reasons | Pandora | URL points at the Extracorporeal page |
| Arcane Codex | Deezer | URL is byte-identical to Extracorporeal's |

Correcting them needs the real URLs from the owner. Once you have them, it is
one `UPDATE` each — which is exactly the maintenance win this project exists
for. Commented templates are at the bottom of `app/db/seed.sql`.

One intentional deviation from the old markup: `cover_alt` is seeded NULL and
derived as `"{title} Album"`, which fixes four `alt` attributes that named the
wrong album. Invisible to sighted visitors, correct for screen readers.

---

## 7. How the page degrades

A database problem is an operations problem, not a visitor's problem. Every one
of these still returns **HTTP 200** with all 7 albums and all 49 links:

| Failure | Behaviour |
|---|---|
| `credentials.php` missing | config returns `db => null` → snapshot |
| MySQL down / wrong password | connect fails within 3 s → snapshot |
| Tables not created yet | SQL error caught → snapshot |
| Tables created but empty | 0 rows is treated as degraded → snapshot |
| One album has zero links | renders normally with an empty `.album-links` |
| Phalcon extension not enabled | detected before bootstrap → snapshot |
| Snapshot **also** missing | empty grid, `critical` logged; nav/hero/gear/videos/contact/footer intact. This is the floor, and it is still not a white screen. |

Degraded responses carry `<!-- discography: snapshot -->` in the HTML.

---

## 8. Note for whoever completes the rename

`index.php` in this branch contains the full page with only the
`<div class="music-grid">` children replaced by

```php
<?php require __DIR__ . '/app/render/music-grid.php'; ?>
```

`index.html` still exists and **must be deleted in the same commit**, otherwise
the FTP sync will not remove it from the server and `DirectoryIndex` ordering
becomes the only thing keeping the stale page from being served:

```
git rm index.html
```

If you want a diff that shows a pure rename plus the two-line change, do it the
other way round instead — `git mv index.html index.php` and then replace the
seven `.album-card` blocks with the `require` line. The rendered output is
identical either way; only the diff's readability differs.
