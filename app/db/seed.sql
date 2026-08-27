-- =============================================================================
--  toddsalpen.com — discography seed data
-- =============================================================================
--  Source of truth : index.html @ commit 8080971, lines 158-341 (<div class="music-grid">)
--  Extracted       : 2026-08-27
--  Requires        : schema.sql to have been applied first
--  Target          : MariaDB 11.4, database trinket1_toddsalpen, utf8mb4_unicode_ci
--
--  Contents        : 8 platforms, 7 albums, 56 platform links
--                    (49 real URLs + 7 Beatport placeholders, url = NULL)
--
--  IDEMPOTENCY
--  -----------
--  Every INSERT uses ON DUPLICATE KEY UPDATE keyed on a natural unique index
--  (platforms.slug / albums.slug / platform_links(album_id, platform_slug)).
--  Re-running this file restores the snapshot without creating duplicates.
--
--  !! Re-running RESETS the 56 link URLs to the values below. Any correction
--  !! made directly in the database will be overwritten. Corrections belong in
--  !! a numbered migration under app/db/migrations/ (and, ideally, also here).
--  !! Columns deliberately NOT reset on re-run: albums.artist_name,
--  !! albums.release_date, albums.description — these are hand-curated.
--
--  STATEMENT-SPLITTER INVARIANT
--  ----------------------------
--  app/bin/migrate.php splits this file at each end-of-statement semicolon.
--  This file MUST NOT contain semicolons inside string literals or identifiers,
--  DELIMITER blocks, stored routines, or /* */ comments. All hold today.
--  Preserve them when adding rows.
--
--  ENCODING NOTES
--  --------------
--  * URLs are stored DECODED, with bare "&" separators exactly as they appear
--    in index.html. The renderer emits htmlspecialchars(), producing "&amp;" in
--    the HTML attribute, which browsers decode back to "&". Same URL, different
--    bytes. This is correct, not a regression.
--  * The genre line's separator (U+2022 BULLET) lives in the TEMPLATE, not in
--    the data. `genre` and `track_count` are stored separately and the renderer
--    composes "{genre} • {N} Tracks".
--  * No value below contains a quote, backslash, semicolon or non-ASCII
--    character, so no escaping is required and the simple statement splitter in
--    app/bin/migrate.php is safe. Preserve that property when adding rows.
--
--  VERIFICATION
--  ------------
--  The post-import checks that used to live at the bottom of this file are now
--  in app/bin/doctor.php, which asserts the same expectations and prints
--  PASS/FAIL:  platforms=8, albums=7, links=56, real_urls=49, placeholders=7.
--  Keeping this file free of trailing SELECTs means migrate.php can apply it
--  without collecting stray result sets.
-- =============================================================================

SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci;
SET SESSION sql_mode = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


-- =============================================================================
-- 1. PLATFORMS  (8 rows)
-- =============================================================================
-- title_attr reproduces the live HTML exactly, inconsistencies included:
-- "Spotify" and "Beatport" have no suffix; the other six read "... Music".
-- Beatport has no Font Awesome glyph, so it stores the inline SVG path data.
-- =============================================================================

INSERT INTO `platforms`
    (`slug`, `name`, `title_attr`, `icon_type`, `icon_value`, `icon_viewbox`, `brand_color`, `homepage_url`, `default_sort_order`, `is_active`)
VALUES
    ('spotify',       'Spotify',       'Spotify',       'fontawesome', 'fa-brands fa-spotify', NULL, '#1DB954', 'https://open.spotify.com',   10, 1),
    ('apple-music',   'Apple Music',   'Apple Music',   'fontawesome', 'fa-brands fa-apple',   NULL, '#FA243C', 'https://music.apple.com',    20, 1),
    ('youtube-music', 'YouTube Music', 'YouTube Music', 'fontawesome', 'fa-brands fa-youtube', NULL, '#FF0000', 'https://music.youtube.com',  30, 1),
    ('amazon-music',  'Amazon Music',  'Amazon Music',  'fontawesome', 'fa-brands fa-amazon',  NULL, '#25D1DA', 'https://music.amazon.com',   40, 1),
    ('tidal',         'Tidal',         'Tidal Music',   'fontawesome', 'fa-brands fa-tidal',   NULL, '#000000', 'https://tidal.com',          50, 1),
    ('deezer',        'Deezer',        'Deezer Music',  'fontawesome', 'fa-brands fa-deezer',  NULL, '#A238FF', 'https://www.deezer.com',     60, 1),
    ('pandora',       'Pandora',       'Pandora Music', 'fontawesome', 'fa-brands fa-pandora', NULL, '#3668FF', 'https://www.pandora.com',    70, 1),
    ('beatport',      'Beatport',      'Beatport',      'svg_path',
        'M12.513 2.063c-5.517 0-9.969 4.452-9.969 9.969 0 5.516 4.452 9.968 9.969 9.968 5.516 0 9.968-4.452 9.968-9.968 0-5.517-4.452-9.969-9.968-9.969zm4.36 14.329c-1.656 1.656-4.342 1.656-5.998 0L7.128 12.64l3.747-3.748c1.656-1.656 4.342-1.656 5.998 0 1.656 1.657 1.656 4.343 0 5.999v.001z',
        '0 0 24 24', '#01FF95', 'https://www.beatport.com', 80, 1)
