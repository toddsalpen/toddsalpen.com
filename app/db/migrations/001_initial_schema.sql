-- =============================================================================
--  001_initial_schema — toddsalpen.com discography schema
-- =============================================================================
--  Applied by app/bin/migrate.php. This is app/db/schema.sql with the
--  ALTER DATABASE statement removed: ALTER DATABASE is not in MySQL's list of
--  statements permitted in prepared statements, and it is not needed when the
--  database was created as utf8mb4 in cPanel. Run schema.sql through
--  phpMyAdmin instead if the database default charset really must change.
--
--  Idempotent: every statement is CREATE ... IF NOT EXISTS or CREATE OR REPLACE.
--  Re-running is harmless, which is why migrate.php does not pretend DDL is
--  transactional in MariaDB.
--
--  STATEMENT-SPLITTER INVARIANT — no semicolons inside string literals or
--  identifiers, no DELIMITER blocks, no stored routines, no /* */ comments.
-- =============================================================================

SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci;
SET SESSION sql_mode = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
SET SESSION foreign_key_checks = 1;


-- -----------------------------------------------------------------------------
-- 1. migrations — applied-migration ledger
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
    KEY `idx_albums_display` (`is_published`, `sort_order`, `id`)
) ENGINE=InnoDB
  ROW_FORMAT=DYNAMIC
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Releases rendered in the #music grid';


-- -----------------------------------------------------------------------------
-- 4. platform_links — album × platform → URL
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
    UNIQUE KEY `uq_links_album_platform` (`album_id`, `platform_slug`),
    KEY `idx_links_album_order` (`album_id`, `is_active`, `sort_order`),
    KEY `idx_links_platform` (`platform_slug`),
    CONSTRAINT `fk_links_album`
        FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`)
        ON DELETE CASCADE ON UPDATE CASCADE,
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
