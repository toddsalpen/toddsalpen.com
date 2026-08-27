<?php

declare(strict_types=1);

namespace ToddSalpen\View;

defined('TS_APP') || exit;

use Phalcon\Di\DiInterface;
use ToddSalpen\Repository\AlbumRepository;

/**
 * Chooses the data source, guarantees output, logs degradation.
 *
 * This is the try/catch boundary that matters. A database problem is an
 * operations problem, not a visitor's problem: the discography is the most
 * valuable content on the page and must survive the DB being down,
 * misconfigured, or not yet migrated.
 *
 * Degraded mode still returns HTTP 200 — the content is correct and complete,
 * only potentially stale, and a 5xx would tell crawlers to drop the page.
 * Status is signalled with an HTML comment (and, in debug mode, a header).
 */
final class MusicGridRenderer
{
    public function __construct(private readonly DiInterface $di)
    {
    }

    public function render(): void
    {
        [$source, $debug, $viewsDir, $fallbackPath] = $this->settings();

        $albums   = [];
        $degraded = false;

        if ($source === 'db') {
            try {
                $albums = (new AlbumRepository($this->di->get('db')))->allPublished();

                if ($albums === []) {          // migrated but not seeded
                    $degraded = true;
                    $this->log('warning', 'Query succeeded but returned 0 albums');
                }
            } catch (\Throwable $e) {          // Throwable, not Exception: a missing
                $degraded = true;              // class or a TypeError in the config
                $albums   = [];                // path is exactly what this guards.
                $this->log('error', $e::class . ': ' . $e->getMessage());
            }
        } else {
            $degraded = true;                  // explicit 'fallback' mode (cutover step 1)
        }

        if ($degraded) {
            $albums = $this->fallback($fallbackPath);

            echo "                <!-- discography: snapshot -->\n";

            if ($debug && !headers_sent()) {
                header('X-TS-Discography: fallback');
            }
        }

        // Same template for healthy and degraded data — that is the whole point.
        // music-grid.phtml reads $albums, which is in scope at this include.
        include $viewsDir . '/music-grid.phtml';
    }

    /**
     * Config lookup that cannot throw. Falls back to paths derived from
     * __DIR__ so a broken config still renders the snapshot.
     *
     * @return array{0: string, 1: bool, 2: string, 3: string}
     */
    private function settings(): array
    {
        $appDir = dirname(__DIR__, 3);   // app/src/ToddSalpen/View -> app

        $source       = 'db';
        $debug        = false;
        $viewsDir     = $appDir . '/views';
        $fallbackPath = $appDir . '/data/albums-fallback.php';

        try {
            $config = $this->di->get('config');

            $source       = (string) ($config->path('music.source') ?: $source);
            $debug        = (bool) ($config->path('debug') ?? false);
            $viewsDir     = (string) ($config->path('paths.views') ?: $viewsDir);
            $fallbackPath = (string) ($config->path('paths.fallback') ?: $fallbackPath);
        } catch (\Throwable $e) {
            $this->log('error', 'Config unavailable: ' . $e::class . ': ' . $e->getMessage());
        }

        return [$source, $debug, $viewsDir, $fallbackPath];
    }

    /**
     * The safety net must not share dependencies with what it protects:
     * require + array, no Phalcon, no database.
     *
     * @return list<array<string, mixed>>
     */
    private function fallback(string $path): array
    {
        if ($path === '' || !is_file($path)) {
            $this->log('critical', 'Fallback snapshot missing: ' . $path);

            return [];
        }

        $data = require $path;

        return is_array($data) ? $data : [];
    }

    private function log(string $level, string $message): void
    {
        try {
            $logger = $this->di->has('appLog') ? $this->di->get('appLog') : null;

            if ($logger !== null) {
                $logger->{$level}($message);

                return;
            }
        } catch (\Throwable) {
            // Logging must never become the failure — fall through.
        }

        error_log('[music-grid][' . $level . '] ' . $message);
    }
}
