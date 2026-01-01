<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitail API Dashboard - Dynamic</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Digitaisl API - Dynamic</h1>
                        <p class="text-sm text-gray-500">Real-time API Testing with Live Data</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- API Info -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-2">🚀 Digitail Veterinary API - Dynamic Testing</h2>
            <p class="text-gray-600 mb-4">Klik tombol di bawah untuk test endpoint API dengan data real-time. Semua
                endpoint mengambil data langsung dari server!</p>
            <div class="flex items-center space-x-4 text-sm">
                <span class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    <span>API URL: <code
                            class="bg-gray-100 px-2 py-1 rounded">https://developer.digitail.io/api/v1</code></span>
                </span>
                <span class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span>Version: 1.0.0</span>
                </span>
            </div>
        </div>

        <!-- Endpoints Grid -->
        <div class="grid gap-6">

            @foreach($endpointGroups as $group)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <!-- Group Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b">
                        <h3 class="text-lg font-bold text-gray-900">{{ $group['title'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $group['description'] }}</p>
                    </div>

                    <!-- Endpoints -->
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($group['endpoints'] as $endpoint)
                                <div
                                    class="bg-white border-2 border-gray-100 rounded-xl p-4 hover:border-blue-200 transition-all duration-200 hover:shadow-lg hover:-translate-y-1">
                                    <!-- Method Badge -->
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white
                                                                    @if($endpoint['method'] === 'GET') bg-gradient-to-r from-green-500 to-green-600
                                                                    @elseif($endpoint['method'] === 'POST') bg-gradient-to-r from-blue-500 to-blue-600
                                                                    @elseif($endpoint['method'] === 'PUT') bg-gradient-to-r from-yellow-500 to-yellow-600
                                                                    @elseif($endpoint['method'] === 'DELETE') bg-gradient-to-r from-red-500 to-red-600
                                                                    @endif">
                                            {{ $endpoint['method'] }}
                                        </span>
                                    </div>

                                    <!-- Endpoint Info -->
                                    <h4 class="font-semibold text-gray-900 mb-1">{{ $endpoint['name'] }}</h4>
                                    <p class="text-xs text-gray-500 mb-3">{{ $endpoint['description'] }}</p>
                                    <code
                                        class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded block mb-4">{{ $endpoint['path'] }}</code>

                                    <!-- Input Fields for Required Parameters -->
                                    @if($endpoint['path'] === '/pets-by-owner')
                                        <div class="mb-3">
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Owner ID (required)</label>
                                            <input type="number" id="owner-id-{{ $loop->parent->index }}-{{ $loop->index }}"
                                                placeholder="e.g., 11566"
                                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                value="11566">
                                            <p class="text-xs text-gray-500 mt-1">Enter pet parent ID to fetch their pets</p>
                                        </div>
                                    @endif

                                    @if($endpoint['path'] === '/records-by-pet')
                                        <div class="mb-3">
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Pet ID (required)</label>
                                            <input type="number" id="pet-id-{{ $loop->parent->index }}-{{ $loop->index }}"
                                                placeholder="e.g., 11521"
                                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                value="11521">
                                            <p class="text-xs text-gray-500 mt-1">Enter pet ID to fetch medical records</p>
                                        </div>
                                    @endif

                                    @if($endpoint['path'] === '/pet-parent-by-email')
                                        <div class="mb-3">
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Email (required)</label>
                                            <input type="email" id="email-{{ $loop->parent->index }}-{{ $loop->index }}"
                                                placeholder="e.g., petowner@gmail.com"
                                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                value="petowner@gmail.com">
                                            <p class="text-xs text-gray-500 mt-1">Enter email address to find pet parent</p>
                                        </div>
                                    @endif

                                    <!-- Action Button -->
                                    <div class="flex space-x-3">
                                        <button
                                            onclick="testRealEndpoint('{{ $endpoint['path'] }}', '{{ $endpoint['method'] }}', '{{ $loop->parent->index }}-{{ $loop->index }}')"
                                            class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 hover:-translate-y-0.5 text-sm font-medium">
                                            Test Real Endpoint
                                        </button>
                                    </div>

                                    <!-- Inline Result Display -->
                                    <div id="result-{{ $loop->parent->index }}-{{ $loop->index }}"
                                        class="hidden mt-4 p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center justify-between mb-3">
                                            <h4 class="font-semibold text-gray-800">API Response</h4>
                                            <button onclick="clearResponse('{{ $loop->parent->index }}-{{ $loop->index }}')"
                                                class="text-gray-500 hover:text-gray-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div id="result-content-{{ $loop->parent->index }}-{{ $loop->index }}"
                                            class="space-y-3">
                                            <!-- Result content will be populated here -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Quick Stats -->
        <div class="mt-8 grid md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white">
                <h3 class="text-lg font-bold mb-2">📊 Total Endpoints</h3>
                <p class="text-3xl font-bold">
                    {{ collect($endpointGroups)->sum(function ($group) {
    return count($group['endpoints']); }) }}
                </p>
                <p class="text-blue-100 text-sm">Ready for real testing</p>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-6 text-white">
                <h3 class="text-lg font-bold mb-2">✅ API Status</h3>
                <p class="text-3xl font-bold">Live</p>
                <p class="text-green-100 text-sm">Real-time data fetching</p>
            </div>
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl p-6 text-white">
                <h3 class="text-lg font-bold mb-2">🔧 Features</h3>
                <div class="space-y-2">
                    <div class="text-sm bg-white bg-opacity-20 rounded-lg px-3 py-2">
                        Dynamic API Calls
                    </div>
                    <div class="text-sm bg-white bg-opacity-20 rounded-lg px-3 py-2">
                        Real-time Responses
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Base URL for local API proxy calls (no CORS issues)
        const API_BASE_URL = '{{ url("/api/digitail") }}';

        // Default clinic_id for testing
        const DEFAULT_CLINIC_ID = 3536;

        async function testRealEndpoint(path, method, responseId) {
            const resultDiv = document.getElementById(`result-${responseId}`);
            const resultContent = document.getElementById(`result-content-${responseId}`);

            // Show result area
            resultDiv.classList.remove('hidden');

            // Show loading state
            resultContent.innerHTML = `
                <div class="flex items-center space-x-2 text-blue-600">
                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600"></div>
                    <span>Loading real data from API...</span>
                </div>
            `;

            try {
                // Construct full URL using local proxy
                let fullUrl = API_BASE_URL + path;

                // Add default parameters based on endpoint
                const urlParams = new URLSearchParams();

                // Handle pets-by-owner endpoint
                if (path === '/pets-by-owner') {
                    const ownerIdInput = document.getElementById(`owner-id-${responseId}`);
                    const ownerId = ownerIdInput ? ownerIdInput.value : '';

                    if (!ownerId) {
                        resultContent.innerHTML = `
                            <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                    <span class="text-red-800 font-semibold">Error: Owner ID is required</span>
                                </div>
                            </div>
                        `;
                        return;
                    }

                    urlParams.append('owner_id', ownerId);
                    urlParams.append('clinic_id', DEFAULT_CLINIC_ID);
                    urlParams.append('page', '1');
                }
                // Handle records-by-pet endpoint
                else if (path === '/records-by-pet') {
                    const petIdInput = document.getElementById(`pet-id-${responseId}`);
                    const petId = petIdInput ? petIdInput.value : '';

                    if (!petId) {
                        resultContent.innerHTML = `
                            <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                    <span class="text-red-800 font-semibold">Error: Pet ID is required</span>
                                </div>
                            </div>
                        `;
                        return;
                    }

                    urlParams.append('pet_id', petId);
                    urlParams.append('clinic_id', DEFAULT_CLINIC_ID);
                    urlParams.append('page', '1');
                }
                // Handle pet-parent-by-email endpoint
                else if (path === '/pet-parent-by-email') {
                    const emailInput = document.getElementById(`email-${responseId}`);
                    const email = emailInput ? emailInput.value : '';

                    if (!email) {
                        resultContent.innerHTML = `
                            <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                    <span class="text-red-800 font-semibold">Error: Email is required</span>
                                </div>
                            </div>
                        `;
                        return;
                    }

                    urlParams.append('email', email);
                }
                // Handle other endpoints
                else if (path.includes('/pets')) {
                    urlParams.append('page', '1');
                    urlParams.append('clinic_id', DEFAULT_CLINIC_ID);
                } else if (path.includes('/pet-parents')) {
                    urlParams.append('page', '1');
                }

                if (urlParams.toString()) {
                    fullUrl += '?' + urlParams.toString();
                }

                // Prepare request options (no need for Authorization header as it's handled by backend)
                const requestOptions = {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                };

                console.log('Making API request to local proxy:', fullUrl);
                console.log('Request options:', requestOptions);

                const response = await fetch(fullUrl, requestOptions);

                // Get response as JSON (proxy always returns JSON)
                const proxyResponse = await response.json();

                // Display response based on proxy response
                if (proxyResponse.success) {
                    displaySuccessResponse(resultContent, response, proxyResponse, fullUrl);
                } else {
                    displayErrorResponse(resultContent, response, proxyResponse, fullUrl);
                }

            } catch (error) {
                console.error('API request failed:', error);
                displayNetworkError(resultContent, error);
            }
        }

        function displaySuccessResponse(container, response, proxyData, url) {
            const actualStatus = proxyData.status || response.status;
            const actualData = proxyData.data || proxyData;

            container.innerHTML = `
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-green-800 font-semibold">Status: ${actualStatus} Success</span>
                    </div>
                </div>
                <div class="mt-3">
                    <h5 class="text-sm font-semibold text-gray-700 mb-2">Request URL (via proxy):</h5>
                    <code class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded block">${url}</code>
                </div>
                <div class="mt-3">
                    <h5 class="text-sm font-semibold text-gray-700 mb-2">API Response Data:</h5>
                    <pre class="text-xs bg-gray-900 text-green-400 p-3 rounded overflow-x-auto max-h-64">${JSON.stringify(actualData, null, 2)}</pre>
                </div>
                <div class="mt-3">
                    <h5 class="text-sm font-semibold text-gray-700 mb-2">Proxy Info:</h5>
                    <div class="text-xs text-gray-600">
                        <div>Success: ${proxyData.success ? 'Yes' : 'No'}</div>
                        <div>API Status: ${proxyData.status || 'Unknown'}</div>
                        <div>Via: Laravel Proxy (CORS-free)</div>
                    </div>
                </div>
            `;
        }

        function displayErrorResponse(container, response, proxyData, url) {
            const actualStatus = proxyData.status || response.status;
            const errorMessage = proxyData.message || proxyData.error || 'Unknown error';
            const errorData = proxyData.data || proxyData;

            container.innerHTML = `
                <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <span class="text-red-800 font-semibold">Error: ${actualStatus} - ${errorMessage}</span>
                    </div>
                </div>
                <div class="mt-3">
                    <h5 class="text-sm font-semibold text-gray-700 mb-2">Request URL (via proxy):</h5>
                    <code class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded block">${url}</code>
                </div>
                <div class="mt-3">
                    <h5 class="text-sm font-semibold text-gray-700 mb-2">Error Response:</h5>
                    <pre class="text-xs bg-gray-900 text-red-400 p-3 rounded overflow-x-auto max-h-64">${JSON.stringify(errorData, null, 2)}</pre>
                </div>
                <div class="mt-3">
                    <h5 class="text-sm font-semibold text-gray-700 mb-2">Troubleshooting:</h5>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>• Check if the API endpoint is accessible</li>
                        <li>• Verify authentication credentials in .env</li>
                        <li>• Check if the clinic_id is valid</li>
                        <li>• Ensure Bearer token is not expired</li>
                        <li>• Check Laravel logs for detailed error info</li>
                    </ul>
                </div>
            `;
        }

        function displayNetworkError(container, error) {
            container.innerHTML = `
                <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <span class="text-red-800 font-semibold">Network Error: ${error.message}</span>
                    </div>
                </div>
                <div class="mt-3">
                    <h5 class="text-sm font-semibold text-gray-700 mb-2">Troubleshooting:</h5>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>• Check your internet connection</li>
                        <li>• Verify the API server is running</li>
                        <li>• Check for CORS issues in browser console</li>
                        <li>• Ensure the API URL is correct</li>
                    </ul>
                </div>
                <div class="mt-3">
                    <h5 class="text-sm font-semibold text-gray-700 mb-2">Technical Details:</h5>
                    <div class="text-xs text-gray-600">
                        <div>Error Type: ${error.name}</div>
                        <div>Error Message: ${error.message}</div>
                    </div>
                </div>
            `;
        }

        function clearResponse(responseId) {
            const resultDiv = document.getElementById(`result-${responseId}`);
            resultDiv.classList.add('hidden');
        }

        // Add some helpful console logging
        console.log('🚀 Digitail Dynamic Dashboard loaded');
        console.log('📡 API Proxy URL:', API_BASE_URL);
        console.log('🏥 Default Clinic ID:', DEFAULT_CLINIC_ID);
        console.log('✅ Using Laravel proxy to avoid CORS issues');
    </script>
</body>

</html>
