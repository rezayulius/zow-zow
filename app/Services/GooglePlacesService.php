<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GooglePlacesService
{
    private ?string $apiKey;
    private ?string $placeId;
    private int $cacheTtl;

    public function __construct()
    {
        $this->apiKey = config('services.google_places.api_key');
        $this->placeId = config('services.google_places.place_id');
        $this->cacheTtl = (int) config('services.google_places.cache_ttl', 1440);
    }

    /**
     * Get cached place details (rating, total reviews, and up to 5 latest reviews).
     */
    public function getReviews(): ?array
    {
        if (!$this->apiKey || !$this->placeId) {
            return null;
        }

        return Cache::remember('google_places.reviews', now()->addMinutes($this->cacheTtl), function () {
            return $this->fetchReviews();
        });
    }

    private function fetchReviews(): ?array
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
            'place_id' => $this->placeId,
            'fields' => 'name,rating,user_ratings_total,reviews,url',
            'reviews_sort' => 'newest',
            'key' => $this->apiKey,
        ]);

        if (!$response->successful() || $response->json('status') !== 'OK') {
            Log::error('Google Places Details Failed', ['body' => $response->body()]);
            return null;
        }

        $result = $response->json('result');

        return [
            'name' => $result['name'] ?? null,
            'rating' => $result['rating'] ?? null,
            'user_ratings_total' => $result['user_ratings_total'] ?? null,
            'url' => $result['url'] ?? null,
            'reviews' => collect($result['reviews'] ?? [])
                ->map(fn ($review) => [
                    'author_name' => $review['author_name'] ?? null,
                    'author_url' => $review['author_url'] ?? null,
                    'profile_photo_url' => $review['profile_photo_url'] ?? null,
                    'rating' => $review['rating'] ?? null,
                    'text' => $review['text'] ?? null,
                    'relative_time_description' => $review['relative_time_description'] ?? null,
                    'time' => $review['time'] ?? null,
                ])
                ->values()
                ->all(),
        ];
    }
}
