#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Environment / connectivity preflight.  Usage:  php app/bin/doctor.php
 *
 * Answers, in one second, the questions that otherwise turn into a debugging
 * session on a shared host: is Phalcon enabled for THIS PHP version, does
 * open_basedir allow credentials above the web root, did the seed actually
 * import, is the log directory writable.
 *
 * Never prints the database password. Exits non-zero if any check FAILs.
 */

PHP_SAPI === 'cli' || exit("CLI only\n");

$appDir  = dirname(__DIR__);
$webRoot = dirname($appDir);

$failures = 0;
$passes   = 0;

/** $ok === null renders as [INFO] and is not counted. */
$report = static function (string $label, ?bool $ok, string $detail = '') use (&$failures, &$passes): void {
    printf("%-6s  %-38s  %s\n", $ok === null ? '[INFO]' : ($ok ? '[PASS]' : '[FAIL]'), $label, $detail);

    if ($ok === true) {
        $passes++;
    } elseif ($ok === false) {
        $failures++;
    }
};

echo "toddsalpen.com — environment doctor\n";
echo str_repeat('=', 78) . "\n";

// -- 1..3  runtime ------------------------------------------------------------
$report('PHP >= 8.4', PHP_VERSION_ID >= 80400, PHP_VERSION);

$hasPhalcon = extension_loaded('phalcon');
$report('phalcon extension loaded', $hasPhalcon, $hasPhalcon ? (string) phpversion('phalcon') : 'NOT LOADED for this SAPI/version');

$hasPdoMysql = in_array('mysql', \PDO::getAvailableDrivers(), true);
$report('PDO mysql driver', $hasPdoMysql, implode(', ', \PDO::getAvailableDrivers()));

// -- 4  open_basedir ----------------------------------------------------------
// Printed verbatim: this is what decides Tier-1 vs Tier-2 credential storage.
$openBasedir = (string) ini_get('open_basedir');
$report('open_basedir', null, $openBasedir === '' ? '(not set — Tier 1 is available)' : $openBasedir);

// -- boot ---------------------------------------------------------------------
$di = null;

if ($hasPhalcon) {
    $di = require $appDir . '/bootstrap.php';
} else {
    defined('TS_APP') || define('TS_APP', true);
}

/** @var array $config */
$config = require $appDir . '/config/config.php';

// -- 5  which credential source resolved --------------------------------------
$tier1 = dirname($webRoot) . '/.toddsalpen/credentials.php';
$tier2 = $appDir . '/config/credentials.php';

$envPass = getenv('TS_DB_PASS');

$source = match (true) {
    $envPass !== false && $envPass !== ''    => 'environment (TS_DB_*)',
    @is_readable($tier1)                     => 'Tier 1: ' . $tier1,
    @is_readable($tier2)                     => 'Tier 2: ' . $tier2,
    default                                  => 'NONE — degraded mode',
};

$report('credential source', $config['db'] !== null, $source);
$report('Tier 1 path readable', null, $tier1 . ' => ' . (@is_readable($tier1) ? 'yes' : 'no'));
$report('music.source (cutover switch)', null, (string) ($config['music']['source'] ?? '?'));

if ($config['db'] !== null) {
    $report('credentials shape', null, sprintf(
        'host=%s dbname=%s username=%s password=********',
        (string) ($config['db']['host'] ?? ''),
        (string) ($config['db']['dbname'] ?? ''),
        (string) ($config['db']['username'] ?? ''),
    ));
}

// -- 6..8, 11  database -------------------------------------------------------
if ($di !== null && $config['db'] !== null) {
    $db = null;

    try {
        $started = microtime(true);
        $db      = $di->get('db');
        $version = $db->fetchOne('SELECT VERSION() AS v', \Phalcon\Db\Enum::FETCH_ASSOC);
        $elapsed = (microtime(true) - $started) * 1000;

        $report('connect + SELECT VERSION()', true, sprintf('%s in %.1f ms', (string) ($version['v'] ?? '?'), $elapsed));
    } catch (\Throwable $e) {
        $db = null;
        $report('connect + SELECT VERSION()', false, $e::class . ': ' . $e->getMessage());
    }

    if ($db !== null) {
        try {
            $cs = $db->fetchOne(
                'SELECT @@character_set_database AS cs, @@collation_database AS coll',
                \Phalcon\Db\Enum::FETCH_ASSOC,
            );

            $ok = ($cs['cs'] ?? '') === 'utf8mb4' && ($cs['coll'] ?? '') === 'utf8mb4_unicode_ci';
            $report('database charset/collation', $ok, ($cs['cs'] ?? '?') . ' / ' . ($cs['coll'] ?? '?'));
        } catch (\Throwable $e) {
            $report('database charset/collation', false, $e::class . ': ' . $e->getMessage());
        }

        try {
            $counts = $db->fetchOne(
                'SELECT (SELECT COUNT(*) FROM platforms)                             AS platforms,'
                . '     (SELECT COUNT(*) FROM albums)                                AS albums,'
                . '     (SELECT COUNT(*) FROM platform_links)                        AS links,'
                . '     (SELECT COUNT(*) FROM platform_links WHERE url IS NOT NULL)  AS real_urls,'
                . '     (SELECT COUNT(*) FROM platform_links WHERE url IS NULL)      AS placeholders',
                \Phalcon\Db\Enum::FETCH_ASSOC,
            );

            $expected = ['platforms' => 8, 'albums' => 7, 'links' => 56, 'real_urls' => 49, 'placeholders' => 7];
            $actual   = [];
            $ok       = true;

            foreach ($expected as $key => $want) {
                $got         = (int) ($counts[$key] ?? -1);
                $actual[]    = $key . '=' . $got;
                $ok          = $ok && $got === $want;
            }

            $report('seed row counts', $ok, implode(' ', $actual) . ($ok ? '' : ' (expected platforms=8 albums=7 links=56 real_urls=49 placeholders=7)'));
        } catch (\Throwable $e) {
            $report('seed row counts', false, $e::class . ': ' . $e->getMessage());
        }

        try {
            $albums    = (new \ToddSalpen\Repository\AlbumRepository($db))->allPublished();
            $linkCount = array_sum(array_map(static fn (array $a): int => count($a['links']), $albums));

            $report(
                'AlbumRepository::allPublished()',
                count($albums) === 7 && $linkCount === 56,
                count($albums) . ' albums / ' . $linkCount . ' links',
            );
        } catch (\Throwable $e) {
            $report('AlbumRepository::allPublished()', false, $e::class . ': ' . $e->getMessage());
        }
    }
} else {
    $report('database checks', null, 'skipped (no phalcon and/or no credentials)');
}

// -- 9  log directory ---------------------------------------------------------
$logs = (string) ($config['paths']['logs'] ?? '');
$report(
    'log dir writable',
    $logs !== '' && is_dir($logs) && is_writable($logs),
    $logs . (is_dir($logs) ? '' : ' (missing — create it on the server: app/storage/** is excluded from FTP sync)'),
);

// -- 10  fallback snapshot ----------------------------------------------------
$fallback = (string) ($config['paths']['fallback'] ?? '');
$snapshot = is_file($fallback) ? require $fallback : null;
$report(
    'fallback snapshot',
    is_array($snapshot) && $snapshot !== [],
    is_array($snapshot) ? count($snapshot) . ' albums in ' . $fallback : 'missing or invalid: ' . $fallback,
);

echo str_repeat('=', 78) . "\n";
printf("%d passed, %d failed\n", $passes, $failures);

exit($failures > 0 ? 1 : 0);
