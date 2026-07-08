@extends('layouts.app')

@section('title', 'Digitail Patients Management - PetWellness Hub')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                <i data-lucide="users" class="inline-block w-10 h-10 mr-3 text-indigo-600"></i>
                Digitail Patients Management
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Kelola data pasien melalui integrasi dengan sistem Digitail
            </p>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex">
                    <i data-lucide="circle-check-big" class="w-5 h-5 text-green-400 mr-3 mt-0.5"></i>
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error') || !$success)
            <div class="mb-8 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex">
                    <i data-lucide="circle-alert" class="w-5 h-5 text-red-400 mr-3 mt-0.5"></i>
                    <div>
                        <p class="text-red-800 font-medium">Error</p>
                        <p class="text-red-700 text-sm mt-1">{{ session('error') ?? $error ?? 'Terjadi kesalahan saat mengambil data' }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Action Bar -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-semibold text-gray-900">Daftar Pasien</h2>
                    @if(isset($clinicId))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Clinic ID: {{ $clinicId }}
                        </span>
                    @endif
                </div>
                
                <div class="flex items-center gap-3">
                    <button onclick="openAddModal()" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300">
                        <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                        Tambah Pasien
                    </button>
                    
                    <a href="{{ route('digitail.me') }}" 
                       class="inline-flex items-center px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg shadow-lg border border-gray-200 hover:bg-gray-50 transform hover:scale-105 transition-all duration-300">
                        <i data-lucide="circle-user" class="w-5 h-5 mr-2"></i>
                        Account Info
                    </a>
                    
                    <button onclick="window.location.reload()" 
                            class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg shadow-lg hover:bg-emerald-700 transform hover:scale-105 transition-all duration-300">
                        <i data-lucide="refresh-cw" class="w-5 h-5 mr-2"></i>
                        Refresh
                    </button>
                </div>
            </div>
        </div>

        @if($success && $patientsData)
            <!-- Patients Table -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient Info</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Species & Breed</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(isset($patientsData['data']) && count($patientsData['data']) > 0)
                                @foreach($patientsData['data'] as $patient)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-12 w-12">
                                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                                        <i data-lucide="heart" class="w-6 h-6 text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $patient['name'] ?? 'Unknown' }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        ID: {{ $patient['id'] ?? 'N/A' }}
                                                    </div>
                                                    @if(isset($patient['gender']))
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                                            {{ $patient['gender'] === 'male' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                                            {{ ucfirst($patient['gender']) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $patient['species'] ?? 'Unknown' }}</div>
                                            <div class="text-sm text-gray-500">{{ $patient['breed'] ?? 'Mixed' }}</div>
                                            @if(isset($patient['color']))
                                                <div class="text-xs text-gray-400">Color: {{ $patient['color'] }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $patient['owner']['name'] ?? 'Unknown Owner' }}
                                            </div>
                                            @if(isset($patient['owner']['phone']))
                                                <div class="text-sm text-gray-500">{{ $patient['owner']['phone'] }}</div>
                                            @endif
                                            @if(isset($patient['owner']['email']))
                                                <div class="text-xs text-gray-400">{{ $patient['owner']['email'] }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if(isset($patient['birth_date']))
                                                <div>Born: {{ date('d/m/Y', strtotime($patient['birth_date'])) }}</div>
                                            @endif
                                            @if(isset($patient['weight']))
                                                <div>Weight: {{ $patient['weight'] }}kg</div>
                                            @endif
                                            @if(isset($patient['microchip']))
                                                <div class="text-xs">Chip: {{ $patient['microchip'] }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-2">
                                                <button onclick="openEditModal({{ json_encode($patient) }})" 
                                                        class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded-md hover:bg-indigo-700 transition-colors duration-200">
                                                    <i data-lucide="square-pen" class="w-3 h-3 mr-1"></i>
                                                    Edit
                                                </button>
                                                <button onclick="confirmDelete({{ $patient['id'] ?? 0 }})" 
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-md hover:bg-red-700 transition-colors duration-200">
                                                    <i data-lucide="trash-2" class="w-3 h-3 mr-1"></i>
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <i data-lucide="users" class="w-12 h-12 text-gray-400 mb-4"></i>
                                            <p class="text-gray-500 text-lg">Tidak ada data pasien ditemukan</p>
                                            <p class="text-gray-400 text-sm mt-2">Klik "Tambah Pasien" untuk menambahkan pasien baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination (if available) -->
            @if(isset($patientsData['meta']) && isset($patientsData['meta']['pagination']))
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing {{ $patientsData['meta']['pagination']['current_page'] ?? 1 }} of {{ $patientsData['meta']['pagination']['total_pages'] ?? 1 }} pages
                        </div>
                        <div class="text-sm text-gray-500">
                            Total: {{ $patientsData['meta']['pagination']['total'] ?? 0 }} patients
                        </div>
                    </div>
                </div>
            @endif

            <!-- Raw Data (for debugging) -->
            @if(config('app.debug'))
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mt-8">
                    <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-8 py-6">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i data-lucide="code" class="w-5 h-5 mr-3"></i>
                            Raw API Response (Debug Mode)
                        </h2>
                    </div>
                    
                    <div class="p-8">
                        <pre class="bg-gray-100 rounded-lg p-4 text-sm overflow-x-auto"><code>{{ json_encode($patientsData, JSON_PRETTY_PRINT) }}</code></pre>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

<!-- Add Patient Modal -->
<div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-2xl bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i data-lucide="circle-plus" class="w-6 h-6 mr-3 text-indigo-600"></i>
                    Tambah Pasien Baru
                </h3>
                <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            
            <form action="{{ route('digitail.patients.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="clinic_id" value="{{ $clinicId }}">
                
                <!-- Patient Information -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pasien</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pasien *</label>
                            <input type="text" name="name" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Spesies *</label>
                            <select name="species" required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Spesies</option>
                                <option value="Dog">Anjing</option>
                                <option value="Cat">Kucing</option>
                                <option value="Bird">Burung</option>
                                <option value="Rabbit">Kelinci</option>
                                <option value="Hamster">Hamster</option>
                                <option value="Fish">Ikan</option>
                                <option value="Other">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ras</label>
                            <input type="text" name="breed" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin *</label>
                            <select name="gender" required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="male">Jantan</option>
                                <option value="female">Betina</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                            <input type="date" name="birth_date" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Berat (kg)</label>
                            <input type="number" name="weight" step="0.1" min="0" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                            <input type="text" name="color" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Microchip</label>
                            <input type="text" name="microchip" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                </div>

                <!-- Owner Information -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pemilik</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemilik *</label>
                            <input type="text" name="owner_name" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" name="owner_phone" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="owner_email" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="owner_address" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeAddModal()" 
                            class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200">
                        Simpan Pasien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Patient Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-2xl bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i data-lucide="square-pen" class="w-6 h-6 mr-3 text-indigo-600"></i>
                    Edit Pasien
                </h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            
            <form id="editForm" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Patient Information -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pasien</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pasien *</label>
                            <input type="text" name="name" id="edit_name" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Spesies *</label>
                            <select name="species" id="edit_species" required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Spesies</option>
                                <option value="Dog">Anjing</option>
                                <option value="Cat">Kucing</option>
                                <option value="Bird">Burung</option>
                                <option value="Rabbit">Kelinci</option>
                                <option value="Hamster">Hamster</option>
                                <option value="Fish">Ikan</option>
                                <option value="Other">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ras</label>
                            <input type="text" name="breed" id="edit_breed" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin *</label>
                            <select name="gender" id="edit_gender" required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="male">Jantan</option>
                                <option value="female">Betina</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                            <input type="date" name="birth_date" id="edit_birth_date" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Berat (kg)</label>
                            <input type="number" name="weight" id="edit_weight" step="0.1" min="0" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                            <input type="text" name="color" id="edit_color" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Microchip</label>
                            <input type="text" name="microchip" id="edit_microchip" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                </div>

                <!-- Owner Information -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pemilik</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemilik *</label>
                            <input type="text" name="owner_name" id="edit_owner_name" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" name="owner_phone" id="edit_owner_phone" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="owner_email" id="edit_owner_email" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="owner_address" id="edit_owner_address" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeEditModal()" 
                            class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200">
                        Update Pasien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Modal functions
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openEditModal(patient) {
        // Populate form fields
        document.getElementById('edit_name').value = patient.name || '';
        document.getElementById('edit_species').value = patient.species || '';
        document.getElementById('edit_breed').value = patient.breed || '';
        document.getElementById('edit_gender').value = patient.gender || '';
        document.getElementById('edit_birth_date').value = patient.birth_date || '';
        document.getElementById('edit_weight').value = patient.weight || '';
        document.getElementById('edit_color').value = patient.color || '';
        document.getElementById('edit_microchip').value = patient.microchip || '';
        
        // Owner information
        if (patient.owner) {
            document.getElementById('edit_owner_name').value = patient.owner.name || '';
            document.getElementById('edit_owner_phone').value = patient.owner.phone || '';
            document.getElementById('edit_owner_email').value = patient.owner.email || '';
            document.getElementById('edit_owner_address').value = patient.owner.address || '';
        }
        
        // Set form action
        document.getElementById('editForm').action = `/digitail/patients/${patient.id}`;
        
        // Show modal
        document.getElementById('editModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function confirmDelete(patientId) {
        if (confirm('Apakah Anda yakin ingin menghapus pasien ini? Tindakan ini tidak dapat dibatalkan.')) {
            // Create form for DELETE request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/digitail/patients/${patientId}`;
            
            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken.getAttribute('content');
                form.appendChild(csrfInput);
            }
            
            // Add method override for DELETE
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            // Submit form
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');
        
        if (event.target === addModal) {
            closeAddModal();
        }
        if (event.target === editModal) {
            closeEditModal();
        }
    }

    // Close modals with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });
</script>
@endpush
@endsection