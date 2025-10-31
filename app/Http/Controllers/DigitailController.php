<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DigitailController extends Controller
{
    /**
     * Display the dynamic Digitail API dashboard
     */
    public function dashboard()
    {
        $endpointGroups = [
            [
                'title' => 'Account Information',
                'description' => 'Operations related to user account and clinic information',
                'endpoints' => [
                    [
                        'method' => 'GET',
                        'path' => '/auth/me',
                        'name' => 'Get Account Information',
                        'description' => 'Retrieve authenticated user account information from Digitail API',
                        'parameters' => []
                    ]
                ]
            ],
            [
                'title' => 'Pets',
                'description' => 'Operations related to pet management and information',
                'endpoints' => [
                    [
                        'method' => 'GET',
                        'path' => '/pets',
                        'name' => 'List all Pets',
                        'description' => 'Retrieve a paginated list of all pets from the clinic',
                        'parameters' => [
                            [
                                'name' => 'page',
                                'type' => 'integer',
                                'description' => 'Page number for pagination (default: 1)'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Pet Parents',
                'description' => 'Operations related to pet parent management and information',
                'endpoints' => [
                    [
                        'method' => 'GET',
                        'path' => '/pet-parents',
                        'name' => 'List all Pet Parents',
                        'description' => 'Retrieve a paginated list of all pet parents from the clinic',
                        'parameters' => [
                            [
                                'name' => 'page',
                                'type' => 'integer',
                                'description' => 'Page number for pagination (default: 1)'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Service Packages',
                'description' => 'Operations related to service packages and pricing management',
                'endpoints' => [
                    [
                        'method' => 'GET',
                        'path' => '/service-packages',
                        'name' => 'List all Service Packages',
                        'description' => 'Retrieve a paginated list of all service packages filtered by clinic',
                        'parameters' => [
                            [
                                'name' => 'page',
                                'type' => 'integer',
                                'description' => 'Page number for pagination (default: 1)'
                            ],
                            [
                                'name' => 'clinic_id',
                                'type' => 'integer',
                                'description' => 'Filter by clinic ID (default: 562)'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return view('digitail.dashboard', compact('endpointGroups'));
    }
}