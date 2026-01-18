<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel 9 Basic Project

A basic Laravel 9 application setup with Vite for modern frontend asset bundling.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing)
- [Powerful dependency injection container](https://laravel.com/docs/container)
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent)
- Database agnostic [schema migrations](https://laravel.com/docs/migrations)
- [Robust background job processing](https://laravel.com/docs/queues)
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting)

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- **PHP** >= 8.0 (with required extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML)
- **Composer** (latest version) - [Download Composer](https://getcomposer.org/)
- **Node.js** >= 16.x and **npm** >= 8.x - [Download Node.js](https://nodejs.org/)
- **MySQL** >= 5.7 or **PostgreSQL** >= 10 (optional, for database features)

## Installation

### One-Time Project Setup (For New Projects)

If you're creating a fresh Laravel 9 project, run these commands once:

```bash
# Create a new Laravel 9 project in temporary directory
composer create-project laravel/laravel /tmp/laravel "^9.0"

# Navigate to the temporary project
cd /tmp/laravel

# Configure composer to allow insecure packages if needed
composer config audit.block-insecure false

# Install dependencies
composer install 

# Return to your project directory
cd -

# Copy all files except .git to your project
rsync -a --exclude=.git /tmp/laravel/ ./

# Clean up temporary directory
rm -rf /tmp/laravel/
```

### Setting Up an Existing Project

If you've cloned this repository or setting up an existing project:

```bash
# Install PHP dependencies
composer install

# Install frontend dependencies (JavaScript packages)
npm install

# Copy environment file
cp .env.example .env

# Generate application key (REQUIRED for encryption)
php artisan key:generate

# Create database tables (if using database)
php artisan migrate

# (Optional) Seed database with sample data
php artisan db:seed
```

## Configuration

### Environment Setup

1. **Configure Database**: Edit the `.env` file and update database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

2. **Set Application URL**: Update the APP_URL in `.env`:
   ```env
   APP_URL=http://localhost:8000
   ```

3. **Configure Mail** (if sending emails):
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=mailhog
   MAIL_PORT=1025
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_ENCRYPTION=null
   ```

## Running the Application

Laravel 9 uses **Vite** for frontend asset compilation. You'll need to run two separate processes:

### Terminal 1 - Vite Development Server (Frontend Assets)

```bash
npm run dev
```

**What it does:**
- Compiles and serves frontend assets (CSS, JavaScript)
- Runs on `http://localhost:5173`
- Provides Hot Module Replacement (HMR)
- Auto-refreshes browser when you edit `.blade.php`, `.js`, `.vue`, or `.css` files
- Must be running for styles and scripts to load correctly

### Terminal 2 - Laravel Development Server (Backend)

```bash
php artisan serve
```

**What it does:**
- Starts the Laravel PHP development server
- Runs on `http://localhost:8000`
- Serves your application and handles all backend logic
- **Visit this URL in your browser** to view your application

### Alternative: Run on Custom Port

```bash
# Run Laravel on a custom port
php artisan serve --port=8080

# Run Laravel and make it accessible from other devices on your network
php artisan serve --host=0.0.0.0 --port=8000
```

## Common Commands

### Artisan Commands

```bash
# List all available artisan commands
php artisan list

# Create a new controller
php artisan make:controller ExampleController

# Create a new model
php artisan make:model Example

# Create a model with migration
php artisan make:model Example -m

# Create a migration
php artisan make:migration create_examples_table

# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset database (drop all tables and re-run migrations)
php artisan migrate:fresh

# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Run all cache clear commands at once
php artisan optimize:clear
```

### Frontend Asset Commands

```bash
# Install npm dependencies
npm install

# Run Vite development server (with hot reload)
npm run dev

# Build assets for production
npm run build

# Update npm packages
npm update
```

### Testing

```bash
# Run all tests
php artisan test

# Run tests with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/ExampleTest.php

# Alternative PHPUnit command
./vendor/bin/phpunit
```

### Code Quality

```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Check code style without fixing
./vendor/bin/pint --test
```

## Project Structure

```
├── app/                    # Application core code
│   ├── Console/           # Artisan commands
│   ├── Exceptions/        # Exception handlers
│   ├── Http/              # Controllers, Middleware, Requests
│   ├── Models/            # Eloquent models
│   └── Providers/         # Service providers
├── bootstrap/             # Framework bootstrap files
├── config/                # Configuration files
├── database/              # Migrations, factories, seeders
├── lang/                  # Language files
├── public/                # Public assets (entry point)
├── resources/             # Views, raw assets
│   ├── css/              # CSS files (compiled by Vite)
│   ├── js/               # JavaScript files (compiled by Vite)
│   └── views/            # Blade templates
├── routes/                # Route definitions
│   ├── web.php           # Web routes
│   ├── api.php           # API routes
│   └── console.php       # Console routes
├── storage/               # Generated files, logs, cache
├── tests/                 # Automated tests
└── vendor/                # Composer dependencies
```

## Troubleshooting

### Common Issues

**Issue: "No application encryption key has been specified"**
```bash
php artisan key:generate
```

**Issue: Permission errors on storage or bootstrap/cache**
```bash
chmod -R 775 storage bootstrap/cache
```

**Issue: Assets not loading (404 errors)**
- Make sure `npm run dev` is running
- Check that Vite server is running on `http://localhost:5173`
- Clear browser cache

**Issue: Database connection errors**
- Verify database credentials in `.env`
- Ensure database exists and is running
- Clear config cache: `php artisan config:clear`

**Issue: Class not found errors**
```bash
composer dump-autoload
php artisan optimize:clear
```

## Learning Resources

- [Laravel Documentation](https://laravel.com/docs/9.x)
- [Laracasts](https://laracasts.com) - Video tutorials
- [Laravel News](https://laravel-news.com) - Latest updates
- [Laravel Bootcamp](https://bootcamp.laravel.com) - Interactive tutorial
- [Laravel Daily](https://laraveldaily.com) - Tips and tricks

## Contributing

This is a basic learning project. Feel free to fork and experiment with it.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For Laravel questions and issues:
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Forums](https://laracasts.com/discuss)
- [Laravel Discord](https://discord.gg/laravel)

