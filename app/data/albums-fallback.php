<?php

declare(strict_types=1);

defined('TS_APP') || exit;

/**
 * GENERATED SNAPSHOT — regenerate with `php app/bin/export-fallback.php`.
 *
 * This first revision was written by hand from the extracted dataset so that
 * cutover step 1 ('music' => ['source' => 'fallback']) works before the
 * database exists at all.
 *
 * 7 albums / 56 links (49 real URLs + 7 Beatport placeholders, url = null).
 * The shape is exactly what ToddSalpen\Repository\AlbumRepository::allPublished()
 * returns, so app/views/album-card.phtml renders it without knowing the
 * difference. Do not "improve" the shape here without changing the repository
 * and the exporter in the same commit.
 *
 * cover_alt is the derived "{title} Album" value, matching the repository's
 * behaviour for the NULL cover_alt seeded for every album.
 *
 * NOTE: this file is loaded with require + foreach + htmlspecialchars only. It
 * must never depend on Phalcon or on the database — it is the safety net for
 * exactly those two things.
 */
return [
    [
        'id'                => 1,
        'slug'              => 'aztlan',
        'title'             => 'Aztlan',
        'artist_name'       => null,
        'genre'             => 'Trance',
        'track_count'       => 14,
        'subtitle_override' => null,
        'cover_image'       => 'assets/img/aztlan.jpg',
        'cover_alt'         => 'Aztlan Album',
        'links'             => [
            ['platform_slug' => 'spotify', 'title_attr' => 'Spotify', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-spotify', 'icon_viewbox' => null, 'url' => 'https://open.spotify.com/album/5IjX0Qn6Ux2qvsVWD1Q66o?si=4eD8CASaQN6Xcr9ZnfMqpg', 'link_order' => 10],
            ['platform_slug' => 'apple-music', 'title_attr' => 'Apple Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-apple', 'icon_viewbox' => null, 'url' => 'https://music.apple.com/us/album/aztlan/1864102344', 'link_order' => 20],
            ['platform_slug' => 'youtube-music', 'title_attr' => 'YouTube Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-youtube', 'icon_viewbox' => null, 'url' => 'https://music.youtube.com/playlist?list=OLAK5uy_nzasnSk0QjSB1zqYiKiwiD4a1la6TpsIo&si=GsJsw8udFcdJWo0F', 'link_order' => 30],
            ['platform_slug' => 'amazon-music', 'title_attr' => 'Amazon Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-amazon', 'icon_viewbox' => null, 'url' => 'https://music.amazon.com/albums/B0GCJHJGJS?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_Z6If8PvNOZiAGfSwBvLhZlvrt', 'link_order' => 40],
            ['platform_slug' => 'tidal', 'title_attr' => 'Tidal Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-tidal', 'icon_viewbox' => null, 'url' => 'https://tidal.com/album/484740515/u', 'link_order' => 50],
            ['platform_slug' => 'deezer', 'title_attr' => 'Deezer Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-deezer', 'icon_viewbox' => null, 'url' => 'https://link.deezer.com/s/32fIK4CINpVSGwsQwQgKD', 'link_order' => 60],
            ['platform_slug' => 'pandora', 'title_attr' => 'Pandora Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-pandora', 'icon_viewbox' => null, 'url' => 'https://www.pandora.com/artist/todd-salpen/aztlan/ALffPPXJ5j5wh39?part=ug-desktop&corr=184542033753428470', 'link_order' => 70],
            ['platform_slug' => 'beatport', 'title_attr' => 'Beatport', 'icon_type' => 'svg_path', 'icon_value' => 'M12.513 2.063c-5.517 0-9.969 4.452-9.969 9.969 0 5.516 4.452 9.968 9.969 9.968 5.516 0 9.968-4.452 9.968-9.968 0-5.517-4.452-9.969-9.968-9.969zm4.36 14.329c-1.656 1.656-4.342 1.656-5.998 0L7.128 12.64l3.747-3.748c1.656-1.656 4.342-1.656 5.998 0 1.656 1.657 1.656 4.343 0 5.999v.001z', 'icon_viewbox' => '0 0 24 24', 'url' => null, 'link_order' => 80],
        ],
    ],
    [
        'id'                => 2,
        'slug'              => 'tlal-ukhu',
        'title'             => 'Tlal Ukhu',
        'artist_name'       => null,
        'genre'             => 'Techno',
        'track_count'       => 8,
        'subtitle_override' => null,
        'cover_image'       => 'assets/img/tlalukhu.jpg',
        'cover_alt'         => 'Tlal Ukhu Album',
        'links'             => [
            ['platform_slug' => 'spotify', 'title_attr' => 'Spotify', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-spotify', 'icon_viewbox' => null, 'url' => 'https://open.spotify.com/album/0HndbGy4cCE3UlmJEetLdm?si=oz5qgirTTtyduHcTFekUow', 'link_order' => 10],
            ['platform_slug' => 'apple-music', 'title_attr' => 'Apple Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-apple', 'icon_viewbox' => null, 'url' => 'https://music.apple.com/us/album/tlal-ukhu/1866851547', 'link_order' => 20],
            ['platform_slug' => 'youtube-music', 'title_attr' => 'YouTube Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-youtube', 'icon_viewbox' => null, 'url' => 'https://music.youtube.com/playlist?list=OLAK5uy_lQQjO5efBI9j0ZvjWS8EDis2_GjLwtv5o&si=aj7gNlUEO5YYkk8V', 'link_order' => 30],
            ['platform_slug' => 'amazon-music', 'title_attr' => 'Amazon Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-amazon', 'icon_viewbox' => null, 'url' => 'https://music.amazon.com/albums/B0GF8HK75K?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_Q4ip50FlqcjEbBAkh3oALO7Et', 'link_order' => 40],
            ['platform_slug' => 'tidal', 'title_attr' => 'Tidal Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-tidal', 'icon_viewbox' => null, 'url' => 'https://tidal.com/album/487522496/u', 'link_order' => 50],
            ['platform_slug' => 'deezer', 'title_attr' => 'Deezer Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-deezer', 'icon_viewbox' => null, 'url' => 'https://link.deezer.com/s/32fJBwkhDI8CDnuv6VshE', 'link_order' => 60],
            ['platform_slug' => 'pandora', 'title_attr' => 'Pandora Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-pandora', 'icon_viewbox' => null, 'url' => 'https://www.pandora.com/artist/todd-salpen/tlal-ukhu/AL5btkcK6kbbnpg?part=ug-desktop&corr=184542033753428470', 'link_order' => 70],
            ['platform_slug' => 'beatport', 'title_attr' => 'Beatport', 'icon_type' => 'svg_path', 'icon_value' => 'M12.513 2.063c-5.517 0-9.969 4.452-9.969 9.969 0 5.516 4.452 9.968 9.969 9.968 5.516 0 9.968-4.452 9.968-9.968 0-5.517-4.452-9.969-9.968-9.969zm4.36 14.329c-1.656 1.656-4.342 1.656-5.998 0L7.128 12.64l3.747-3.748c1.656-1.656 4.342-1.656 5.998 0 1.656 1.657 1.656 4.343 0 5.999v.001z', 'icon_viewbox' => '0 0 24 24', 'url' => null, 'link_order' => 80],
        ],
    ],
    [
        'id'                => 3,
        'slug'              => 'beats-of-beauty',
        'title'             => 'Beats of Beauty',
        'artist_name'       => null,
        'genre'             => 'Minimal Techno',
        'track_count'       => 28,
        'subtitle_override' => null,
        'cover_image'       => 'assets/img/beatsofbeauty.jpg',
        'cover_alt'         => 'Beats of Beauty Album',
        'links'             => [
            ['platform_slug' => 'spotify', 'title_attr' => 'Spotify', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-spotify', 'icon_viewbox' => null, 'url' => 'https://open.spotify.com/album/5Odec5ESR3NQm0uL6QcQhJ?si=jMemx8huTeGdyWxi8B4jLw', 'link_order' => 10],
            ['platform_slug' => 'apple-music', 'title_attr' => 'Apple Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-apple', 'icon_viewbox' => null, 'url' => 'https://music.apple.com/us/album/beats-of-beauty/1867772310', 'link_order' => 20],
            ['platform_slug' => 'youtube-music', 'title_attr' => 'YouTube Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-youtube', 'icon_viewbox' => null, 'url' => 'https://music.youtube.com/playlist?list=OLAK5uy_kCY55OLnnG43j4BhsMw6RU8vGzTDgwNlw&si=XCub-rAhrhbB3Qvl', 'link_order' => 30],
            ['platform_slug' => 'amazon-music', 'title_attr' => 'Amazon Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-amazon', 'icon_viewbox' => null, 'url' => 'https://music.amazon.com/albums/B0GFX12LND?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_4RoQpc0OKuWdEvXIhWCNse1N8', 'link_order' => 40],
            ['platform_slug' => 'tidal', 'title_attr' => 'Tidal Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-tidal', 'icon_viewbox' => null, 'url' => 'https://tidal.com/album/488418096/u', 'link_order' => 50],
            ['platform_slug' => 'deezer', 'title_attr' => 'Deezer Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-deezer', 'icon_viewbox' => null, 'url' => 'https://link.deezer.com/s/32fJC4t9XHpRs5Q3WpYz8', 'link_order' => 60],
            ['platform_slug' => 'pandora', 'title_attr' => 'Pandora Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-pandora', 'icon_viewbox' => null, 'url' => 'https://www.pandora.com/artist/todd-salpen/beats-of-beauty/ALcXtfkt769ZK52?part=ug-desktop&corr=184542033753428470', 'link_order' => 70],
            ['platform_slug' => 'beatport', 'title_attr' => 'Beatport', 'icon_type' => 'svg_path', 'icon_value' => 'M12.513 2.063c-5.517 0-9.969 4.452-9.969 9.969 0 5.516 4.452 9.968 9.969 9.968 5.516 0 9.968-4.452 9.968-9.968 0-5.517-4.452-9.969-9.968-9.969zm4.36 14.329c-1.656 1.656-4.342 1.656-5.998 0L7.128 12.64l3.747-3.748c1.656-1.656 4.342-1.656 5.998 0 1.656 1.657 1.656 4.343 0 5.999v.001z', 'icon_viewbox' => '0 0 24 24', 'url' => null, 'link_order' => 80],
        ],
    ],
    [
        'id'                => 4,
        'slug'              => 'the-four-reasons',
        'title'             => 'The Four Reasons',
        'artist_name'       => null,
        'genre'             => 'Synthwave',
        'track_count'       => 4,
        'subtitle_override' => null,
        'cover_image'       => 'assets/img/thefourreasons.jpg',
        'cover_alt'         => 'The Four Reasons Album',
        'links'             => [
            ['platform_slug' => 'spotify', 'title_attr' => 'Spotify', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-spotify', 'icon_viewbox' => null, 'url' => 'https://open.spotify.com/album/1hje65QfvnuABev4pqXjw5?si=kAOpLCiMSaWCQk-FI7JqLQ', 'link_order' => 10],
            ['platform_slug' => 'apple-music', 'title_attr' => 'Apple Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-apple', 'icon_viewbox' => null, 'url' => 'https://music.apple.com/us/album/the-four-reasons-ep/1867701900', 'link_order' => 20],
            ['platform_slug' => 'youtube-music', 'title_attr' => 'YouTube Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-youtube', 'icon_viewbox' => null, 'url' => 'https://music.youtube.com/playlist?list=OLAK5uy_kqGNOMEsWXwcagY-3dbnD6bQHL1-MHKrk&si=h8YI2vv4xHD24teZ', 'link_order' => 30],
            ['platform_slug' => 'amazon-music', 'title_attr' => 'Amazon Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-amazon', 'icon_viewbox' => null, 'url' => 'https://music.amazon.com/albums/B0GFVMZX4K?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_geyHWvN8NkcklerHHhAC8UKw5', 'link_order' => 40],
            ['platform_slug' => 'tidal', 'title_attr' => 'Tidal Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-tidal', 'icon_viewbox' => null, 'url' => 'https://tidal.com/album/488361401/u', 'link_order' => 50],
            ['platform_slug' => 'deezer', 'title_attr' => 'Deezer Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-deezer', 'icon_viewbox' => null, 'url' => 'https://link.deezer.com/s/32fJCQleur9hoRhjvmLoC', 'link_order' => 60],
            // Known data defect, reproduced verbatim from the source HTML: this
            // Pandora URL points at Extracorporeal, not The Four Reasons.
            ['platform_slug' => 'pandora', 'title_attr' => 'Pandora Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-pandora', 'icon_viewbox' => null, 'url' => 'https://www.pandora.com/artist/todd-salpen/extracorporeal/AL5x9pKZ4wgmxdw?part=ug-desktop&corr=184542033753428470', 'link_order' => 70],
            ['platform_slug' => 'beatport', 'title_attr' => 'Beatport', 'icon_type' => 'svg_path', 'icon_value' => 'M12.513 2.063c-5.517 0-9.969 4.452-9.969 9.969 0 5.516 4.452 9.968 9.969 9.968 5.516 0 9.968-4.452 9.968-9.968 0-5.517-4.452-9.969-9.968-9.969zm4.36 14.329c-1.656 1.656-4.342 1.656-5.998 0L7.128 12.64l3.747-3.748c1.656-1.656 4.342-1.656 5.998 0 1.656 1.657 1.656 4.343 0 5.999v.001z', 'icon_viewbox' => '0 0 24 24', 'url' => null, 'link_order' => 80],
        ],
    ],
    [
        'id'                => 5,
        'slug'              => 'extracorporeal',
        'title'             => 'Extracorporeal',
        'artist_name'       => null,
        'genre'             => 'Trance',
        'track_count'       => 16,
        'subtitle_override' => null,
        'cover_image'       => 'assets/img/extracorporeal.jpg',
        'cover_alt'         => 'Extracorporeal Album',
        'links'             => [
            ['platform_slug' => 'spotify', 'title_attr' => 'Spotify', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-spotify', 'icon_viewbox' => null, 'url' => 'https://open.spotify.com/album/3LP6EoLwc59oxF7fHTEArW?si=zuNwNGTYQkqG53kmPoTMIw', 'link_order' => 10],
            ['platform_slug' => 'apple-music', 'title_attr' => 'Apple Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-apple', 'icon_viewbox' => null, 'url' => 'https://music.apple.com/us/album/extracorporeal/1868018727', 'link_order' => 20],
            ['platform_slug' => 'youtube-music', 'title_attr' => 'YouTube Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-youtube', 'icon_viewbox' => null, 'url' => 'https://music.youtube.com/playlist?list=OLAK5uy_mjc4VV4Me93vcTftEYO6r0M_tKXf9lVE8&si=X770hPfwj9NRm9ej', 'link_order' => 30],
            ['platform_slug' => 'amazon-music', 'title_attr' => 'Amazon Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-amazon', 'icon_viewbox' => null, 'url' => 'https://music.amazon.com/albums/B0GG4VLDWW?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_ncjJuH9pSr9L0uQbDQvn2nGau', 'link_order' => 40],
            ['platform_slug' => 'tidal', 'title_attr' => 'Tidal Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-tidal', 'icon_viewbox' => null, 'url' => 'https://tidal.com/album/488695720/u', 'link_order' => 50],
            ['platform_slug' => 'deezer', 'title_attr' => 'Deezer Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-deezer', 'icon_viewbox' => null, 'url' => 'https://link.deezer.com/s/32fJDndJSIWZp204d21Yv', 'link_order' => 60],
            ['platform_slug' => 'pandora', 'title_attr' => 'Pandora Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-pandora', 'icon_viewbox' => null, 'url' => 'https://www.pandora.com/artist/todd-salpen/extracorporeal/AL5x9pKZ4wgmxdw?part=ug-desktop&corr=184542033753428470', 'link_order' => 70],
            ['platform_slug' => 'beatport', 'title_attr' => 'Beatport', 'icon_type' => 'svg_path', 'icon_value' => 'M12.513 2.063c-5.517 0-9.969 4.452-9.969 9.969 0 5.516 4.452 9.968 9.969 9.968 5.516 0 9.968-4.452 9.968-9.968 0-5.517-4.452-9.969-9.968-9.969zm4.36 14.329c-1.656 1.656-4.342 1.656-5.998 0L7.128 12.64l3.747-3.748c1.656-1.656 4.342-1.656 5.998 0 1.656 1.657 1.656 4.343 0 5.999v.001z', 'icon_viewbox' => '0 0 24 24', 'url' => null, 'link_order' => 80],
        ],
    ],
    [
        'id'                => 6,
        'slug'              => 'arcane-codex',
        'title'             => 'Arcane Codex',
        'artist_name'       => null,
        'genre'             => 'Trance',
        'track_count'       => 9,
        'subtitle_override' => null,
        'cover_image'       => 'assets/img/arcanecodex.jpg',
        'cover_alt'         => 'Arcane Codex Album',
        'links'             => [
            ['platform_slug' => 'spotify', 'title_attr' => 'Spotify', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-spotify', 'icon_viewbox' => null, 'url' => 'https://open.spotify.com/album/42I3u1438yVwFdn663wtAh?si=9NWnQ9pQQ-6pdxPCb8MzOA', 'link_order' => 10],
            ['platform_slug' => 'apple-music', 'title_attr' => 'Apple Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-apple', 'icon_viewbox' => null, 'url' => 'https://music.apple.com/us/album/arcane-codex/1868672590', 'link_order' => 20],
            ['platform_slug' => 'youtube-music', 'title_attr' => 'YouTube Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-youtube', 'icon_viewbox' => null, 'url' => 'https://music.youtube.com/playlist?list=OLAK5uy_llBEcqOrXr6Zl4tRf5zL1JlbJpTN6i7UY&si=qpObixxXJrCmvDCL', 'link_order' => 30],
            ['platform_slug' => 'amazon-music', 'title_attr' => 'Amazon Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-amazon', 'icon_viewbox' => null, 'url' => 'https://music.amazon.com/albums/B0GGHP8Y57?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_YfndTuppXgTsIt6AhJb7EzpzO', 'link_order' => 40],
            ['platform_slug' => 'tidal', 'title_attr' => 'Tidal Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-tidal', 'icon_viewbox' => null, 'url' => 'https://tidal.com/album/489319254/u', 'link_order' => 50],
            // Known data defect, reproduced verbatim from the source HTML:
            // byte-identical to Extracorporeal's Deezer link.
            ['platform_slug' => 'deezer', 'title_attr' => 'Deezer Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-deezer', 'icon_viewbox' => null, 'url' => 'https://link.deezer.com/s/32fJDndJSIWZp204d21Yv', 'link_order' => 60],
            ['platform_slug' => 'pandora', 'title_attr' => 'Pandora Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-pandora', 'icon_viewbox' => null, 'url' => 'https://www.pandora.com/artist/todd-salpen/arcane-codex/AL2PdwXdVw4hpv6?part=ug-desktop&corr=184542033753428470', 'link_order' => 70],
            ['platform_slug' => 'beatport', 'title_attr' => 'Beatport', 'icon_type' => 'svg_path', 'icon_value' => 'M12.513 2.063c-5.517 0-9.969 4.452-9.969 9.969 0 5.516 4.452 9.968 9.969 9.968 5.516 0 9.968-4.452 9.968-9.968 0-5.517-4.452-9.969-9.968-9.969zm4.36 14.329c-1.656 1.656-4.342 1.656-5.998 0L7.128 12.64l3.747-3.748c1.656-1.656 4.342-1.656 5.998 0 1.656 1.657 1.656 4.343 0 5.999v.001z', 'icon_viewbox' => '0 0 24 24', 'url' => null, 'link_order' => 80],
        ],
    ],
    [
        'id'                => 7,
        'slug'              => 'beats-of-fashion',
        'title'             => 'Beats of Fashion',
        'artist_name'       => null,
        'genre'             => 'Minimal Techno',
        'track_count'       => 22,
        'subtitle_override' => null,
        'cover_image'       => 'assets/img/beatsoffashion.jpg',
        'cover_alt'         => 'Beats of Fashion Album',
        'links'             => [
            ['platform_slug' => 'spotify', 'title_attr' => 'Spotify', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-spotify', 'icon_viewbox' => null, 'url' => 'https://open.spotify.com/album/3XRiGAZCXz6J9gKS2qvXVn?si=_-KGdwcAQ0WaTzyvTgjD0Q', 'link_order' => 10],
            ['platform_slug' => 'apple-music', 'title_attr' => 'Apple Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-apple', 'icon_viewbox' => null, 'url' => 'https://music.apple.com/us/album/beats-of-fashion/1870184796', 'link_order' => 20],
            ['platform_slug' => 'youtube-music', 'title_attr' => 'YouTube Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-youtube', 'icon_viewbox' => null, 'url' => 'https://music.youtube.com/playlist?list=OLAK5uy_k5q-0ExXcfWzB3v6rinrs0fI6zOTjblcI&si=THYthaG-z8sjvDUj', 'link_order' => 30],
            ['platform_slug' => 'amazon-music', 'title_attr' => 'Amazon Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-amazon', 'icon_viewbox' => null, 'url' => 'https://music.amazon.com/albums/B0GHN2Z2GM?marketplaceId=ATVPDKIKX0DER&musicTerritory=US&ref=dm_sh_go7loOYVXqxZZDUtvyCeVu0Cl', 'link_order' => 40],
            ['platform_slug' => 'tidal', 'title_attr' => 'Tidal Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-tidal', 'icon_viewbox' => null, 'url' => 'https://tidal.com/album/490692378/u', 'link_order' => 50],
            ['platform_slug' => 'deezer', 'title_attr' => 'Deezer Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-deezer', 'icon_viewbox' => null, 'url' => 'https://link.deezer.com/s/32fJE9Lrhnp1l3euXRpNM', 'link_order' => 60],
            ['platform_slug' => 'pandora', 'title_attr' => 'Pandora Music', 'icon_type' => 'fontawesome', 'icon_value' => 'fa-brands fa-pandora', 'icon_viewbox' => null, 'url' => 'https://www.pandora.com/artist/todd-salpen/beats-of-fashion/ALn6fkt4tzwVt29?part=ug-desktop&corr=184542033753428470', 'link_order' => 70],
            ['platform_slug' => 'beatport', 'title_attr' => 'Beatport', 'icon_type' => 'svg_path', 'icon_value' => 'M12.513 2.063c-5.517 0-9.969 4.452-9.969 9.969 0 5.516 4.452 9.968 9.969 9.968 5.516 0 9.968-4.452 9.968-9.968 0-5.517-4.452-9.969-9.968-9.969zm4.36 14.329c-1.656 1.656-4.342 1.656-5.998 0L7.128 12.64l3.747-3.748c1.656-1.656 4.342-1.656 5.998 0 1.656 1.657 1.656 4.343 0 5.999v.001z', 'icon_viewbox' => '0 0 24 24', 'url' => null, 'link_order' => 80],
        ],
    ],
];
