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
use App\Services\DigitailService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    private $digitailService;

    public function __construct(DigitailService $digitailService)
    {
        $this->digitailService = $digitailService;
    }

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
            $baseUrl = config('services.digitail.api_base');
            $accessToken = $this->digitailService->getAccessToken();
            $clinicId = config('services.digitail.default_clinic_id');

            $allVets = [];
            $page = 1;
            $perPage = 50; // Fetch more per page to minimize requests
            $hasMore = true;

            while ($hasMore) {
                $response = Http::timeout(10)
                    ->withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $accessToken,
                    ])
                    ->get($baseUrl . '/vets', [
                        'filter[clinic_id]' => $clinicId,
                        'page' => $page,
                        'per_page' => $perPage
                    ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $vets = $data['data'] ?? [];
                    
                    if (empty($vets)) {
                        $hasMore = false;
                        break;
                    }

                    $allVets = array_merge($allVets, $vets);
                    
                    // Check if we need to fetch next page
                    // Based on meta or just if we got full page
                    $meta = $data['meta'] ?? [];
                    if (isset($meta['current_page']) && isset($meta['last_page'])) {
                        $hasMore = $meta['current_page'] < $meta['last_page'];
                    } else {
                        // Fallback: if we got less than perPage, it's the last page
                        $hasMore = count($vets) >= $perPage;
                    }
                    
                    $page++;
                } else {
                    Log::warning('Failed to fetch vets from Digitail API', [
                        'status' => $response->status(),
                        'response' => $response->body()
                    ]);
                    $hasMore = false;
                }
            }

            Log::info('Total Raw Vets Fetched: ' . count($allVets));

            // Filter only vets with type = 'veterinarian'
            $filteredVets = array_filter($allVets, function ($vet) {
                return isset($vet['type']) && $vet['type'] === 'veterinarian';
            });
            
            Log::info('Filtered Vets Count: ' . count($filteredVets));

            // Re-index array to avoid gaps in array keys
            // If filtering results in empty array, return all vets for now (based on user request showing other types in sample)
            if (empty($filteredVets) && !empty($allVets)) {
                return $allVets;
            }

            return array_values($filteredVets);

        } catch (\Exception $e) {
            Log::error('Error fetching vets from Digitail API: ' . $e->getMessage());
            return [];
        }
    }
}
