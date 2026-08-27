#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Migration runner.  Usage:  php app/bin/migrate.php [flags]
 *
 *   --dry-run    print the plan, touch nothing
 *   --seed       also apply seed-class migrations (filename contains "seed")
 *   --force      re-apply migrations already recorded in the ledger
 *   --verbose    print every statement as it is applied
 *
 * Applies app/db/migrations/*.sql in filename order, recording version,
 * description and sha256 checksum in the `migrations` table.
 *
 * DDL IS NOT TRANSACTIONAL IN MARIADB and this script does not pretend
 * otherwise with a BEGIN. Instead every DDL statement is IF NOT EXISTS and
 * every data statement is ON DUPLICATE KEY UPDATE, so a half-applied migration
 * is fixed by simply re-running. Acceptance test: run it twice — the second run
 * must report "0 applied" and change no rows.
 *
 * phpMyAdmin Import of app/db/schema.sql + app/db/seed.sql is always a valid
 * escape hatch and does exactly the same thing.
 */

PHP_SAPI === 'cli' || exit("CLI only\n");

if (!extension_loaded('phalcon')) {
    exit("phalcon extension is not loaded for this PHP binary — cannot migrate\n");
}

$appDir = dirname(__DIR__);

/** @var \Phalcon\Di\DiInterface $di */
$di = require $appDir . '/bootstrap.php';

$flags   = array_slice($argv ?? [], 1);
$dryRun  = in_array('--dry-run', $flags, true);
$doSeed  = in_array('--seed', $flags, true);
$force   = in_array('--force', $flags, true);
$verbose = in_array('--verbose', $flags, true);

/**
 * Splits a .sql file into individual statements.
 *
 * Splitting SQL on ";" is generally wrong, but the invariant documented at the
 * top of every file under app/db/ makes it honest here: no semicolons inside
 * string literals, no DELIMITER blocks, no stored routines, no C-style block
 * comments. Single-quote state is tracked so a stray ";" inside a literal would
 * still be safe, and "--" line comments are stripped outside literals.
 *
 * If that invariant is ever broken, convert the migration to a PHP file
 * returning string[] rather than growing an SQL parser here.
 *
 * @return list<string>
 */
function ts_split_sql(string $sql): array
{
    $out      = [];
    $buf      = '';
    $inSingle = false;
    $len      = strlen($sql);

    for ($i = 0; $i < $len; $i++) {
        $ch = $sql[$i];

        if (!$inSingle) {
            if ($ch === '-' && ($sql[$i + 1] ?? '') === '-') {
                $nl   = strpos($sql, "\n", $i);
                $i    = $nl === false ? $len : $nl;
                $buf .= "\n";                     // keep line structure readable
                continue;
            }

            if ($ch === ';') {
                $statement = trim($buf);

                if ($statement !== '') {
                    $out[] = $statement;
                }

                $buf = '';
                continue;
            }
        }

        // Note the explicit $i > 0 guard: PHP 8 negative string offsets would
        // otherwise read the LAST character of the file when $i === 0.
        if ($ch === "'" && ($i > 0 ? $sql[$i - 1] : '') !== '\\') {
            $inSingle = !$inSingle;
        }

        $buf .= $ch;
    }

    $statement = trim($buf);

    if ($statement !== '') {
        $out[] = $statement;
    }

    return $out;
}

try {
    $db = $di->get('db');
} catch (\Throwable $e) {
    exit('Cannot connect: ' . $e::class . ': ' . $e->getMessage() . "\n");
}

// -- 1. bootstrap the ledger itself -------------------------------------------
$db->execute(<<<'SQL'
    CREATE TABLE IF NOT EXISTS `migrations` (
        `id`          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
        `version`     VARCHAR(64)     NOT NULL,
        `description` VARCHAR(255)        NULL DEFAULT NULL,
        `checksum`    CHAR(64)            NULL DEFAULT NULL,
        `applied_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `uq_migrations_version` (`version`)
    ) ENGINE=InnoDB
      ROW_FORMAT=DYNAMIC
      DEFAULT CHARSET=utf8mb4
      COLLATE=utf8mb4_unicode_ci
    SQL);

$applied = [];

foreach ($db->fetchAll('SELECT `version`, `checksum` FROM `migrations`', \Phalcon\Db\Enum::FETCH_ASSOC) as $row) {
    $applied[(string) $row['version']] = (string) ($row['checksum'] ?? '');
}

// -- 2. collect migrations ----------------------------------------------------
$files = glob($appDir . '/db/migrations/*.sql') ?: [];
sort($files, SORT_STRING);

if ($files === []) {
    exit("No migrations found in app/db/migrations/\n");
}

$appliedCount = 0;
$skippedCount = 0;

echo ($dryRun ? "DRY RUN — nothing will be executed\n" : "Applying migrations\n");
echo str_repeat('=', 78) . "\n";

foreach ($files as $file) {
    $version  = basename($file, '.sql');
    $checksum = (string) hash_file('sha256', $file);
    $isSeed   = str_contains(strtolower($version), 'seed');

    if ($isSeed && !$doSeed) {
        echo "SKIP    {$version}  (seed-class — pass --seed to apply)\n";
        $skippedCount++;
        continue;
    }

    if (isset($applied[$version]) && !$force) {
        if ($applied[$version] !== '' && $applied[$version] !== $checksum) {
            echo "WARN    {$version}  checksum differs from the recorded value — file edited after it was applied\n";
        }

        echo "SKIP    {$version}  (already applied)\n";
        $skippedCount++;
        continue;
    }

    $statements = ts_split_sql((string) file_get_contents($file));

    if ($dryRun) {
        echo 'PLAN    ' . $version . '  (' . count($statements) . " statements)\n";
        $skippedCount++;
        continue;
    }

    echo 'APPLY   ' . $version . '  (' . count($statements) . " statements)\n";

    foreach ($statements as $n => $statement) {
        if ($verbose) {
            echo '        [' . ($n + 1) . '] ' . preg_replace('~\s+~', ' ', substr($statement, 0, 120)) . "\n";
        }

        try {
            $db->execute($statement);
        } catch (\Throwable $e) {
            echo "\nFAILED in {$version}, statement " . ($n + 1) . ":\n";
            echo $statement . "\n\n";
            echo $e::class . ': ' . $e->getMessage() . "\n";
            echo "The ledger was NOT updated. Fix the statement and re-run.\n";
            exit(1);
        }
    }

    // Prepared statement with bound parameters — never string-concatenate.
    $db->execute(
        'INSERT INTO `migrations` (`version`, `description`, `checksum`)'
        . ' VALUES (:version, :description, :checksum)'
        . ' ON DUPLICATE KEY UPDATE `checksum` = VALUES(`checksum`), `applied_at` = CURRENT_TIMESTAMP',
        [
            'version'     => $version,
            'description' => ucfirst(str_replace('_', ' ', (string) preg_replace('~^\d+_~', '', $version))),
            'checksum'    => $checksum,
        ],
    );

    $appliedCount++;
}

echo str_repeat('=', 78) . "\n";
printf("%d applied, %d skipped\n", $appliedCount, $skippedCount);
