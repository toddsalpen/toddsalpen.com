<?php

declare(strict_types=1);

defined('TS_APP') || exit;

/**
 * TEMPLATE ONLY — this file is committed, credentials.php is NOT.
 *
 * Copy to credentials.php and fill in. NEVER commit credentials.php, and never
 * put real values in this file.
 *
 * Preferred location (above the web root, invisible to the FTP account):
 *     /home/<cpuser>/.toddsalpen/credentials.php     chmod 600
 * Fallback location (inside the web root, behind app/.htaccess):
 *     app/config/credentials.php                     chmod 600
 *
 * A third option needs no file at all: if the host exposes environment
 * variables, set TS_DB_HOST / TS_DB_NAME / TS_DB_USER / TS_DB_PASS and
 * config.php will use those in preference to any file.
 *
 * Run `php app/bin/doctor.php` to see which source actually resolved and
 * whether the above-web-root path is readable under this host's open_basedir.
 */
return [
    'host'     => 'localhost',              // cPanel: unix socket. Use 127.0.0.1 only if that fails.
    'dbname'   => 'trinket1_toddsalpen',
    'username' => 'trinket1_XXXXXXXX',
    'password' => 'REPLACE_ME',
    'charset'  => 'utf8mb4',
];