ON DUPLICATE KEY UPDATE
    `name`               = VALUES(`name`),
    `title_attr`         = VALUES(`title_attr`),
    `icon_type`          = VALUES(`icon_type`),
    `icon_value`         = VALUES(`icon_value`),
    `icon_viewbox`       = VALUES(`icon_viewbox`),
    `brand_color`        = VALUES(`brand_color`),
    `homepage_url`       = VALUES(`homepage_url`),
    `default_sort_order` = VALUES(`default_sort_order`),
    `is_active`          = VALUES(`is_active`);


-- =============================================================================
-- 2. ALBUMS  (7 rows, display order 10..70)
-- =============================================================================
-- cover_alt is seeded NULL on purpose: the renderer derives "{title} Album".
-- Four of the seven live alt attributes name the WRONG album; deriving them
-- fixes that. To reproduce the live markup verbatim instead, use the commented
-- block in §2b below.
--
-- artist_name is NULL for every row (= Todd Salpen). Arcane Codex's cover alt
-- in the live HTML reads "Nahuatl Consciousness", which may be a project credit
-- rather than a slip — left NULL pending the owner's confirmation.
-- =============================================================================

INSERT INTO `albums`
    (`slug`, `title`, `artist_name`, `genre`, `track_count`, `subtitle_override`, `cover_image`, `cover_alt`, `release_date`, `description`, `is_published`, `sort_order`)
VALUES
    ('aztlan',           'Aztlan',           NULL, 'Trance',         14, NULL, 'assets/img/aztlan.jpg',          NULL, NULL, NULL, 1, 10),
    ('tlal-ukhu',        'Tlal Ukhu',        NULL, 'Techno',          8, NULL, 'assets/img/tlalukhu.jpg',        NULL, NULL, NULL, 1, 20),
    ('beats-of-beauty',  'Beats of Beauty',  NULL, 'Minimal Techno', 28, NULL, 'assets/img/beatsofbeauty.jpg',   NULL, NULL, NULL, 1, 30),
    ('the-four-reasons', 'The Four Reasons', NULL, 'Synthwave',       4, NULL, 'assets/img/thefourreasons.jpg',  NULL, NULL, NULL, 1, 40),
    ('extracorporeal',   'Extracorporeal',   NULL, 'Trance',         16, NULL, 'assets/img/extracorporeal.jpg',  NULL, NULL, NULL, 1, 50),
    ('arcane-codex',     'Arcane Codex',     NULL, 'Trance',          9, NULL, 'assets/img/arcanecodex.jpg',     NULL, NULL, NULL, 1, 60),
    ('beats-of-fashion', 'Beats of Fashion', NULL, 'Minimal Techno', 22, NULL, 'assets/img/beatsoffashion.jpg',  NULL, NULL, NULL, 1, 70)
ON DUPLICATE KEY UPDATE
    `title`             = VALUES(`title`),
    `genre`             = VALUES(`genre`),
    `track_count`       = VALUES(`track_count`),
    `subtitle_override` = VALUES(`subtitle_override`),
    `cover_image`       = VALUES(`cover_image`),
    `cover_alt`         = VALUES(`cover_alt`),
    `is_published`      = VALUES(`is_published`),
    `sort_order`        = VALUES(`sort_order`);
    -- NOT reset on re-run: artist_name, release_date, description.


