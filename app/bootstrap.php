<?php

declare(strict_types=1);

/**
 * toddsalpen.com — application bootstrap.
 *
 * Responsibilities, in order:
 *   1. guard against double-inclusion, define TS_APP (the "reached through the
 *      application" marker every other file under app/ asserts),
 *   2. harden the ini settings that keep PHP errors away from visitors,
 *   3. install error/exception handlers that log and emit nothing,
 *   4. register a PSR-4 loader for the ToddSalpen\ namespace (no Composer),
 *   5. build a LAZY Di container and return it.
 *
 * @return \Phalcon\Di\DiInterface
 *
 * This file instantiates Phalcon classes immediately, so every caller MUST
 * check extension_loaded('phalcon') BEFORE including it. app/render/music-grid.php
 * is the reference example.
 *
 * Di::setDefault() is deliberately NOT called: nothing here relies on the
 * static default, and avoiding it keeps global state out of the picture.
 */

if (isset($GLOBALS['__ts_di'])) {
    return $GLOBALS['__ts_di'];
}

defined('TS_APP') || define('TS_APP', true);

ini_set('display_errors', '0');   // works under mod_php AND php-fpm
ini_set('log_errors', '1');
error_reporting(E_ALL);

/** Log warnings/notices, render nothing. Honours the @ suppression operator. */
set_error_handler(static function (int $severity, string $message, string $file = '', int $line = 0): bool {
    if ((error_reporting() & $severity) === 0) {
        return true;
    }

    error_log('[php] ' . $message . ' in ' . $file . ':' . $line);

    return true;
});

set_exception_handler(static function (\Throwable $e): void {
    error_log('[uncaught] ' . $e::class . ': ' . $e->getMessage());
    // No output. index.php has already emitted valid HTML above this point.
});

/** @var array $config */
$config = require __DIR__ . '/config/config.php';

@ini_set('error_log', $config['paths']['logs'] . '/php-error.log');

/** PSR-4 for ToddSalpen\ — replaces Composer's autoloader. */
(new \Phalcon\Autoload\Loader())
    ->setNamespaces(['ToddSalpen' => __DIR__ . '/src/ToddSalpen/'])
    ->register();

$di = new \Phalcon\Di\FactoryDefault();

$di->setShared('config', static fn (): \Phalcon\Config\Config => new \Phalcon\Config\Config($config));

/** Lazy: the socket is only opened if the repository actually queries. */
$di->setShared('db', static function () use ($config): \Phalcon\Db\Adapter\Pdo\Mysql {
    $c = $config['db'] ?? null;

    if (!is_array($c)) {
        throw new \RuntimeException('No database credentials resolved');
    }

    return new \Phalcon\Db\Adapter\Pdo\Mysql([
        'host'     => $c['host'] ?? 'localhost',
        'username' => $c['username'] ?? '',
        'password' => $c['password'] ?? '',
        'dbname'   => $c['dbname'] ?? '',
        'charset'  => $c['charset'] ?? 'utf8mb4',
        'options'  => [
            \PDO::ATTR_ERRMODE           => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES  => false,
            \PDO::ATTR_TIMEOUT           => 3,   // never hang the homepage
            \PDO::ATTR_STRINGIFY_FETCHES => false,
        ],
    ]);
});

/**
 * Built lazily and defensively — the logger must not become the failure it is
 * there to record. Returns null when app/storage/logs is missing or read-only
 * (which is the normal state on a fresh FTP deploy, because app/storage/** is
 * excluded from the sync); callers then fall back to error_log().
 */
$di->setShared('appLog', static function () use ($config): ?\Phalcon\Logger\Logger {
    try {
        $dir = (string) ($config['paths']['logs'] ?? '');

        if ($dir === '' || !is_dir($dir) || !is_writable($dir)) {
            return null;
        }

        return new \Phalcon\Logger\Logger('app', [
            'main' => new \Phalcon\Logger\Adapter\Stream($dir . '/app.log'),
        ]);
    } catch (\Throwable) {
        return null;
    }
});

$di->setShared('escaper', static fn (): \Phalcon\Html\Escaper => new \Phalcon\Html\Escaper());

return $GLOBALS['__ts_di'] = $di;
