<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display user profile page
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch pet parent data from Digitail API
        $petParentData = $this->fetchPetParentByEmail($user->email);

        return view('profile.index', [
            'user' => $user,
            'petParent' => $petParentData,
            'isRegistered' => !is_null($petParentData)
        ]);
    }

    /**
     * Fetch pet parent data from Digitail API by email
     */
    private function fetchPetParentByEmail(string $email)
    {
        try {
            $baseUrl = config('app.digitail_api_base', env('DIGITAIL_API_BASE'));
            $accessToken = env('DIGITAIL_ACCESS_TOKEN');

            $response = Http::timeout(10)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken,
                ])
                ->get($baseUrl . '/pet-parents');

            if ($response->successful()) {
                $data = $response->json();
                $petParents = $data['data'] ?? [];

                // Find pet parent by email
                foreach ($petParents as $petParent) {
                    if (strtolower($petParent['email']) === strtolower($email)) {
                        return $petParent;
                    }
                }

                return null; // Not found
            }

            Log::warning('Failed to fetch pet parents from Digitail API', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Error fetching pet parents from Digitail API: ' . $e->getMessage());
            return null;
        }
    }
}
