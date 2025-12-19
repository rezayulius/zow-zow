<?php

namespace App\Http\Controllers;

use App\Services\DigitailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{
    private $digitailService;

    public function __construct(DigitailService $digitailService)
    {
        $this->digitailService = $digitailService;
    }

    /**
     * Display medical records history page
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch pet parent data
        $petParentData = $this->fetchPetParentByEmail($user->email);

        if (!$petParentData) {
            return redirect()->route('profile')->with('error', 'Akun Anda belum terdaftar di Digitail.');
        }

        // Fetch pets data
        $petsData = $this->fetchPetsByOwnerId($petParentData['id']);

        // Fetch medical records for all pets
        $allRecords = [];
        foreach ($petsData as $pet) {
            $records = $this->fetchRecordsByPetId($pet['id']);
            foreach ($records as $record) {
                $record['pet_info'] = $pet; // Attach pet info to each record
                $allRecords[] = $record;
            }
        }

        // Sort records by date (newest first)
        usort($allRecords, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return view('history.index', [
            'user' => $user,
            'petParent' => $petParentData,
            'pets' => $petsData,
            'records' => $allRecords
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

                foreach ($petParents as $petParent) {
                    if (strtolower($petParent['email']) === strtolower($email)) {
                        return $petParent;
                    }
                }

                return null;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Error fetching pet parents: ' . $e->getMessage());
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

            return [];
        } catch (\Exception $e) {
            Log::error('Error fetching pets: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Fetch medical records from Digitail API by pet ID
     */
    private function fetchRecordsByPetId(int $petId)
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
                ->get($baseUrl . '/records', [
                    'filter[clinic_id]' => $clinicId,
                    'filter[pet_id]' => $petId,
                    'page' => 1,
                    'per_page' => 100
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? [];
            }

            return [];
        } catch (\Exception $e) {
            Log::error('Error fetching records: ' . $e->getMessage());
            return [];
        }
    }
}
