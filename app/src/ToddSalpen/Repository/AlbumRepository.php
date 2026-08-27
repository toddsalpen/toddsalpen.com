<?php

declare(strict_types=1);

namespace ToddSalpen\Repository;

defined('TS_APP') || exit;

use Phalcon\Db\Adapter\AdapterInterface;
use Phalcon\Db\Enum;

/**
 * One query, one grouping loop, one plain-array return shape.
 *
 * No escaping, no HTML, no Phalcon\Mvc\Model. The 56 flat rows of the single
 * JOIN below are grouped into 7 nested arrays in PHP — there is no N+1.
 *
 * THE RETURNED SHAPE IS A CONTRACT. app/data/albums-fallback.php returns
 * exactly this structure and app/bin/export-fallback.php produces it, which is
 * what makes degraded output byte-identical to healthy output: the same two
 * templates consume both without knowing which one they got.
 *
 *   [
 *     'id'                => int,
 *     'slug'              => string,
 *     'title'             => string,
 *     'artist_name'       => ?string,   // null = Todd Salpen
 *     'genre'             => string,
 *     'track_count'       => ?int,      // null = omit the track fragment
 *     'subtitle_override' => ?string,   // null = "{genre} • {N} Tracks"
 *     'cover_image'       => string,
 *     'cover_alt'         => string,    // derived "{title} Album" when NULL
 *     'links'             => [
 *       [
 *         'platform_slug' => string,
 *         'title_attr'    => string,
 *         'icon_type'     => string,    // 'fontawesome' | 'svg_path'
 *         'icon_value'    => string,
 *         'icon_viewbox'  => ?string,
 *         'url'           => ?string,   // null = placeholder, renders href="#"
 *         'link_order'    => int,
 *       ],
 *     ],
 *   ]
 */
final class AlbumRepository
{
    /**
     * LEFT JOINs, deliberately: an album with zero active links must still
     * render its card rather than vanish from the grid. Rows whose platform is
     * inactive come back with platform_slug IS NULL and are skipped in group().
     */
    private const SQL = <<<'SQL'
        SELECT a.id, a.slug, a.title, a.artist_name, a.genre, a.track_count,
               a.subtitle_override, a.cover_image, a.cover_alt,
               p.slug        AS platform_slug,
               p.title_attr  AS platform_title_attr,
               p.icon_type, p.icon_value, p.icon_viewbox,
               pl.url        AS link_url,
               COALESCE(pl.sort_order, p.default_sort_order) AS link_order
          FROM albums a
          LEFT JOIN platform_links pl ON pl.album_id = a.id AND pl.is_active = 1
          LEFT JOIN platforms      p  ON p.slug = pl.platform_slug AND p.is_active = 1
         WHERE a.is_published = 1
         ORDER BY a.sort_order, a.id, link_order, pl.id
        SQL;

    public function __construct(private readonly AdapterInterface $db)
    {
    }

    /**
     * @return list<array<string, mixed>> grouped albums, each with a 'links' list
     */
    public function allPublished(): array
    {
        // No parameters in phase 1. Any future parameterised query MUST bind:
        //   $this->db->fetchAll($sql, Enum::FETCH_ASSOC, ['slug' => $slug])
        // Never string-concatenate a value into SQL.
        $rows = $this->db->fetchAll(self::SQL, Enum::FETCH_ASSOC);

        return $this->group($rows);
    }

    /**
     * @param  array<int, array<string, mixed>> $rows
     * @return list<array<string, mixed>>
     */
    private function group(array $rows): array
    {
        $albums = [];

        foreach ($rows as $r) {
            $id = (int) $r['id'];

            $albums[$id] ??= [
                'id'                => $id,
                'slug'              => (string) $r['slug'],
                'title'             => (string) $r['title'],
                'artist_name'       => $r['artist_name'] !== null ? (string) $r['artist_name'] : null,
                'genre'             => (string) $r['genre'],
                'track_count'       => $r['track_count'] !== null ? (int) $r['track_count'] : null,
                'subtitle_override' => $r['subtitle_override'] !== null ? (string) $r['subtitle_override'] : null,
                'cover_image'       => (string) $r['cover_image'],
                // NULL alt => derive. Fixes the four wrong alts in the source HTML.
                'cover_alt'         => $r['cover_alt'] !== null
                    ? (string) $r['cover_alt']
                    : (string) $r['title'] . ' Album',
                'links'             => [],
            ];

            if ($r['platform_slug'] === null) {   // album with no active links
                continue;
            }

            $albums[$id]['links'][] = [
                'platform_slug' => (string) $r['platform_slug'],
                'title_attr'    => (string) $r['platform_title_attr'],
                'icon_type'     => (string) $r['icon_type'],
                'icon_value'    => (string) $r['icon_value'],
                'icon_viewbox'  => $r['icon_viewbox'] !== null ? (string) $r['icon_viewbox'] : null,
                'url'           => $r['link_url'] !== null ? (string) $r['link_url'] : null,
                'link_order'    => (int) $r['link_order'],
            ];
        }

        return array_values($albums);
    }
}
