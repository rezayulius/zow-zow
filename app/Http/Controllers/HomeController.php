<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Pricing;
use App\Models\Membership;
use App\Models\Testimonial;
use App\Models\Article;
use App\Models\News;
use App\Models\Promo;
use App\Models\HeroSlide;
use App\Models\Faq;
use App\Services\DigitailService;
use App\Services\GooglePlacesService;

class HomeController extends Controller
{
    private $digitailService;
    private $googlePlacesService;

    public function __construct(DigitailService $digitailService, GooglePlacesService $googlePlacesService)
    {
        $this->digitailService = $digitailService;
        $this->googlePlacesService = $googlePlacesService;
    }

    public function index()
    {
        // Fetch dynamic data from database
        $heroSlides = HeroSlide::where('is_active', true)->orderBy('sort_order')->get();
        $services = Service::active()->ordered()->get();
        $healthServices = Service::active()->where('category', 'Health')->ordered()->get();
        $wellnessServices = Service::active()->where('category', 'Wellness')->ordered()->get();
        $serviceCategories = ServiceCategory::active()->ordered()
            ->with(['clinicServices' => fn ($query) => $query->active()->ordered()])
            ->get();
        $pricing = Pricing::active()->ordered()->get();
        $memberships = Membership::active()->ordered()->get();
        $testimonials = Testimonial::active()->featured()->ordered()->limit(6)->get();
        $googleReviews = $this->googlePlacesService->getReviews();
        $articles = Article::published()->featured()->ordered()->limit(3)->get();
        $news = News::published()->featured()->ordered()->limit(3)->get();
        $promos = Promo::active()->ongoing()->featured()->ordered()->limit(3)->get();
        $faqs = Faq::active()->ordered()->limit(5)->get();

        // Fetch vets data from Digitail API
        $vets = $this->digitailService->getVets();

        return view('home', compact(
            'heroSlides',
            'services',
            'healthServices',
            'wellnessServices',
            'serviceCategories',
            'pricing',
            'memberships',
            'testimonials',
            'googleReviews',
            'articles',
            'news',
            'promos',
            'vets',
            'faqs'
        ));
    }

}