-- -----------------------------------------------------------------------------
-- 2b. OPTIONAL — reproduce the live (buggy) alt attributes verbatim
-- -----------------------------------------------------------------------------
-- Uncomment ONLY if a byte-for-byte snapshot of the current HTML is required and
-- the four wrong alt texts are acceptable. Leaving this commented is the
-- recommended default.
-- -----------------------------------------------------------------------------
-- UPDATE `albums` SET `cover_alt` = 'Aztlan Album'           WHERE `slug` = 'aztlan';
-- UPDATE `albums` SET `cover_alt` = 'Beats of Beauty Album'  WHERE `slug` = 'tlal-ukhu';         -- wrong in source
-- UPDATE `albums` SET `cover_alt` = 'The Four Reasons Album' WHERE `slug` = 'beats-of-beauty';   -- wrong in source
-- UPDATE `albums` SET `cover_alt` = 'Extracorporeal Album'   WHERE `slug` = 'the-four-reasons';  -- wrong in source
-- UPDATE `albums` SET `cover_alt` = 'Extracorporeal Album'   WHERE `slug` = 'extracorporeal';
-- UPDATE `albums` SET `cover_alt` = 'Nahuatl Consciousness'  WHERE `slug` = 'arcane-codex';      -- off-pattern
-- UPDATE `albums` SET `cover_alt` = 'The Four Reasons Album' WHERE `slug` = 'beats-of-fashion';  -- wrong in source


-- =============================================================================
-- 3. PLATFORM LINKS  (56 rows = 7 albums × 8 platforms)
-- =============================================================================
-- album_id is resolved through a session variable per album so the INSERTs stay
-- readable and stay correct on re-run (LAST_INSERT_ID() is unreliable after
-- ON DUPLICATE KEY UPDATE, so we look the id up by slug instead).
--
-- Every Beatport row carries url = NULL: the live site uses href="#" with no
-- destination. NULL is the schema's placeholder representation; the renderer
-- turns it back into href="#".
--
-- Link order (sort_order 10..80) is identical on all seven cards:
--   Spotify, Apple Music, YouTube Music, Amazon Music, Tidal, Deezer, Pandora, Beatport
-- =============================================================================

-- -----------------------------------------------------------------------------
-- 3.1  Aztlan — Trance • 14 Tracks
-- -----------------------------------------------------------------------------
SET @album_id := (SELECT `id` FROM `albums` WHERE `slug` = 'aztlan');

INSERT INTO `platform_links` (`album_id`, `platform_slug`, `url`, `sort_order`, `is_active`) VALUES
    (@album_id, 'spotify',       'https://open.spotify.com/album/5IjX0Qn6Ux2qvsVWD1Q66o?si=4eD8CASaQN6Xcr9ZnfMqpg', 10, 1),
    (@album_id, 'apple-music',   'https://music.apple.com/us/album/aztlan/1864102344', 20, 1),
    (@album_id, 'youtube-music', 'https://music.youtube.com/playlist?list=OLAK5uy_nzasnSk0QjSB1zqYiKiwiD4a1la6TpsIo&si=GsJsw8udFcdJWo0F', 30, 1),
    (@album_id, 'amazon-music',  'https://music.amazon.com/albums/B0GCJHJGJS?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_Z6If8PvNOZiAGfSwBvLhZlvrt', 40, 1),
    (@album_id, 'tidal',         'https://tidal.com/album/484740515/u', 50, 1),
    (@album_id, 'deezer',        'https://link.deezer.com/s/32fIK4CINpVSGwsQwQgKD', 60, 1),
    (@album_id, 'pandora',       'https://www.pandora.com/artist/todd-salpen/aztlan/ALffPPXJ5j5wh39?part=ug-desktop&corr=184542033753428470', 70, 1),
    (@album_id, 'beatport',      NULL, 80, 1)
ON DUPLICATE KEY UPDATE
    `url` = VALUES(`url`), `sort_order` = VALUES(`sort_order`), `is_active` = VALUES(`is_active`);


-- -----------------------------------------------------------------------------
-- 3.2  Tlal Ukhu — Techno • 8 Tracks
-- -----------------------------------------------------------------------------
SET @album_id := (SELECT `id` FROM `albums` WHERE `slug` = 'tlal-ukhu');

