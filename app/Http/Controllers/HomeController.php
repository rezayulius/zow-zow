<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Pricing;
use App\Models\Membership;
use App\Models\Testimonial;
use App\Models\Article;
use App\Models\News;
use App\Models\Promo;
use App\Models\HeroSlide;
use App\Models\Faq;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch dynamic data from database
        $heroSlides = HeroSlide::where('is_active', true)->orderBy('sort_order')->get();
        $services = Service::active()->ordered()->get();
        $healthServices = Service::active()->where('category', 'Health')->ordered()->get();
        $wellnessServices = Service::active()->where('category', 'Wellness')->ordered()->get();
        $pricing = Pricing::active()->ordered()->get();
        $memberships = Membership::active()->ordered()->get();
        $testimonials = Testimonial::active()->featured()->ordered()->limit(6)->get();
        $articles = Article::published()->featured()->ordered()->limit(3)->get();
        $news = News::published()->featured()->ordered()->limit(3)->get();
        $promos = Promo::active()->ongoing()->featured()->ordered()->limit(3)->get();
        $faqs = Faq::active()->ordered()->limit(5)->get();

        // Fetch vets data from Digitail API
        $vets = $this->fetchVetsFromDigitail();

        return view('home', compact(
            'heroSlides',
            'services',
            'healthServices',
            'wellnessServices',
            'pricing',
            'memberships',
            'testimonials',
            'articles',
            'news',
            'promos',
            'vets',
            'faqs'
        ));
    }

    /**
     * Fetch veterinarians data from Digitail API
     */
    private function fetchVetsFromDigitail()
    {
        try {
            $baseUrl = config('app.digitail_api_base', env('DIGITAIL_API_BASE'));
            $accessToken = env('DIGITAIL_ACCESS_TOKEN');
            $clinicId = env('DIGITAIL_DEFAULT_CLINIC_ID', 562);

            $response = Http::timeout(10)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken,
                ])
                ->get($baseUrl . '/vets', [
                    'filter[clinic_id]' => $clinicId,
                    'page' => 1,
                    'per_page' => 10
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $vets = $data['data'] ?? [];

                // Filter only vets with type = 'groomer' or 'veterinarian', exclude type = null
                $filteredVets = array_filter($vets, function ($vet) {
                    return isset($vet['type']) && in_array($vet['type'], ['groomer', 'veterinarian']);
                });

                // Re-index array to avoid gaps in array keys
                return array_values($filteredVets);
            }

            Log::warning('Failed to fetch vets from Digitail API', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return [];
        } catch (\Exception $e) {
            Log::error('Error fetching vets from Digitail API: ' . $e->getMessage());
            return [];
        }
    }
}
