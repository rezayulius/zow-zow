<?php

namespace App\Http\Controllers;

use App\Services\DigitailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    private $digitailService;

    public function __construct(DigitailService $digitailService)
    {
        $this->digitailService = $digitailService;
    }

    /**
     * Display user profile page
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch pet parent data from Digitail API
        $petParentData = $this->fetchPetParentByEmail($user->email);

        // Fetch pets data if pet parent is registered
        $petsData = [];
        if ($petParentData) {
            $petsData = $this->fetchPetsByOwnerId($petParentData['id']);
        }

        return view('profile.index', [
            'user' => $user,
            'petParent' => $petParentData,
            'pets' => $petsData,
            'isRegistered' => !is_null($petParentData)
        ]);
    }

    /**
     * Fetch pet parent data from Digitail API by email
     */
    private function fetchPetParentByEmail(string $email)
    {
        try {
            $baseUrl = config('services.digitail.api_base');
            $accessToken = $this->digitailService->getAccessToken();

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

    /**
     * Fetch pets data from Digitail API by owner ID
     */
    private function fetchPetsByOwnerId(int $ownerId)
    {
        try {
            $baseUrl = config('services.digitail.api_base');
            $accessToken = $this->digitailService->getAccessToken();
            $clinicId = config('services.digitail.default_clinic_id');

            $response = Http::timeout(10)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken,
                ])
                ->get($baseUrl . '/pets', [
                    'filter[clinic_id]' => $clinicId,
                    'filter[owner_id]' => $ownerId,
                    'page' => 1,
                    'per_page' => 50
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? [];
            }

            Log::warning('Failed to fetch pets from Digitail API', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return [];
        } catch (\Exception $e) {
            Log::error('Error fetching pets from Digitail API: ' . $e->getMessage());
            return [];
        }
    }
}
