<?php

namespace App\Http\Controllers;

use App\Models\TiengDongCategory;
use App\Models\TiengDongSound;
use App\Models\TiengDongTag;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Generate and serve the XML sitemap.
     */
    public function index(): Response
    {
        $cacheKey = 'sitemap_xml';

        $xmlContent = Cache::remember($cacheKey, 86400, function () {
            $urls = [];
            $now = now()->toAtomString();

            // 1. Static pages
            $staticUrls = [
                ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => $now],
                ['loc' => url('/gioi-thieu'), 'priority' => '0.3', 'changefreq' => 'monthly', 'lastmod' => $now],
                ['loc' => url('/chinh-sach'), 'priority' => '0.3', 'changefreq' => 'monthly', 'lastmod' => $now],
                ['loc' => url('/lien-he'), 'priority' => '0.3', 'changefreq' => 'monthly', 'lastmod' => $now],
            ];

            foreach ($staticUrls as $url) {
                $urls[] = $url;
            }

            // 2. Categories
            $categories = TiengDongCategory::select('slug', 'updated_at')->get();
            foreach ($categories as $category) {
                $urls[] = [
                    'loc' => url('/' . $category->slug),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                    'lastmod' => $category->updated_at ? $category->updated_at->toAtomString() : $now
                ];
            }

            // 3. Sound detail pages
            $sounds = TiengDongSound::select('id', 'slug', 'updated_at')->get();
            foreach ($sounds as $sound) {
                $urls[] = [
                    'loc' => url('/' . $sound->slug . '-' . $sound->id),
                    'priority' => '0.7',
                    'changefreq' => 'weekly',
                    'lastmod' => $sound->updated_at ? $sound->updated_at->toAtomString() : $now
                ];
            }

            // 4. Tag pages
            $tags = TiengDongTag::select('slug', 'updated_at')->get();
            foreach ($tags as $tag) {
                $urls[] = [
                    'loc' => url('/tag/' . $tag->slug),
                    'priority' => '0.5',
                    'changefreq' => 'weekly',
                    'lastmod' => $tag->updated_at ? $tag->updated_at->toAtomString() : $now
                ];
            }

            // Generate sitemap XML
            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
            foreach ($urls as $url) {
                $xml .= '    <url>' . PHP_EOL;
                $xml .= '        <loc>' . htmlspecialchars($url['loc']) . '</loc>' . PHP_EOL;
                $xml .= '        <lastmod>' . $url['lastmod'] . '</lastmod>' . PHP_EOL;
                $xml .= '        <changefreq>' . $url['changefreq'] . '</changefreq>' . PHP_EOL;
                $xml .= '        <priority>' . $url['priority'] . '</priority>' . PHP_EOL;
                $xml .= '    </url>' . PHP_EOL;
            }
            $xml .= '</urlset>';

            return $xml;
        });

        return response($xmlContent)->header('Content-Type', 'text/xml');
    }
}
