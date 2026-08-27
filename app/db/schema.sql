-- =============================================================================
--  toddsalpen.com — discography schema
-- =============================================================================
--  Target      : MariaDB 11.4
--  Database    : trinket1_toddsalpen  (must already exist; created via cPanel)
--  Charset     : utf8mb4 / utf8mb4_unicode_ci   (album genre lines contain U+2022 "•")
--  Engine      : InnoDB, ROW_FORMAT=DYNAMIC
--  Idempotent  : YES — every statement is CREATE ... IF NOT EXISTS or a no-op ALTER.
--                Safe to re-run against an already-migrated database.
--
--  How to run
--  ----------
--    Preferred (first-time setup, zero risk):
--        cPanel → phpMyAdmin → select trinket1_toddsalpen → Import → schema.sql
--    Repeatable (CLI, if shell/cron is available):
--        php /home/<cpuser>/public_html/app/bin/migrate.php
--    Never expose this file over HTTP. It lives under /app/db/ which is
--    denied by /app/.htaccess.
--
--  Statement-splitter invariant
--  ----------------------------
--    app/bin/migrate.php splits this file at each end-of-statement semicolon.
--    To keep that ~40-line splitter honest, this file MUST NOT contain:
--      * semicolons inside string literals or identifiers
--      * DELIMITER blocks, stored procedures, triggers, or functions
--    Both hold today. Preserve them.
--
--  Table map
--  ---------
--    migrations       — applied-migration ledger (used by app/bin/migrate.php)
--    platforms        — reference table: one row per streaming service
--    albums           — one row per release shown in the #music grid
--    platform_links   — join table: album × platform → URL (NULL = placeholder)
--    v_album_links    — optional read view for phpMyAdmin / ad-hoc inspection
-- =============================================================================

SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci;
SET SESSION sql_mode = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
SET SESSION foreign_key_checks = 1;

-- Optional. Only succeeds if the connecting user holds ALTER on the schema
-- (it does — ALL PRIVILEGES). Harmless to comment out if your host objects.
-- NOTE: this statement is deliberately absent from migrations/001_initial_schema.sql,
-- because ALTER DATABASE is not in MySQL's list of preparable statements.
ALTER DATABASE `trinket1_toddsalpen`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;


-- -----------------------------------------------------------------------------
-- 1. migrations — applied-migration ledger
-- -----------------------------------------------------------------------------
-- Written by app/bin/migrate.php after each .sql file in app/db/migrations/ is
-- applied successfully. `checksum` is sha256(file contents) so a silently edited
-- migration can be detected; migrate.php warns rather than failing, because
-- re-running an IF NOT EXISTS migration is harmless.
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `migrations` (
    `id`          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `version`     VARCHAR(64)     NOT NULL COMMENT 'Filename stem, e.g. 001_initial_schema',
    `description` VARCHAR(255)        NULL DEFAULT NULL,
    `checksum`    CHAR(64)            NULL DEFAULT NULL COMMENT 'sha256 hex of the migration file',
    `applied_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_migrations_version` (`version`)
) ENGINE=InnoDB
  ROW_FORMAT=DYNAMIC
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Applied migration ledger for app/bin/migrate.php';


