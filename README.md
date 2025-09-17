# Zow Zow - Laravel Application

## 📋 Deskripsi
Zow Zow adalah aplikasi web berbasis Laravel 11 dengan PostgreSQL sebagai database dan Tailwind CSS untuk styling.

## 🚀 Instalasi Awal

### Prerequisites
Pastikan sistem Anda sudah terinstall:
- PHP >= 8.2
- Composer
- Node.js & NPM
- PostgreSQL
- Git

### 1. Clone Repository
```bash
git clone <repository-url>
cd zow-zow
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=zow_zow_db
DB_USERNAME=postgres
DB_PASSWORD=admin
```

### 5. Database Migration
```bash
# Jalankan migration untuk membuat tabel
php artisan migrate

# (Opsional) Jalankan seeder jika ada
php artisan db:seed
```

### 6. Build Assets
```bash
# Build CSS dan JS untuk development
npm run dev

# Atau untuk production
npm run build
```

### 7. Jalankan Server
```bash
# Jalankan development server
php artisan serve
```

Aplikasi akan berjalan di: **http://127.0.0.1:8000**

## 🛠️ Fitur yang Sudah Terinstall

### Backend
- ✅ Laravel 11
- ✅ Laravel Sanctum (API Authentication)
- ✅ PostgreSQL Database
- ✅ Session Management
- ✅ Cache System
- ✅ Queue Jobs

### Development Tools
- ✅ Laravel Debugbar
- ✅ Laravel IDE Helper
- ✅ PHPUnit Testing

### Frontend
- ✅ Tailwind CSS
- ✅ Vite Build Tool
- ✅ PostCSS

## 📁 Struktur Proyek
```
zow-zow/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   ├── Repositories/     # Repository Pattern
│   ├── Services/         # Business Logic
│   └── Traits/          # Reusable Traits
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
└── routes/
```

## 🔧 Konfigurasi Keamanan

Proyek ini sudah dikonfigurasi dengan:
- CORS settings
- Rate limiting (60 requests/minute)
- Secure session cookies
- File upload limits (10MB)
- Sanctum stateful domains

## 🧪 Testing
```bash
# Jalankan semua test
php artisan test

# Jalankan test dengan coverage
php artisan test --coverage
```

## 📝 Development Commands

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Generate IDE helper files
php artisan ide-helper:generate
php artisan ide-helper:models

# Watch untuk perubahan frontend
npm run dev
```

## 🌍 Environment Variables

Konfigurasi penting di file `.env`:
- `APP_NAME`: Nama aplikasi
- `APP_URL`: URL aplikasi
- `APP_TIMEZONE`: Timezone (Asia/Jakarta)
- `DB_*`: Konfigurasi database
- `RATE_LIMIT_PER_MINUTE`: Limit request per menit
- `MAX_UPLOAD_SIZE`: Maksimal ukuran file upload

## 📞 Support

Jika mengalami masalah selama instalasi:
1. Pastikan semua prerequisites sudah terinstall
2. Periksa konfigurasi database di `.env`
3. Jalankan `composer install` dan `npm install` ulang
4. Clear cache dengan `php artisan optimize:clear`

---

**Status**: ✅ Setup awal selesai - Siap untuk development!
