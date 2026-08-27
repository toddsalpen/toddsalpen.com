#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Regenerates app/data/albums-fallback.php from the live database.
 * Usage:  php app/bin/export-fallback.php
 *
 * Run this after EVERY content change (new album, corrected URL, reorder), or
 * the safety net drifts away from what the site actually serves. The snapshot
 * is what visitors see whenever the database is unreachable, so a stale
 * snapshot is a silent, slow-motion content bug.
 *
 * The empty-guard below matters: exporting from a temporarily-broken database
 * would otherwise destroy the safety net at exactly the moment it is needed.
 */

PHP_SAPI === 'cli' || exit("CLI only\n");

if (!extension_loaded('phalcon')) {
    exit("phalcon extension is not loaded for this PHP binary — cannot export\n");
}

$appDir = dirname(__DIR__);

/** @var \Phalcon\Di\DiInterface $di */
$di = require $appDir . '/bootstrap.php';

// Read the raw config array rather than the Di's Config object: this script
// only needs one path, and staying on plain arrays keeps it independent of the
// Phalcon config API.
$config       = require $appDir . '/config/config.php';
$fallbackPath = (string) ($config['paths']['fallback'] ?? $appDir . '/data/albums-fallback.php');

try {
    $albums = (new \ToddSalpen\Repository\AlbumRepository($di->get('db')))->allPublished();
} catch (\Throwable $e) {
    exit('Read failed, snapshot left untouched: ' . $e::class . ': ' . $e->getMessage() . "\n");
}

if (count($albums) < 1) {
    exit("Refusing to write an empty snapshot\n");
}

$linkCount = array_sum(array_map(static fn (array $album): int => count($album['links']), $albums));

if (is_file($fallbackPath) && !copy($fallbackPath, $fallbackPath . '.bak')) {
    exit("Could not write the .bak backup, aborting\n");
}

$php = "<?php\n\n"
    . "declare(strict_types=1);\n\n"
    . "defined('TS_APP') || exit;\n\n"
    . "// GENERATED " . date('c') . " by app/bin/export-fallback.php — do not edit by hand.\n"
    . '// Snapshot of ' . count($albums) . ' albums / ' . $linkCount . " links.\n"
    . "// Shape is exactly ToddSalpen\\Repository\\AlbumRepository::allPublished().\n"
    . 'return ' . var_export($albums, true) . ";\n";

if (file_put_contents($fallbackPath, $php) === false) {
    exit('Could not write ' . $fallbackPath . "\n");
}

printf("Wrote %s (%d albums, %d links, %d bytes)\n", $fallbackPath, count($albums), $linkCount, strlen($php));