-- -----------------------------------------------------------------------------
-- 2. platforms — streaming-service reference data
-- -----------------------------------------------------------------------------
-- Natural primary key on `slug`: it is short, immutable, human-readable, appears
-- in URLs and JSON payloads, and lets platform_links carry a self-describing FK
-- without an extra lookup. 8 rows now, realistically <30 ever.
--
-- icon_type / icon_value split exists because Beatport has no Font Awesome glyph
-- and must be rendered as an inline <svg>. We store ONLY the SVG path `d`
-- attribute, never raw markup — so no HTML from the database is ever echoed
-- unescaped. The renderer validates icon_value against a strict allowlist regex
-- before interpolating it (see app/src/ToddSalpen/Support/IconRenderer.php).
--
-- title_attr is stored separately from `name` because the live HTML is
-- inconsistent: "Spotify" and "Beatport" have no suffix, the other six read
-- "... Music". Storing the literal attribute keeps output byte-identical.
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `platforms` (
    `slug`               VARCHAR(32)                          NOT NULL COMMENT 'Stable identifier, e.g. apple-music',
    `name`               VARCHAR(64)                          NOT NULL COMMENT 'Canonical display name',
    `title_attr`         VARCHAR(64)                          NOT NULL COMMENT 'Literal value for the <a title="..."> attribute',
    `icon_type`          ENUM('fontawesome','svg_path')       NOT NULL DEFAULT 'fontawesome',
    `icon_value`         VARCHAR(4096)                        NOT NULL COMMENT 'FA class list, or the SVG <path d="..."> data',
    `icon_viewbox`       VARCHAR(32)                              NULL DEFAULT NULL COMMENT 'Only for icon_type=svg_path, e.g. "0 0 24 24"',
    `brand_color`        CHAR(7)                                  NULL DEFAULT NULL COMMENT 'Hex incl. leading #, for future theming',
    `homepage_url`       VARCHAR(255)                             NULL DEFAULT NULL,
    `default_sort_order` SMALLINT UNSIGNED                    NOT NULL DEFAULT 100 COMMENT 'Fallback ordering when platform_links.sort_order IS NULL',
    `is_active`          TINYINT(1) UNSIGNED                  NOT NULL DEFAULT 1 COMMENT '0 hides this platform site-wide',
    `created_at`         TIMESTAMP                            NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`         TIMESTAMP                            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`slug`),
    KEY `idx_platforms_display` (`is_active`, `default_sort_order`)
) ENGINE=InnoDB
  ROW_FORMAT=DYNAMIC
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Streaming platforms and their icon/render metadata';


-- -----------------------------------------------------------------------------
-- 3. albums — one row per release in the #music grid
-- -----------------------------------------------------------------------------
-- Nullability rationale:
--   artist_name       NULL = the site owner (Todd Salpen). Set only for side
--                     projects such as "Nahuatl Consciousness".
--   track_count       NULL = omit the "• N Tracks" fragment entirely (singles,
--                     unreleased). Not 0 — 0 would be a real, wrong count.
--   subtitle_override NULL = render "{genre} • {N} Tracks". Set to bypass that
--                     template for one-off wording without schema churn.
--   cover_alt         NULL = renderer derives "{title} Album". This is the fix
--                     for the four mismatched alts in the hand-written HTML.
--   release_date /
--   description       Unused in phase 1. Present now so the optional
--                     /album/{slug} detail route needs no later migration.
--
-- sort_order uses gaps of 10 so a release can be inserted between two existing
-- ones with a single UPDATE and no renumbering.
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `albums` (
    `id`                INT UNSIGNED        NOT NULL AUTO_INCREMENT,
    `slug`              VARCHAR(96)         NOT NULL COMMENT 'URL-safe identifier, also the seed idempotency key',
    `title`             VARCHAR(160)        NOT NULL,
    `artist_name`       VARCHAR(120)            NULL DEFAULT NULL COMMENT 'NULL = Todd Salpen',
    `genre`             VARCHAR(64)         NOT NULL COMMENT 'e.g. Trance, Minimal Techno',
    `track_count`       SMALLINT UNSIGNED       NULL DEFAULT NULL COMMENT 'NULL = omit the track fragment',
    `subtitle_override` VARCHAR(160)            NULL DEFAULT NULL COMMENT 'Replaces the whole "{genre} • {N} Tracks" line',
    `cover_image`       VARCHAR(255)        NOT NULL COMMENT 'Web-root-relative, e.g. assets/img/aztlan.jpg',
    `cover_alt`         VARCHAR(255)            NULL DEFAULT NULL COMMENT 'NULL = derive "{title} Album"',
    `release_date`      DATE                    NULL DEFAULT NULL COMMENT 'Reserved for phase 2',
    `description`       TEXT                    NULL DEFAULT NULL COMMENT 'Reserved for phase 2 (/album/{slug})',
    `is_published`      TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 = staged, hidden from the grid',
    `sort_order`        SMALLINT UNSIGNED   NOT NULL DEFAULT 1000 COMMENT 'Ascending. Gaps of 10.',
    `created_at`        TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`        TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_albums_slug` (`slug`),
    -- Covers the grid query's WHERE + ORDER BY without a filesort.
    KEY `idx_albums_display` (`is_published`, `sort_order`, `id`)
) ENGINE=InnoDB
  ROW_FORMAT=DYNAMIC
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Releases rendered in the #music grid';


-- -----------------------------------------------------------------------------
-- 4. platform_links — album × platform → URL
-- -----------------------------------------------------------------------------
-- url IS NULL is the canonical representation of a placeholder: the site has no
-- URL for this platform yet (all 7 Beatport rows). The renderer emits href="#",
-- which is exactly what the current static HTML does, and which assets/js/
-- scripts.js already short-circuits in its smooth-scroll handler.
--   NULL was chosen over the literal string '#' so that "has a real link" is a
--   plain IS NOT NULL test rather than a magic-string comparison.
--
-- sort_order IS NULL means "inherit platforms.default_sort_order" — so the
-- global platform order is defined once, and only genuine per-album exceptions
-- need a value. All 56 seeded rows currently set it explicitly anyway, which
-- keeps the seed readable and self-documenting.
--
-- VARCHAR(1024): longest real URL in the dataset is 132 chars (Amazon Music).
-- 1024 is ample and stays comfortably inside the InnoDB DYNAMIC row limit while
-- remaining indexable if that is ever needed.
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `platform_links` (
    `id`            INT UNSIGNED        NOT NULL AUTO_INCREMENT,
    `album_id`      INT UNSIGNED        NOT NULL,
    `platform_slug` VARCHAR(32)         NOT NULL,
    `url`           VARCHAR(1024)           NULL DEFAULT NULL COMMENT 'NULL = placeholder, renders href="#"',
    `sort_order`    SMALLINT UNSIGNED       NULL DEFAULT NULL COMMENT 'NULL = inherit platforms.default_sort_order',
    `is_active`     TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 hides this one link without deleting it',
    `created_at`    TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    -- One link per platform per album. This is also the seed's idempotency key
    -- (INSERT ... ON DUPLICATE KEY UPDATE).
    UNIQUE KEY `uq_links_album_platform` (`album_id`, `platform_slug`),
    KEY `idx_links_album_order` (`album_id`, `is_active`, `sort_order`),
    KEY `idx_links_platform` (`platform_slug`),
    CONSTRAINT `fk_links_album`
        FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    -- RESTRICT, not CASCADE: deleting a platform that still has links should be
    -- a loud error, not a silent mass delete. Deactivate via is_active instead.
    CONSTRAINT `fk_links_platform`
        FOREIGN KEY (`platform_slug`) REFERENCES `platforms` (`slug`)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB
  ROW_FORMAT=DYNAMIC
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Per-album streaming links, NULL url renders as the "#" placeholder';


-- -----------------------------------------------------------------------------
-- 5. v_album_links — optional convenience view
-- -----------------------------------------------------------------------------
-- Not used by the application (AlbumRepository issues its own single JOIN so the
-- exact projection stays visible in the repository). Provided for phpMyAdmin
-- browsing and for hand-checking the seed. Drop it if you prefer a view-free
-- schema — nothing depends on it.
-- -----------------------------------------------------------------------------
CREATE OR REPLACE VIEW `v_album_links` AS
SELECT
    a.`sort_order`                                        AS `album_order`,
    a.`slug`                                              AS `album_slug`,
    a.`title`                                             AS `album_title`,
    a.`genre`,
    a.`track_count`,
    a.`is_published`,
    COALESCE(pl.`sort_order`, p.`default_sort_order`)     AS `link_order`,
    p.`slug`                                              AS `platform_slug`,
    p.`title_attr`,
    pl.`url`,
    pl.`is_active`                                        AS `link_active`
FROM `albums` a
LEFT JOIN `platform_links` pl ON pl.`album_id`      = a.`id`
LEFT JOIN `platforms`      p  ON p.`slug`           = pl.`platform_slug`
ORDER BY a.`sort_order`, a.`id`, `link_order`, pl.`id`;
