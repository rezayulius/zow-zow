@extends('layouts.app')

@section('title', 'Digitail Account Info - PetWellness Hub')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                <i data-lucide="user-circle" class="inline-block w-10 h-10 mr-3 text-indigo-600"></i>
                Digitail Account Info
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Informasi akun dan klinik yang terhubung dengan sistem Digitail
            </p>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-400 mr-3 mt-0.5"></i>
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error') || !$success)
            <div class="mb-8 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-400 mr-3 mt-0.5"></i>
                    <div>
                        <p class="text-red-800 font-medium">Error</p>
                        <p class="text-red-700 text-sm mt-1">{{ session('error') ?? $error ?? 'Terjadi kesalahan saat mengambil data' }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($success && $userData)
            <!-- Account Information Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <i data-lucide="user" class="w-6 h-6 mr-3"></i>
                        Account Information
                    </h2>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @if(isset($userData['data']['id']))
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">User ID</label>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $userData['data']['id'] }}</p>
                            </div>
                        @endif

                        @if(isset($userData['data']['name']))
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Name</label>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $userData['data']['name'] }}</p>
                            </div>
                        @endif

                        @if(isset($userData['data']['email']))
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Email</label>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $userData['data']['email'] }}</p>
                            </div>
                        @endif

                        @if(isset($userData['data']['phone']))
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Phone</label>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $userData['data']['phone'] }}</p>
                            </div>
                        @endif

                        @if(isset($userData['data']['role']))
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Role</label>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $userData['data']['role'] }}</p>
                            </div>
                        @endif

                        @if(isset($userData['data']['status']))
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Status</label>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $userData['data']['status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($userData['data']['status']) }}
                                    </span>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Clinics Information -->
            @if(isset($userData['data']['clinics']) && count($userData['data']['clinics']) > 0)
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <i data-lucide="building-2" class="w-6 h-6 mr-3"></i>
                            Connected Clinics ({{ count($userData['data']['clinics']) }})
                        </h2>
                    </div>
                    
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($userData['data']['clinics'] as $clinic)
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                                {{ $clinic['name'] ?? 'Unknown Clinic' }}
                                            </h3>
                                            @if(isset($clinic['id']))
                                                <p class="text-sm text-gray-500 mb-2">ID: {{ $clinic['id'] }}</p>
                                            @endif
                                        </div>
                                        <div class="flex-shrink-0">
                                            <i data-lucide="hospital" class="w-8 h-8 text-emerald-600"></i>
                                        </div>
                                    </div>
                                    
                                    @if(isset($clinic['address']))
                                        <div class="mb-3">
                                            <p class="text-sm text-gray-600 flex items-start">
                                                <i data-lucide="map-pin" class="w-4 h-4 mr-2 mt-0.5 text-gray-400"></i>
                                                {{ $clinic['address'] }}
                                            </p>
                                        </div>
                                    @endif

                                    @if(isset($clinic['phone']))
                                        <div class="mb-3">
                                            <p class="text-sm text-gray-600 flex items-center">
                                                <i data-lucide="phone" class="w-4 h-4 mr-2 text-gray-400"></i>
                                                {{ $clinic['phone'] }}
                                            </p>
                                        </div>
                                    @endif

                                    @if(isset($clinic['status']))
                                        <div class="mt-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $clinic['status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($clinic['status']) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Raw Data (for debugging) -->
            @if(config('app.debug'))
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <i data-lucide="code" class="w-6 h-6 mr-3"></i>
                            Raw API Response (Debug Mode)
                        </h2>
                    </div>
                    
                    <div class="p-8">
                        <pre class="bg-gray-100 rounded-lg p-4 text-sm overflow-x-auto"><code>{{ json_encode($userData, JSON_PRETTY_PRINT) }}</code></pre>
                    </div>
                </div>
            @endif
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('digitail.patients') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300">
                <i data-lucide="users" class="w-5 h-5 mr-3"></i>
                Lihat Daftar Pasien
            </a>
            
            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-8 py-4 bg-white text-gray-700 font-semibold rounded-xl shadow-lg border border-gray-200 hover:bg-gray-50 transform hover:scale-105 transition-all duration-300">
                <i data-lucide="home" class="w-5 h-5 mr-3"></i>
                Kembali ke Home
            </a>
            
            <button onclick="window.location.reload()" 
                    class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-semibold rounded-xl shadow-lg hover:bg-emerald-700 transform hover:scale-105 transition-all duration-300">
                <i data-lucide="refresh-cw" class="w-5 h-5 mr-3"></i>
                Refresh Data
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>
@endpush
@endsection