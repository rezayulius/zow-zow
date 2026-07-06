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
                            ],
                            [
                                'name' => 'clinic_id',
                                'type' => 'integer',
                                'description' => 'Filter by clinic ID (default: 562)'
                            ]
                        ]
                    ],
                    [
                        'method' => 'GET',
                        'path' => '/pets-by-owner',
                        'name' => 'Get Pets by Owner',
                        'description' => 'Retrieve all pets owned by a specific pet parent',
                        'parameters' => [
                            [
                                'name' => 'owner_id',
                                'type' => 'integer',
                                'description' => 'Pet parent ID (required)'
                            ],
                            [
                                'name' => 'clinic_id',
                                'type' => 'integer',
                                'description' => 'Filter by clinic ID (default: 562)'
                            ],
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
                    ],
                    [
                        'method' => 'GET',
                        'path' => '/pet-parent-by-email',
                        'name' => 'Get Pet Parent by Email',
                        'description' => 'Find a specific pet parent by their email address',
                        'parameters' => [
                            [
                                'name' => 'email',
                                'type' => 'string',
                                'description' => 'Pet parent email address (required)'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Medical Records',
                'description' => 'Operations related to medical records and visit history',
                'endpoints' => [
                    [
                        'method' => 'GET',
                        'path' => '/records-by-pet',
                        'name' => 'Get Records by Pet',
                        'description' => 'Retrieve all medical records for a specific pet',
                        'parameters' => [
                            [
                                'name' => 'pet_id',
                                'type' => 'integer',
                                'description' => 'Pet ID (required)'
                            ],
                            [
                                'name' => 'clinic_id',
                                'type' => 'integer',
                                'description' => 'Filter by clinic ID (default: 562)'
                            ],
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
            ],
            [
                'title' => 'Veterinarians',
                'description' => 'Operations related to veterinarians and staff management',
                'endpoints' => [
                    [
                        'method' => 'GET',
                        'path' => '/vets',
                        'name' => 'List all Vets',
                        'description' => 'Retrieve a paginated list of all veterinarians filtered by clinic',
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
                    ],
                    [
                        'method' => 'GET',
                        'path' => '/vet-schedule',
                        'name' => 'Retrieve Vet Schedule',
                        'description' => 'Retrieve a veterinarian\'s available schedule for a date range and visit type',
                        'parameters' => [
                            [
                                'name' => 'vet_id',
                                'type' => 'integer',
                                'description' => 'Veterinarian ID (required)'
                            ],
                            [
                                'name' => 'start_date',
                                'type' => 'date',
                                'description' => 'Schedule range start date, format YYYY-MM-DD (required)'
                            ],
                            [
                                'name' => 'end_date',
                                'type' => 'date',
                                'description' => 'Schedule range end date, format YYYY-MM-DD (required)'
                            ],
                            [
                                'name' => 'visit_type_id',
                                'type' => 'integer',
                                'description' => 'Visit type ID (required)'
                            ],
                            [
                                'name' => 'clinic_id',
                                'type' => 'integer',
                                'description' => 'Filter by clinic ID (default: 562)'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Visit Types',
                'description' => 'Operations related to visit type management',
                'endpoints' => [
                    [
                        'method' => 'GET',
                        'path' => '/visit-types',
                        'name' => 'List all Visit Types',
                        'description' => 'Retrieve a paginated list of all visit types filtered by clinic',
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