INSERT INTO `platform_links` (`album_id`, `platform_slug`, `url`, `sort_order`, `is_active`) VALUES
    (@album_id, 'spotify',       'https://open.spotify.com/album/0HndbGy4cCE3UlmJEetLdm?si=oz5qgirTTtyduHcTFekUow', 10, 1),
    (@album_id, 'apple-music',   'https://music.apple.com/us/album/tlal-ukhu/1866851547', 20, 1),
    (@album_id, 'youtube-music', 'https://music.youtube.com/playlist?list=OLAK5uy_lQQjO5efBI9j0ZvjWS8EDis2_GjLwtv5o&si=aj7gNlUEO5YYkk8V', 30, 1),
    (@album_id, 'amazon-music',  'https://music.amazon.com/albums/B0GF8HK75K?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_Q4ip50FlqcjEbBAkh3oALO7Et', 40, 1),
    (@album_id, 'tidal',         'https://tidal.com/album/487522496/u', 50, 1),
    (@album_id, 'deezer',        'https://link.deezer.com/s/32fJBwkhDI8CDnuv6VshE', 60, 1),
    (@album_id, 'pandora',       'https://www.pandora.com/artist/todd-salpen/tlal-ukhu/AL5btkcK6kbbnpg?part=ug-desktop&corr=184542033753428470', 70, 1),
    (@album_id, 'beatport',      NULL, 80, 1)
ON DUPLICATE KEY UPDATE
    `url` = VALUES(`url`), `sort_order` = VALUES(`sort_order`), `is_active` = VALUES(`is_active`);


-- -----------------------------------------------------------------------------
-- 3.3  Beats of Beauty — Minimal Techno • 28 Tracks
-- -----------------------------------------------------------------------------
SET @album_id := (SELECT `id` FROM `albums` WHERE `slug` = 'beats-of-beauty');

INSERT INTO `platform_links` (`album_id`, `platform_slug`, `url`, `sort_order`, `is_active`) VALUES
    (@album_id, 'spotify',       'https://open.spotify.com/album/5Odec5ESR3NQm0uL6QcQhJ?si=jMemx8huTeGdyWxi8B4jLw', 10, 1),
    (@album_id, 'apple-music',   'https://music.apple.com/us/album/beats-of-beauty/1867772310', 20, 1),
    (@album_id, 'youtube-music', 'https://music.youtube.com/playlist?list=OLAK5uy_kCY55OLnnG43j4BhsMw6RU8vGzTDgwNlw&si=XCub-rAhrhbB3Qvl', 30, 1),
    (@album_id, 'amazon-music',  'https://music.amazon.com/albums/B0GFX12LND?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_4RoQpc0OKuWdEvXIhWCNse1N8', 40, 1),
    (@album_id, 'tidal',         'https://tidal.com/album/488418096/u', 50, 1),
    (@album_id, 'deezer',        'https://link.deezer.com/s/32fJC4t9XHpRs5Q3WpYz8', 60, 1),
    (@album_id, 'pandora',       'https://www.pandora.com/artist/todd-salpen/beats-of-beauty/ALcXtfkt769ZK52?part=ug-desktop&corr=184542033753428470', 70, 1),
    (@album_id, 'beatport',      NULL, 80, 1)
ON DUPLICATE KEY UPDATE
    `url` = VALUES(`url`), `sort_order` = VALUES(`sort_order`), `is_active` = VALUES(`is_active`);


-- -----------------------------------------------------------------------------
-- 3.4  The Four Reasons — Synthwave • 4 Tracks
-- -----------------------------------------------------------------------------
SET @album_id := (SELECT `id` FROM `albums` WHERE `slug` = 'the-four-reasons');

