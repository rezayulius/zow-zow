# Digitail API Integration - Laravel Implementation

## 📋 Overview

Implementasi integrasi API Digitail menggunakan Laravel dengan pendekatan **Proxy Pattern** untuk keamanan dan kontrol yang optimal. Dashboard dinamis memungkinkan testing endpoint API secara real-time melalui interface web yang user-friendly.

## 🏗️ Architecture

### Proxy Pattern Implementation
- **Frontend** → **Laravel Proxy** → **Digitail API**
- Bearer token disembunyikan dari frontend
- Server-side validation dan error handling
- Rate limiting dan request control

## 📁 File Structure

```
app/Http/Controllers/
├── DigitailController.php          # Main dashboard controller
└── DigitailApiController.php       # API proxy controller

resources/views/digitail/
└── dynamic-dashboard.blade.php     # Dynamic API testing interface

routes/
└── web.php                         # Digitail routes configuration

.env                                # Environment variables
```

## ⚙️ Environment Setup

### Required Environment Variables

```env
# Digitail API Configuration
DIGITAIL_API_BASE_URL=https://api.digitail.com
DIGITAIL_ACCESS_TOKEN=your_bearer_token_here
DIGITAIL_DEFAULT_CLINIC_ID=your_clinic_id_here
DIGITAIL_API_TIMEOUT=30
```

### Installation Steps

1. **Clone dan Install Dependencies**
   ```bash
   composer install
   npm install
   ```

2. **Environment Configuration**
   ```bash
   cp .env.example .env
   # Edit .env file dengan credentials Digitail API
   ```

3. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

4. **Start Development Server**
   ```bash
   php artisan serve --port=3000
   ```

## 🛠️ Implementation Details

### 1. DigitailController.php

**Purpose**: Menampilkan dashboard utama dengan daftar endpoint yang tersedia.

**Key Features**:
- Menyediakan view untuk dynamic dashboard
- Mendefinisikan struktur endpoint groups
- Tidak menangani logic API (separation of concerns)

**Endpoints Structure**:
```php
$endpointGroups = [
    'Authentication' => [
        ['name' => 'Get User Info', 'endpoint' => 'auth/me', 'method' => 'GET']
    ],
    'Pets Management' => [
        ['name' => 'Get Pets', 'endpoint' => 'pets', 'method' => 'GET']
    ],
    'Pet Parents' => [
        ['name' => 'Get Pet Parents', 'endpoint' => 'pet-parents', 'method' => 'GET']
    ]
];
```

### 2. DigitailApiController.php

**Purpose**: Proxy controller yang menangani semua komunikasi dengan Digitail API.

**Key Features**:
- ✅ **Secure Token Management**: Bearer token disembunyikan dari frontend
- ✅ **HTTP Client Optimization**: Reusable HTTP client dengan default headers
- ✅ **Centralized Error Handling**: Consistent error responses
- ✅ **Response Formatting**: Standardized API response structure
- ✅ **Multiple HTTP Methods**: Support GET, POST, PUT, DELETE, PATCH

**Helper Methods**:
```php
// HTTP Client dengan default configuration
private function createHttpClient(): Client

// Standardized response formatting
private function formatResponse($data, $status = 200): JsonResponse

// Centralized error handling dan logging
private function handleError($e, string $context): JsonResponse
```

**Specific Endpoints**:
- `GET /digitail/api/auth/me` - User authentication info
- `GET /digitail/api/pets` - Pets list dengan pagination
- `GET /digitail/api/pet-parents` - Pet parents list
- `ANY /digitail/api/{endpoint}` - Generic proxy untuk semua endpoint

### 3. Dynamic Dashboard Interface

**File**: `resources/views/digitail/dynamic-dashboard.blade.php`

**Features**:
- 🎨 **Modern UI**: Bootstrap-based responsive design
- 🔄 **Real-time Testing**: AJAX-based API calls
- 📊 **Response Display**: JSON formatting dengan syntax highlighting
- ⚡ **Loading States**: Visual feedback untuk user experience
- 🎯 **Error Handling**: User-friendly error messages

**UI Components**:
- Endpoint grouping untuk better organization
- Request/Response tabs
- HTTP method indicators
- Status code display
- Response time tracking

## 🔒 Security Implementation

### 1. Token Protection
```php
// Bearer token hanya ada di server-side
$headers = [
    'Authorization' => 'Bearer ' . config('services.digitail.access_token'),
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
];
```

### 2. Request Validation
- Server-side parameter validation
- HTTP method verification
- Endpoint whitelist (jika diperlukan)

