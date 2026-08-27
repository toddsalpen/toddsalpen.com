<?php

declare(strict_types=1);

/**
 * The one file index.php includes.
 *
 *     <div class="music-grid">
 *     <?php require __DIR__ . '/app/render/music-grid.php'; ?>
 *     </div>
 *
 * Small on purpose, and it is where the "is Phalcon even here?" guard lives —
 * bootstrap.php constructs Phalcon objects immediately and would fatal before
 * it could check for itself.
 */

if (!extension_loaded('phalcon')) {
    error_log('[music-grid] phalcon extension not loaded; rendering static snapshot');

    // This branch has no PSR-4 loader, so the one class the template needs is
    // required by hand rather than duplicating the icon logic.
    defined('TS_APP') || define('TS_APP', true);

    require_once __DIR__ . '/../src/ToddSalpen/Support/IconRenderer.php';

    $tsFallbackFile = __DIR__ . '/../data/albums-fallback.php';
    $albums         = is_file($tsFallbackFile) ? require $tsFallbackFile : [];

    if (!is_array($albums)) {
        $albums = [];
    }

    echo "                <!-- discography: snapshot (no phalcon) -->\n";

    include __DIR__ . '/../views/music-grid.phtml';

    return;
}

// require, not require_once: bootstrap.php carries its own idempotency guard
// and returns the already-built container on re-inclusion, whereas
// require_once would return bool true the second time.
$di = require __DIR__ . '/../bootstrap.php';

(new \ToddSalpen\View\MusicGridRenderer($di))->render();
