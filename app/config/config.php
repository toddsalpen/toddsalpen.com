<?php

declare(strict_types=1);

defined('TS_APP') || exit;

/**
 * Returns one plain array. MUST NEVER THROW.
 *
 * A missing or unreadable credentials file yields 'db' => null, which the
 * renderer treats as degraded mode: the page still renders all albums from
 * app/data/albums-fallback.php. A fresh deploy with no credentials on the
 * server must produce a working page, not a fatal error.
 *
 * Credential resolution order:
 *   1. getenv('TS_DB_*')                            — if the host supports it
 *   2. <parent of web root>/.toddsalpen/credentials.php   (Tier 1, preferred)
 *   3. __DIR__ . '/credentials.php'                       (Tier 2, fallback)
 *   4. none found -> null -> degraded mode
 *
 * The Tier-1 probe silently no-ops when open_basedir forbids the path:
 * is_readable() returns false rather than throwing. The @ suppressors keep the
 * resulting open_basedir warnings out of the error log on every request.
 */

$root = dirname(__DIR__, 2);   // web root  (app/config -> app -> /)
$app  = dirname(__DIR__);      // /app

/** 1) environment variables, if the host supports them */
$db = null;

$envPass = getenv('TS_DB_PASS');
if ($envPass !== false && $envPass !== '') {
    $db = [
        'host'     => getenv('TS_DB_HOST') ?: 'localhost',
        'dbname'   => getenv('TS_DB_NAME') ?: 'trinket1_toddsalpen',
        'username' => getenv('TS_DB_USER') ?: '',
        'password' => $envPass,
        'charset'  => 'utf8mb4',
    ];
}

/** 2) above the web root (preferred), 3) inside app/config (fallback) */
if ($db === null) {
    $candidates = [
        dirname($root) . '/.toddsalpen/credentials.php',   // Tier 1
        __DIR__ . '/credentials.php',                      // Tier 2
    ];

    foreach ($candidates as $candidate) {
        if (!@is_file($candidate) || !@is_readable($candidate)) {
            continue;
        }

        $loaded = require $candidate;

        if (is_array($loaded) && ($loaded['password'] ?? '') !== '') {
            $db = $loaded;
            break;
        }
    }
}

return [
    // true => X-TS-Discography response header when the grid is degraded.
    'debug' => false,

    // null => no credentials resolved => degraded mode, never a fatal.
    'db' => $db,

    'music' => [
        // 'db' | 'fallback'
        //
        // COMMITTED DEFAULT IS 'fallback' ON PURPOSE. Cutover step 1 ships
        // index.php rendering the snapshot, which exercises the whole render
        // path with zero database dependency. Flip to 'db' by hand (FTP edit,
        // no PR needed) only after app/bin/doctor.php passes on the server.
        'source' => 'fallback',
    ],

    'paths' => [
        'root'     => $root,
        'app'      => $app,
        'views'    => $app . '/views',
        'fallback' => $app . '/data/albums-fallback.php',
        'logs'     => $app . '/storage/logs',
    ],
];
