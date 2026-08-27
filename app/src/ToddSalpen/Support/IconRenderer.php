<?php

declare(strict_types=1);

namespace ToddSalpen\Support;

defined('TS_APP') || exit;

/**
 * Turns a link row's icon_type + icon_value into safe HTML, and nothing else.
 *
 * This is the ONLY place that emits markup derived from a database column, so
 * all validation lives here. Both values land in contexts where escaping is not
 * sufficient — a class list and an SVG path `d` attribute — so they are
 * allowlist-VALIDATED instead. A value that fails validation renders as an
 * empty icon: visually degraded, never dangerous.
 *
 * This class has NO Phalcon and NO database dependency, on purpose: the
 * no-Phalcon fallback path in app/render/music-grid.php require()s it directly.
 * Keep it that way — a safety net that shares dependencies with the thing it
 * protects is not a safety net.
 */
final class IconRenderer
{
    private const FA_CLASS = '~^[a-z0-9 \-]{1,120}$~';
    private const SVG_PATH = '~^[0-9A-Za-z\s.,\-]{1,4000}$~';   // path `d` grammar subset
    private const VIEWBOX  = '~^[0-9.\-]+ [0-9.\-]+ [0-9.\-]+ [0-9.\-]+$~';

    /**
     * @param array<string, mixed> $link
     */
    public static function html(array $link): string
    {
        $type  = (string) ($link['icon_type'] ?? '');
        $value = (string) ($link['icon_value'] ?? '');

        return match ($type) {
            'fontawesome' => preg_match(self::FA_CLASS, $value) === 1
                ? '<i class="' . $value . '"></i>'
                : '',
            'svg_path' => self::svg($value, $link['icon_viewbox'] ?? null),
            default    => '',
        };
    }

    /**
     * The scheme allowlist is what stops a javascript: URL entering via the
     * database from becoming stored XSS. Anything that is not an absolute
     * http(s) URL collapses to "#", which is exactly what the source HTML uses
     * for the seven Beatport placeholders.
     *
     * NEVER use Phalcon\Html\Escaper::escapeUrl() here: it rawurlencode()s the
     * WHOLE string, turning every streaming link into
     * "https%3A%2F%2Fopen.spotify.com%2F..." — it is meant for encoding a single
     * query-string value, not a complete URL.
     */
    public static function href(?string $url): string
    {
        if ($url === null || $url === '#' || preg_match('~^https?://~i', $url) !== 1) {
            return '#';
        }

        return htmlspecialchars($url, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    private static function svg(string $path, mixed $viewBox): string
    {
        $viewBox = is_string($viewBox) && $viewBox !== '' ? $viewBox : '0 0 24 24';

        if (preg_match(self::SVG_PATH, $path) !== 1 || preg_match(self::VIEWBOX, $viewBox) !== 1) {
            return '';
        }

        return '<svg width="16" height="16" viewBox="' . $viewBox . '" fill="currentColor">'
             . '<path d="' . $path . '"/>'
             . '</svg>';
    }
}