### 3. Error Handling
```php
// Tidak expose sensitive information ke frontend
catch (Exception $e) {
    Log::error("Digitail API Error: {$context}", [
        'error' => $e->getMessage(),
        'endpoint' => $endpoint
    ]);
    
    return $this->formatResponse([
        'error' => 'API request failed',
        'message' => 'Please try again later'
    ], 500);
}
```

## 🚀 Usage Guide

### 1. Accessing Dashboard
```
http://localhost:3000/digitail/dynamic
```

### 2. Testing Endpoints
1. Pilih endpoint dari daftar yang tersedia
2. Klik "Test Endpoint" untuk menjalankan request
3. Lihat response di tab "Response"
4. Check status code dan response time

### 3. API Proxy Usage
```javascript
// Frontend AJAX call example
fetch('/digitail/api/pets?page=1&limit=10')
    .then(response => response.json())
    .then(data => console.log(data));
```

## 📊 API Endpoints

### Authentication
- **GET** `/digitail/api/auth/me` - Get authenticated user info

### Pets Management
- **GET** `/digitail/api/pets` - Get pets list
  - Query params: `page`, `limit`, `clinic_id`

### Pet Parents
- **GET** `/digitail/api/pet-parents` - Get pet parents list
  - Query params: `page`, `limit`

### Generic Proxy
- **ANY** `/digitail/api/{endpoint}` - Proxy untuk endpoint lainnya
  - Supports: GET, POST, PUT, DELETE, PATCH
  - Automatic parameter forwarding

## 🔧 Configuration

### HTTP Client Settings
```php
'timeout' => config('services.digitail.timeout', 30),
'verify' => true, // SSL verification
'headers' => [
    'Authorization' => 'Bearer ' . $accessToken,
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
]
```

### Default Parameters
```php
'clinic_id' => config('services.digitail.default_clinic_id')
```

## 🧪 Testing

### Manual Testing via Dashboard
1. Buka `http://localhost:3000/digitail/dynamic`
2. Test setiap endpoint yang tersedia
3. Verify response format dan status codes

### API Testing via Postman/curl
```bash
# Test melalui proxy
curl -X GET "http://localhost:3000/digitail/api/auth/me"

# Test dengan parameters
curl -X GET "http://localhost:3000/digitail/api/pets?page=1&limit=5"
```

## 🚨 Troubleshooting

### Common Issues

1. **401 Unauthorized**
   - Check `DIGITAIL_ACCESS_TOKEN` di .env
   - Verify token masih valid

2. **500 Internal Server Error**
   - Check Laravel logs: `storage/logs/laravel.log`
   - Verify API base URL dan network connectivity

3. **CORS Issues**
   - Proxy pattern mengatasi CORS secara otomatis
   - Tidak perlu additional CORS configuration

4. **Timeout Errors**
   - Adjust `DIGITAIL_API_TIMEOUT` di .env
   - Check network connectivity ke Digitail API

### Debug Mode
```php
// Enable di .env untuk detailed error messages
APP_DEBUG=true
LOG_LEVEL=debug
```

## 📈 Performance Optimization

### 1. HTTP Client Reuse
- Single HTTP client instance per request
- Connection pooling untuk better performance

### 2. Response Caching (Optional)
```php
// Implementasi caching jika diperlukan
Cache::remember("digitail_pets_{$page}", 300, function() {
    return $this->getPets($page);
});
```

### 3. Request Optimization
- Minimal data transfer
- Efficient parameter handling
- Proper error responses

## 🔄 Future Enhancements

### Planned Features
- [ ] Request caching implementation
- [ ] Rate limiting per user
- [ ] API response caching
- [ ] Webhook support
- [ ] Batch operations
- [ ] Advanced filtering options

### Scalability Considerations
- Database caching untuk frequently accessed data
- Redis implementation untuk session management
- Load balancing untuk high traffic
- API versioning support

## 📝 Changelog

### v1.0.0 (Current)
- ✅ Initial proxy implementation
- ✅ Dynamic dashboard interface
- ✅ Security best practices
- ✅ Error handling dan logging
- ✅ Responsive UI design
- ✅ Code optimization dan cleanup

## 👥 Contributing

### Code Standards
- Follow PSR-12 coding standards
- Use meaningful variable names
- Add proper documentation
- Implement proper error handling

### Git Workflow
```bash
git checkout -b feature/new-endpoint
# Make changes
git commit -m "feat: add new endpoint support"
git push origin feature/new-endpoint
```

## 📞 Support

Untuk pertanyaan atau issues:
1. Check troubleshooting section
2. Review Laravel logs
3. Test API endpoints manually
4. Contact development team

---

**Last Updated**: January 2025  
**Version**: 1.0.0  
**Laravel Version**: 11.x  
**PHP Version**: 8.2+