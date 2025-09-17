<div align="center">

# 🌟 Zow Zow

**Modern Laravel Web Application**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-13+-336791?style=for-the-badge&logo=postgresql&logoColor=white)](https://postgresql.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

*A robust and scalable web application built with Laravel 12, featuring modern UI/UX design and best practices.*

[🚀 Quick Start](#-quick-start) • [📖 Documentation](#-documentation) • [🛠️ Features](#️-features) • [🤝 Contributing](#-contributing)

</div>

---

## 📖 About

Zow Zow is a modern web application built with Laravel 12, PostgreSQL, and Tailwind CSS. It follows industry best practices and provides a solid foundation for scalable web development.

### ✨ Key Highlights

- 🎯 **Modern Stack**: Laravel 12 + PostgreSQL + Tailwind CSS
- 🔒 **Secure**: Built-in authentication with Laravel Sanctum
- 🎨 **Responsive**: Mobile-first design approach
- ⚡ **Fast**: Optimized performance with Vite build tool
- 🧪 **Tested**: Comprehensive test coverage
- 📱 **PWA Ready**: Progressive Web App capabilities

## 🚀 Quick Start

### Prerequisites

Ensure your system meets these requirements:

| Requirement | Version | Status |
|-------------|---------|--------|
| PHP | >= 8.2 | ✅ Required |
| Composer | Latest | ✅ Required |
| Node.js | >= 18.x | ✅ Required |
| NPM/Yarn | Latest | ✅ Required |
| PostgreSQL | >= 13.x | ✅ Required |
| Git | Latest | ✅ Required |

### 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/zow-zow.git
   cd zow-zow
   ```

2. **Install dependencies**
   ```bash
   # Backend dependencies
   composer install
   
   # Frontend dependencies
   npm install
   ```

3. **Environment configuration**
   ```bash
   # Copy environment file
   cp .env.example .env
   
   # Generate application key
   php artisan key:generate
   ```

4. **Database setup**
   
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=zow_zow_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   # Create database tables
   php artisan migrate
   
   # Seed sample data (optional)
   php artisan db:seed
   ```

6. **Build assets**
   ```bash
   # Development build
   npm run dev
   
   # Production build
   npm run build
   ```

7. **Start the server**
   ```bash
   php artisan serve
   ```

🎉 **Success!** Your application is now running at [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 🛠️ Features

### 🔧 Backend Stack

| Component | Technology | Description |
|-----------|------------|-------------|
| **Framework** | Laravel 12 | Modern PHP framework with elegant syntax |
| **Database** | PostgreSQL | Robust relational database |
| **Authentication** | Laravel Sanctum | API token authentication |
| **Caching** | Redis/File | High-performance caching system |
| **Queue** | Database/Redis | Background job processing |
| **Testing** | PHPUnit | Comprehensive test suite |

### 🎨 Frontend Stack

| Component | Technology | Description |
|-----------|------------|-------------|
| **CSS Framework** | Tailwind CSS | Utility-first CSS framework |
| **Build Tool** | Vite | Fast build tool and dev server |
| **JavaScript** | Vanilla JS | Lightweight and performant |
| **Icons** | Heroicons | Beautiful hand-crafted SVG icons |

### 🔒 Security Features

- ✅ **CSRF Protection** - Cross-site request forgery protection
- ✅ **Rate Limiting** - API rate limiting (60 requests/minute)
- ✅ **Secure Headers** - Security headers configuration
- ✅ **Input Validation** - Comprehensive input validation
- ✅ **File Upload Security** - Secure file upload with size limits (10MB)
- ✅ **Session Security** - Secure session cookie configuration

## 📁 Project Structure

```
zow-zow/
├── 📂 app/
│   ├── 📂 Http/
│   │   ├── 📂 Controllers/     # HTTP Controllers
│   │   ├── 📂 Middleware/      # Custom Middleware
│   │   └── 📂 Requests/        # Form Requests
│   ├── 📂 Models/              # Eloquent Models
│   ├── 📂 Repositories/        # Repository Pattern
│   ├── 📂 Services/            # Business Logic Services
│   └── 📂 Traits/              # Reusable Traits
├── 📂 database/
│   ├── 📂 migrations/          # Database Migrations
│   ├── 📂 seeders/             # Database Seeders
│   └── 📂 factories/           # Model Factories
├── 📂 resources/
│   ├── 📂 css/                 # Stylesheets
│   ├── 📂 js/                  # JavaScript Files
│   ├── 📂 views/               # Blade Templates
│   └── 📂 lang/                # Localization Files
├── 📂 routes/
│   ├── 📄 web.php              # Web Routes
│   ├── 📄 api.php              # API Routes
│   └── 📄 console.php          # Console Routes
├── 📂 tests/
│   ├── 📂 Feature/             # Feature Tests
│   └── 📂 Unit/                # Unit Tests
└── 📂 public/                  # Public Assets
```

## 🧪 Testing

Run the comprehensive test suite:

```bash
# Run all tests
php artisan test

# Run tests with coverage report
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/ExampleTest.php

# Run tests in parallel
php artisan test --parallel
```

## 🚀 Development

### Available Commands

```bash
# 🧹 Clear application cache
php artisan optimize:clear

# 🔄 Generate IDE helper files
php artisan ide-helper:generate
php artisan ide-helper:models

# 👀 Watch for frontend changes
npm run dev

# 🏗️ Build for production
npm run build

# 🔍 Code analysis
php artisan insights
```

### Environment Configuration

Key environment variables in `.env`:

```env
# Application
APP_NAME="Zow Zow"
APP_ENV=local
APP_DEBUG=true
APP_TIMEZONE=Asia/Jakarta

# Database
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=zow_zow_db

# Security
RATE_LIMIT_PER_MINUTE=60
MAX_UPLOAD_SIZE=10240

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

## 📖 Documentation

- [📚 Laravel Documentation](https://laravel.com/docs)
- [🎨 Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [🐘 PostgreSQL Documentation](https://www.postgresql.org/docs/)
- [⚡ Vite Documentation](https://vitejs.dev/guide/)

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Commit** your changes (`git commit -m 'Add amazing feature'`)
4. **Push** to the branch (`git push origin feature/amazing-feature`)
5. **Open** a Pull Request

### Development Guidelines

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- Write comprehensive tests for new features
- Update documentation as needed
- Use conventional commit messages

## 🐛 Troubleshooting

### Common Issues

| Issue | Solution |
|-------|----------|
| **Composer install fails** | Run `composer install --no-dev --optimize-autoloader` |
| **NPM install fails** | Delete `node_modules` and `package-lock.json`, then run `npm install` |
| **Database connection error** | Check `.env` database credentials and ensure PostgreSQL is running |
| **Permission denied** | Run `chmod -R 775 storage bootstrap/cache` |
| **Key not found** | Run `php artisan key:generate` |

### Getting Help

- 📧 **Email**: support@zowzow.com
- 💬 **Discord**: [Join our community](https://discord.gg/zowzow)
- 🐛 **Issues**: [GitHub Issues](https://github.com/your-username/zow-zow/issues)
- 📖 **Wiki**: [Project Wiki](https://github.com/your-username/zow-zow/wiki)

## 📄 License

This project is licensed under the [MIT License](LICENSE) - see the LICENSE file for details.

## 🙏 Acknowledgments

- [Laravel Team](https://laravel.com/team) for the amazing framework
- [Tailwind Labs](https://tailwindlabs.com/) for the utility-first CSS framework
- [PostgreSQL Global Development Group](https://www.postgresql.org/) for the robust database
- All [contributors](https://github.com/your-username/zow-zow/contributors) who helped build this project

---

<div align="center">

**Made with ❤️ by the Zow Zow Team**

[![GitHub stars](https://img.shields.io/github/stars/your-username/zow-zow?style=social)](https://github.com/your-username/zow-zow/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/your-username/zow-zow?style=social)](https://github.com/your-username/zow-zow/network/members)
[![GitHub issues](https://img.shields.io/github/issues/your-username/zow-zow)](https://github.com/your-username/zow-zow/issues)

</div>
