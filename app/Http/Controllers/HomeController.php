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

class HomeController extends Controller
{
    public function index()
    {
        // Fetch dynamic data from database
        $services = Service::active()->ordered()->get();
        $pricing = Pricing::active()->ordered()->get();
        $memberships = Membership::active()->ordered()->get();
        $testimonials = Testimonial::active()->featured()->ordered()->limit(6)->get();
        $articles = Article::published()->featured()->ordered()->limit(3)->get();
        $news = News::published()->featured()->ordered()->limit(3)->get();
        $promos = Promo::active()->ongoing()->featured()->ordered()->limit(3)->get();

        return view('home', compact(
            'services',
            'pricing',
            'memberships',
            'testimonials',
            'articles',
            'news',
            'promos'
        ));
    }
}
