<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ClinicFacility;
use App\Models\ClinicService;
use App\Models\ServiceCategory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = Cache::remember('sitemap.xml', 3600, function () {
            // Force route() to build URLs from the configured app URL rather
            // than the current request's Host header, so a request hitting
            // this endpoint with an unexpected/spoofed host (e.g. a raw IP,
            // a misconfigured health check) can never poison the 1-hour
            // sitemap cache with the wrong domain.
            URL::forceRootUrl(config('app.url'));

            $categories = ServiceCategory::active()->ordered()->with(['clinicServices' => fn ($q) => $q->active()])->get();

            $urls = [
                ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ];

            foreach ($categories as $category) {
                $urls[] = [
                    'loc' => route('service-category.show', $category),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                ];

                foreach ($category->clinicServices as $service) {
                    $urls[] = [
                        'loc' => route('service.show', [$category, $service]),
                        'priority' => '0.7',
                        'changefreq' => 'monthly',
                        'lastmod' => $service->updated_at->toDateString(),
                    ];
                }
            }

            $facilities = ClinicFacility::active()->ordered()->get();

            if ($facilities->isNotEmpty()) {
                $urls[] = [
                    'loc' => route('facility.index'),
                    'priority' => '0.6',
                    'changefreq' => 'monthly',
                ];

                foreach ($facilities as $facility) {
                    $urls[] = [
                        'loc' => route('facility.show', $facility),
                        'priority' => '0.5',
                        'changefreq' => 'monthly',
                        'lastmod' => $facility->updated_at->toDateString(),
                    ];
                }
            }

            $articles = Article::published()->ordered()->orderByDesc('published_at')->get();

            if ($articles->isNotEmpty()) {
                $urls[] = [
                    'loc' => route('articles.index'),
                    'priority' => '0.6',
                    'changefreq' => 'weekly',
                ];

                foreach ($articles as $article) {
                    $urls[] = [
                        'loc' => route('articles.show', $article),
                        'priority' => '0.5',
                        'changefreq' => 'monthly',
                        'lastmod' => $article->updated_at->toDateString(),
                    ];
                }
            }

            return view('sitemap', compact('urls'))->render();
        });

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