INSERT INTO `platform_links` (`album_id`, `platform_slug`, `url`, `sort_order`, `is_active`) VALUES
    (@album_id, 'spotify',       'https://open.spotify.com/album/1hje65QfvnuABev4pqXjw5?si=kAOpLCiMSaWCQk-FI7JqLQ', 10, 1),
    (@album_id, 'apple-music',   'https://music.apple.com/us/album/the-four-reasons-ep/1867701900', 20, 1),
    (@album_id, 'youtube-music', 'https://music.youtube.com/playlist?list=OLAK5uy_kqGNOMEsWXwcagY-3dbnD6bQHL1-MHKrk&si=h8YI2vv4xHD24teZ', 30, 1),
    (@album_id, 'amazon-music',  'https://music.amazon.com/albums/B0GFVMZX4K?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_geyHWvN8NkcklerHHhAC8UKw5', 40, 1),
    (@album_id, 'tidal',         'https://tidal.com/album/488361401/u', 50, 1),
    (@album_id, 'deezer',        'https://link.deezer.com/s/32fJCQleur9hoRhjvmLoC', 60, 1),
    -- FIXME(data): this Pandora URL points at EXTRACORPOREAL, not The Four Reasons.
    -- Reproduced verbatim from the hand-written HTML. Correct it in a numbered
    -- migration once the owner supplies the real URL, and update this file too.
    (@album_id, 'pandora',       'https://www.pandora.com/artist/todd-salpen/extracorporeal/AL5x9pKZ4wgmxdw?part=ug-desktop&corr=184542033753428470', 70, 1),
    (@album_id, 'beatport',      NULL, 80, 1)
ON DUPLICATE KEY UPDATE
    `url` = VALUES(`url`), `sort_order` = VALUES(`sort_order`), `is_active` = VALUES(`is_active`);


-- -----------------------------------------------------------------------------
-- 3.5  Extracorporeal — Trance • 16 Tracks
-- -----------------------------------------------------------------------------
SET @album_id := (SELECT `id` FROM `albums` WHERE `slug` = 'extracorporeal');

INSERT INTO `platform_links` (`album_id`, `platform_slug`, `url`, `sort_order`, `is_active`) VALUES
    (@album_id, 'spotify',       'https://open.spotify.com/album/3LP6EoLwc59oxF7fHTEArW?si=zuNwNGTYQkqG53kmPoTMIw', 10, 1),
    (@album_id, 'apple-music',   'https://music.apple.com/us/album/extracorporeal/1868018727', 20, 1),
    (@album_id, 'youtube-music', 'https://music.youtube.com/playlist?list=OLAK5uy_mjc4VV4Me93vcTftEYO6r0M_tKXf9lVE8&si=X770hPfwj9NRm9ej', 30, 1),
    (@album_id, 'amazon-music',  'https://music.amazon.com/albums/B0GG4VLDWW?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_ncjJuH9pSr9L0uQbDQvn2nGau', 40, 1),
    (@album_id, 'tidal',         'https://tidal.com/album/488695720/u', 50, 1),
    (@album_id, 'deezer',        'https://link.deezer.com/s/32fJDndJSIWZp204d21Yv', 60, 1),
    (@album_id, 'pandora',       'https://www.pandora.com/artist/todd-salpen/extracorporeal/AL5x9pKZ4wgmxdw?part=ug-desktop&corr=184542033753428470', 70, 1),
    (@album_id, 'beatport',      NULL, 80, 1)
ON DUPLICATE KEY UPDATE
    `url` = VALUES(`url`), `sort_order` = VALUES(`sort_order`), `is_active` = VALUES(`is_active`);


-- -----------------------------------------------------------------------------
-- 3.6  Arcane Codex — Trance • 9 Tracks
-- -----------------------------------------------------------------------------
SET @album_id := (SELECT `id` FROM `albums` WHERE `slug` = 'arcane-codex');

INSERT INTO `platform_links` (`album_id`, `platform_slug`, `url`, `sort_order`, `is_active`) VALUES
    (@album_id, 'spotify',       'https://open.spotify.com/album/42I3u1438yVwFdn663wtAh?si=9NWnQ9pQQ-6pdxPCb8MzOA', 10, 1),
    (@album_id, 'apple-music',   'https://music.apple.com/us/album/arcane-codex/1868672590', 20, 1),
    (@album_id, 'youtube-music', 'https://music.youtube.com/playlist?list=OLAK5uy_llBEcqOrXr6Zl4tRf5zL1JlbJpTN6i7UY&si=qpObixxXJrCmvDCL', 30, 1),
    (@album_id, 'amazon-music',  'https://music.amazon.com/albums/B0GGHP8Y57?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_YfndTuppXgTsIt6AhJb7EzpzO', 40, 1),
    (@album_id, 'tidal',         'https://tidal.com/album/489319254/u', 50, 1),
    -- FIXME(data): identical to Extracorporeal's Deezer link (§3.5). Almost
    -- certainly a copy-paste slip. Reproduced verbatim from the source HTML.
    (@album_id, 'deezer',        'https://link.deezer.com/s/32fJDndJSIWZp204d21Yv', 60, 1),
    (@album_id, 'pandora',       'https://www.pandora.com/artist/todd-salpen/arcane-codex/AL2PdwXdVw4hpv6?part=ug-desktop&corr=184542033753428470', 70, 1),
    (@album_id, 'beatport',      NULL, 80, 1)
ON DUPLICATE KEY UPDATE
    `url` = VALUES(`url`), `sort_order` = VALUES(`sort_order`), `is_active` = VALUES(`is_active`);


-- -----------------------------------------------------------------------------
-- 3.7  Beats of Fashion — Minimal Techno • 22 Tracks
-- -----------------------------------------------------------------------------
SET @album_id := (SELECT `id` FROM `albums` WHERE `slug` = 'beats-of-fashion');

INSERT INTO `platform_links` (`album_id`, `platform_slug`, `url`, `sort_order`, `is_active`) VALUES
    (@album_id, 'spotify',       'https://open.spotify.com/album/3XRiGAZCXz6J9gKS2qvXVn?si=_-KGdwcAQ0WaTzyvTgjD0Q', 10, 1),
    (@album_id, 'apple-music',   'https://music.apple.com/us/album/beats-of-fashion/1870184796', 20, 1),
    (@album_id, 'youtube-music', 'https://music.youtube.com/playlist?list=OLAK5uy_k5q-0ExXcfWzB3v6rinrs0fI6zOTjblcI&si=THYthaG-z8sjvDUj', 30, 1),
    (@album_id, 'amazon-music',  'https://music.amazon.com/albums/B0GHN2Z2GM?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_go7loOYVXqxZZDUtvyCeVu0Cl', 40, 1),
    (@album_id, 'tidal',         'https://tidal.com/album/490692378/u', 50, 1),
    (@album_id, 'deezer',        'https://link.deezer.com/s/32fJE9Lrhnp1l3euXRpNM', 60, 1),
    (@album_id, 'pandora',       'https://www.pandora.com/artist/todd-salpen/beats-of-fashion/ALn6fkt4tzwVt29?part=ug-desktop&corr=184542033753428470', 70, 1),
    (@album_id, 'beatport',      NULL, 80, 1)
ON DUPLICATE KEY UPDATE
    `url` = VALUES(`url`), `sort_order` = VALUES(`sort_order`), `is_active` = VALUES(`is_active`);


-- =============================================================================
-- 4. OPTIONAL DATA CORRECTIONS  (do NOT run blindly — owner confirmation needed)
-- =============================================================================
-- Kept commented so the seed stays a faithful snapshot. When the owner supplies
-- the correct URLs, move these into a numbered migration under
-- app/db/migrations/ AND update §3 above, so a re-seed does not undo them.
-- =============================================================================

-- -- Correct The Four Reasons' Pandora link
-- UPDATE `platform_links` pl
--   JOIN `albums` a ON a.`id` = pl.`album_id`
--    SET pl.`url` = 'https://www.pandora.com/artist/todd-salpen/the-four-reasons/<REAL_ID>?part=ug-desktop'
--  WHERE a.`slug` = 'the-four-reasons' AND pl.`platform_slug` = 'pandora';

-- -- Correct Arcane Codex's Deezer link
-- UPDATE `platform_links` pl
--   JOIN `albums` a ON a.`id` = pl.`album_id`
--    SET pl.`url` = 'https://link.deezer.com/s/<REAL_TOKEN>'
--  WHERE a.`slug` = 'arcane-codex' AND pl.`platform_slug` = 'deezer';

-- -- Fill in the Beatport placeholders once the releases are live there
-- UPDATE `platform_links` pl
--   JOIN `albums` a ON a.`id` = pl.`album_id`
--    SET pl.`url` = 'https://www.beatport.com/release/<slug>/<id>'
--  WHERE a.`slug` = 'aztlan' AND pl.`platform_slug` = 'beatport';

-- -- Credit Arcane Codex to the side project, if that is what the alt text meant
-- UPDATE `albums` SET `artist_name` = 'Nahuatl Consciousness' WHERE `slug` = 'arcane-codex';

-- -- Strip share-tracking parameters from every stored URL.
-- -- Behaviour change: run only if the owner wants it.
-- UPDATE `platform_links` SET `url` = SUBSTRING_INDEX(`url`, '?si=', 1)
--  WHERE `url` LIKE '%?si=%';
