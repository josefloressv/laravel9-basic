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

## Deployment (Laravel Cloud) — POC / Dev Environment

This repository is deployed to **Laravel Cloud** as a short-lived POC environment.

### Why not SQLite on Laravel Cloud
Laravel Cloud environments use an **ephemeral filesystem**, so SQLite files are not reliable across deploys/restarts/hibernation. We use a managed database instead.

### Cost awareness (important)
Before creating resources, review the Laravel Cloud pricing calculator:
- https://cloud.laravel.com/pricing/calculator

To reduce costs for this POC, **hibernation** was enabled:
- App hibernation: **2 minutes**
- Database hibernation: **2 minutes**

### Required environment variables (Cloud)
Set these in Laravel Cloud Environment Variables (do not commit a production `.env`):
- `APP_ENV=dev`
- `APP_DEBUG=true`
- `APP_KEY=base64:...`
- `APP_URL=https://...`

Database is configured via Cloud-provided Postgres variables:
- `DB_CONNECTION=pgsql`
- `DB_HOST=...`
- `DB_PORT=5432`
- `DB_DATABASE=...`
- `DB_USERNAME=...`
- `DB_PASSWORD=...`

### Build & deploy commands (Laravel Cloud)

**Build commands:**
```bash
composer install --no-interaction --prefer-dist --optimize-autoloader
npm ci --no-audit
npm run build
php artisan optimize
```

**Deploy commands:**
```bash
php artisan migrate --force
```

**Seeder notes (POC/dev)**
- This environment is dev/POC, and we intentionally allow running seeders after deploy.
- Because seeders/factories use Faker (a dev dependency), we removed --no-dev from the Cloud composer install build command. Without that change, seeding fails with Class "Faker\Factory" not found.
- After a successful deploy, seed data can be created via the Laravel Cloud Commands tab:
```bash
php artisan db:seed --force
# or run a specific seeder:
php artisan db:seed --class=UserSeeder --force
```

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

## Authentication with Laravel Breeze

This project uses **Laravel Breeze** for authentication scaffolding. Breeze provides a minimal, simple implementation of all of Laravel's authentication features, including login, registration, password reset, email verification, and password confirmation.

### What is Laravel Breeze?

Laravel Breeze is a lightweight authentication starter kit that includes:

- **Login & Registration**: Complete user authentication system
- **Password Reset**: Forgot password functionality
- **Email Verification**: Optional email verification for new users
- **Profile Management**: User profile update pages
- **Pre-built Views**: Blade templates styled with Tailwind CSS
- **Routes & Controllers**: Ready-to-use authentication routes and logic
- **Modern Frontend**: Uses Vite for asset compilation

### Installation Steps

#### 1. Install Breeze Package

```bash
composer require laravel/breeze --dev
```

This installs Laravel Breeze as a dev dependency since it's primarily a scaffolding tool.

#### 2. Install Breeze Scaffolding

```bash
php artisan breeze:install
```

**During installation, you'll be prompted to choose:**

1. **Stack Selection:**
   - `blade` - Blade templates with Alpine.js (recommended for beginners)
   - `vue` - Vue.js with Inertia.js
   - `react` - React with Inertia.js
   - `api` - API-only authentication (no views)

2. **Dark Mode Support:**
   - Choose whether to include dark mode support

3. **Testing Framework:**
   - Choose between Pest or PHPUnit

**What breeze:install does:**
- Installs authentication views, routes, and controllers
- Publishes Tailwind CSS configuration
- Updates `package.json` with frontend dependencies
- Creates authentication-related migrations
- Adds authentication routes to `routes/web.php`

#### 3. Install Frontend Dependencies

```bash
npm install
```

This installs Tailwind CSS and other frontend dependencies defined by Breeze.

#### 4. Run Migrations

```bash
php artisan migrate
```

This creates the necessary database tables for authentication (users, password resets, etc.).

#### 5. Build Frontend Assets

```bash
npm run dev
```

Compiles CSS and JavaScript files using Vite with hot reload for development.

### Authentication Features

After installation, Breeze provides these routes:

| Route | Purpose | URL |
|-------|---------|-----|
| Register | Create new account | `/register` |
| Login | User login | `/login` |
| Dashboard | Protected user area | `/dashboard` |
| Logout | End user session | POST to `/logout` |
| Forgot Password | Request password reset | `/forgot-password` |
| Reset Password | Reset password with token | `/reset-password` |
| Profile | Edit user profile | `/profile` |
| Email Verification | Verify email address | `/verify-email` |

### Using Authentication in Your App

#### Protecting Routes

**In routes/web.php:**

```php
use App\Http\Controllers\PostController;

// Public routes (anyone can access)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::post('/blog', [PostController::class, 'store'])->name('blog.store');
    Route::put('/blog/{post}', [PostController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{post}', [PostController::class, 'destroy'])->name('blog.destroy');
});

// Routes that require verified email
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/premium', function () {
        return view('premium');
    });
});
```

#### In Controllers

**Check if user is authenticated:**

```php
use Illuminate\Support\Facades\Auth;

// Method 1: Using Auth facade
if (Auth::check()) {
    $user = Auth::user();
    echo "Welcome, {$user->name}!";
}

// Method 2: Using auth() helper
if (auth()->check()) {
    $userId = auth()->id();
    $userName = auth()->user()->name;
}

// Method 3: Using $request
public function store(Request $request)
{
    $user = $request->user();
    
    Post::create([
        'user_id' => $user->id,
        'title' => $request->title,
        'slug' => $request->slug,
        'body' => $request->body,
    ]);
}
```

#### In Blade Templates

**Check authentication status:**

```blade
@auth
    {{-- User is logged in --}}
    <p>Welcome back, {{ auth()->user()->name }}!</p>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endauth

@guest
    {{-- User is not logged in --}}
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
@endguest

{{-- Show content only to authenticated users --}}
@auth
    <a href="{{ route('blog.create') }}">Create Post</a>
@endauth

{{-- Check if user is specific user --}}
@if(auth()->check() && auth()->id() === $post->user_id)
    <a href="{{ route('blog.edit', $post) }}">Edit</a>
@endif
```

#### Creating Posts with Authenticated User

**In Controller:**

```php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        
        $post = Post::create([
            'user_id' => auth()->id(),  // Automatically set to logged-in user
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'body' => $validated['body'],
        ]);
        
        return redirect()->route('blog.show', $post->slug);
    }
    
    public function update(Request $request, Post $post)
    {
        // Ensure only the post owner can update
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        
        $post->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'body' => $validated['body'],
        ]);
        
        return redirect()->route('blog.show', $post->slug);
    }
}
```

### Customizing Breeze

#### Customizing Views

All Breeze views are published to your project, so you can customize them:

```
resources/views/
├── auth/
│   ├── login.blade.php
│   ├── register.blade.php
│   ├── forgot-password.blade.php
│   ├── reset-password.blade.php
│   └── verify-email.blade.php
├── layouts/
│   ├── app.blade.php
│   ├── guest.blade.php
│   └── navigation.blade.php
└── profile/
    ├── edit.blade.php
    └── partials/
```

**Example: Customize registration page**

Edit `resources/views/auth/register.blade.php` to add/remove fields or modify styling.

#### Customizing Routes

Authentication routes are in `routes/auth.php`. You can modify them as needed:

```php
// routes/auth.php
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Customize login route
Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

// Add custom redirect after login
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
});
```

#### Redirect After Login

**In `app/Providers/RouteServiceProvider.php`:**

```php
public const HOME = '/dashboard';  // Change to '/blog' or any route
```

Or override in your authentication controllers.

### User Authorization Policies

For more complex authorization (who can edit/delete posts), create policies:

```bash
php artisan make:policy PostPolicy --model=Post
```

**In `app/Policies/PostPolicy.php`:**

```php
public function update(User $user, Post $post)
{
    return $user->id === $post->user_id;
}

public function delete(User $user, Post $post)
{
    return $user->id === $post->user_id;
}
```

**Register in `app/Providers/AuthServiceProvider.php`:**

```php
protected $policies = [
    Post::class => PostPolicy::class,
];
```

**Use in controllers:**

```php
public function update(Request $request, Post $post)
{
    $this->authorize('update', $post);
    
    // Update logic...
}
```

**Use in Blade:**

```blade
@can('update', $post)
    <a href="{{ route('blog.edit', $post) }}">Edit</a>
@endcan

@can('delete', $post)
    <form method="POST" action="{{ route('blog.destroy', $post) }}">
        @csrf
        @method('DELETE')
        <button>Delete</button>
    </form>
@endcan
```

### Running the Application with Breeze

**Always run both servers during development:**

**Terminal 1 - Frontend Assets:**
```bash
npm run dev
```

**Terminal 2 - Laravel Server:**
```bash
php artisan serve
```

**Access your application:**
- Main app: `http://localhost:8000`
- Register: `http://localhost:8000/register`
- Login: `http://localhost:8000/login`
- Dashboard: `http://localhost:8000/dashboard` (after login)

### Troubleshooting Breeze

**Issue: Styles not loading**
```bash
npm install
npm run dev
```

**Issue: "Target class [App\Http\Controllers\Auth\...] does not exist"**
```bash
composer dump-autoload
php artisan optimize:clear
```

**Issue: "Route [login] not defined"**
```bash
# Verify auth routes are included in routes/web.php
# Should contain: require __DIR__.'/auth.php';
```

**Issue: Migrations fail**
```bash
# Check database connection in .env
php artisan config:clear
php artisan migrate:fresh
```

## Configuration

### Environment Setup

#### Database Configuration

This project supports multiple database options. Choose the one that best fits your needs:

##### Option A: SQLite (Recommended for Development)

SQLite is the easiest option for local development - no database server required!

**Step 1:** Create the SQLite database file
```bash
# Create the database directory if it doesn't exist
mkdir -p database

# Create an empty SQLite database file
touch database/database.sqlite
```

**Step 2:** Update your `.env` file
```env
DB_CONNECTION=sqlite
# Remove or comment out these MySQL/PostgreSQL settings:
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

**Step 3:** Run migrations to create tables
```bash
php artisan migrate
```

**Benefits of SQLite:**
- No database server installation needed
- Perfect for development and testing
- Lightweight and fast
- Database stored as a single file

##### Option B: MySQL (Production Ready)

For production or if you prefer MySQL:

**Step 1:** Create a MySQL database
```bash
mysql -u root -p
CREATE DATABASE laravel_db;
EXIT;
```

**Step 2:** Update your `.env` file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
```

**Step 3:** Run migrations
```bash
php artisan migrate
```

##### Option C: PostgreSQL

For PostgreSQL users:

**Step 1:** Create a PostgreSQL database
```bash
createdb laravel_db
```

**Step 2:** Update your `.env` file
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel_db
DB_USERNAME=your_postgres_username
DB_PASSWORD=your_postgres_password
```

**Step 3:** Run migrations
```bash
php artisan migrate
```

#### Application URL Configuration

Update the `APP_URL` in your `.env` file to match your development URL:
```env
APP_URL=http://localhost:8000
```

#### Mail Configuration (Optional)

If your application sends emails, configure mail settings in `.env`:

**For local development with Mailhog:**
```env
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**For production with Gmail:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_email@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
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

### Debugging Helpers

Laravel provides powerful debugging functions to help you inspect variables and troubleshoot your code.

#### dd() - Dump and Die

**What it does:** Dumps the variable contents in a readable format and stops script execution.

```php
// Example from PostController
$posts = Post::latest()->paginate(10);
dd($posts);  // Displays post data and stops execution
// Code after dd() will never run
```

**When to use:**
- Inspect variable contents during development
- Debug what data is being passed to views
- Check database query results
- Verify API responses

**Output:** Displays a formatted, interactive dump with expandable arrays and objects.

#### Other Debugging Functions

**dump()** - Dump without stopping execution
```php
$posts = Post::all();
dump($posts);  // Shows data but continues execution
dump($posts->count());  // You can use multiple dumps
return view('blog.index');  // This line will still run
```

**ddd()** - Dump, Die, and Debug (Laravel 9.3+)
```php
// Similar to dd() but with enhanced formatting
ddd($posts, $users, $settings);  // Can dump multiple variables
```

**ray()** - Debug with Ray (requires spatie/ray package)
```php
ray($posts);  // Sends output to Ray debug app
ray($posts)->color('green');  // With custom styling
```

#### Debugging in Blade Templates

```blade
{{-- Dump and die in views --}}
@dd($posts)

{{-- Dump without dying --}}
@dump($posts)

{{-- Both can be used anywhere in Blade templates --}}
<div>
    @dump($post->title)
    <h1>{{ $post->title }}</h1>
</div>
```

#### Database Query Debugging

```php
// See the SQL query being executed
DB::enableQueryLog();
$posts = Post::where('slug', 'example')->get();
dd(DB::getQueryLog());

// Or use toSql() method
$query = Post::where('slug', 'example')->toSql();
dd($query);  // Shows: select * from `posts` where `slug` = ?
```

#### Using Laravel Tinker for Debugging

```bash
php artisan tinker
```

```php
// Interactive REPL for testing code
>>> $posts = Post::all();
>>> $posts->count();
=> 80

>>> $post = Post::first();
>>> $post->title;
=> "Voluptas qui est aut."

>>> Post::factory()->create();
=> App\Models\Post {#...}
```

**Pro Tips:**
- Remove `dd()` statements before committing code
- Use `dump()` when you need to inspect multiple points in execution
- Tinker is great for testing Eloquent queries without writing controller code
- Install browser extensions like Laravel Debugbar for more advanced debugging

## Database Schema

### Posts Table

This project includes a `posts` table for storing blog posts or articles.

#### Creating the Migration

The posts table migration was created using:

```bash
php artisan make:migration create_posts_table
```

#### Table Structure

The `posts` table includes the following fields:

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique identifier for each post |
| `title` | VARCHAR(255) | NOT NULL | The post title |
| `slug` | VARCHAR(255) | UNIQUE, NOT NULL | URL-friendly version of the title |
| `body` | TEXT | NOT NULL | The main content of the post |
| `created_at` | TIMESTAMP | NULLABLE | Timestamp when the post was created |
| `updated_at` | TIMESTAMP | NULLABLE | Timestamp when the post was last updated |

#### Migration Code

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('body');
    $table->timestamps();
});
```

#### Running the Migration

After creating and configuring the migration, apply it to your database:

```bash
php artisan migrate
```

#### Post Model, Controller, and Factory

The Post resources were created with a single command that generates the Model, Factory, and Controller:

```bash
php artisan make:model Post -fc
```

**Flags Explained:**
- `-f` : Creates a Factory (PostFactory)
- `-c` : Creates a Controller (PostController)

This command created three files:
1. **Model**: `app/Models/Post.php` - Eloquent model for database interaction
2. **Factory**: `database/factories/PostFactory.php` - For generating fake post data
3. **Controller**: `app/Http/Controllers/PostController.php` - For handling HTTP requests

#### Post Factory Configuration

The `PostFactory` generates realistic fake data for posts:

```php
public function definition()
{
    return [
        'title' => $this->faker->sentence(),
        'slug' => $this->faker->unique()->slug(),
        'body' => $this->faker->paragraphs(3, true),
    ];
}
```

**What it generates:**
- `title`: Random sentence (e.g., "Voluptas qui est aut.")
- `slug`: Unique URL-friendly slug (e.g., "voluptas-qui-est-aut")
- `body`: Three paragraphs of lorem ipsum text

#### Database Seeding

The database seeder creates sample data for development and testing.

**Seeder Configuration** (`database/seeders/DatabaseSeeder.php`):
```php
public function run()
{
    \App\Models\User::factory(10)->create();  // Creates 10 users
    \App\Models\Post::factory(80)->create();  // Creates 80 posts
}
```

**Reset and Seed Database:**
```bash
# Drop all tables, re-run migrations, and seed with fresh data
php artisan migrate:refresh --seed
```

**Other Seeding Commands:**
```bash
# Only run seeders (without migration refresh)
php artisan db:seed

# Run a specific seeder class
php artisan db:seed --class=DatabaseSeeder

# Reset database and migrate (without seeding)
php artisan migrate:refresh
```

#### Working with Posts in Code

**Create a Post Manually:**
```php
use App\Models\Post;

$post = Post::create([
    'title' => 'My First Post',
    'slug' => 'my-first-post',
    'body' => 'This is the content of my first post.',
]);
```

**Create Posts using Factory (in Tinker or Tests):**
```bash
php artisan tinker
```
```php
// Create a single post
Post::factory()->create();

// Create 10 posts
Post::factory()->count(10)->create();

// Create a post with specific attributes
Post::factory()->create([
    'title' => 'Custom Title',
    'slug' => 'custom-slug'
]);
```

**Query Posts:**
```php
// Retrieve all posts
$posts = Post::all();

// Find a post by ID
$post = Post::find(1);

// Find a post by slug
$post = Post::where('slug', 'my-first-post')->first();

// Get latest posts
$posts = Post::latest()->take(10)->get();

// Update a post
$post->update(['title' => 'Updated Title']);

// Delete a post
$post->delete();
```

**Controller Methods:**

The `PostController` can be expanded with RESTful methods:

```php
// Display a listing of posts
public function index() {
    $posts = Post::latest()->paginate(15);
    return view('posts.index', compact('posts'));
}

// Show a single post
public function show(Post $post) {
    return view('posts.show', compact('post'));
}
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

## User-Post Relationship

### Overview
This project implements a one-to-many relationship where one user can create multiple posts.

### Database Relationship Structure

- **Users Table**: Each user has a unique `id`
- **Posts Table**: Each post belongs to one user via `user_id` foreign key
- **Relationship**: One user can have many posts (`hasMany`)
- **Relationship**: One post belongs to one user (`belongsTo`)

### Implementation Steps

#### 1. Create Migration for Foreign Key

```bash
php artisan make:migration add_user_id_to_posts_table
```

**Migration File** (`database/migrations/XXXX_XX_XX_add_user_id_to_posts_table.php`):
```php
public function up()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn('user_id'); // SQLite compatible
    });
}
```

**Foreign Key Explanation:**
- `foreignId('user_id')`: Creates an unsigned big integer column for the user ID
- `after('id')`: Places the column right after the `id` column (column positioning)
- `constrained()`: Automatically creates a foreign key constraint to the `users` table
- `onDelete('cascade')`: When a user is deleted, all their posts are also deleted
- `dropColumn('user_id')`: SQLite-compatible rollback (SQLite doesn't support `dropForeign()`)

#### 2. Update Post Model

**File:** `app/Models/Post.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'body'];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

**Eloquent Relationship:**
- `belongsTo(User::class)`: Defines the inverse relationship
- Allows access to the post's author via `$post->user`
- Laravel automatically looks for `user_id` column

#### 3. Update User Model

**File:** `app/Models/User.php`

Add the posts relationship method:

```php
/**
 * Get all posts for the user.
 */
public function posts()
{
    return $this->hasMany(Post::class);
}
```

**Eloquent Relationship:**
- `hasMany(Post::class)`: Defines the one-to-many relationship
- Allows access to all user's posts via `$user->posts`
- Laravel automatically looks for `user_id` in the `posts` table

#### 4. Update PostFactory

**File:** `database/factories/PostFactory.php`

```php
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition()
    {
        $title = $this->faker->sentence();
        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->paragraphs(3, true),
        ];
    }
}
```

**Factory Changes:**
- Added `use Illuminate\Support\Str;` import
- `'user_id' => User::factory()`: Automatically creates a user for each post
- `Str::slug($title)`: Generates URL-friendly slug from title

#### 5. Update DatabaseSeeder (Optional)

**File:** `database/seeders/DatabaseSeeder.php`

To create users with posts:

```php
public function run()
{
    // Create 10 users, each with 1-5 random posts
    \App\Models\User::factory(10)->create()->each(function ($user) {
        \App\Models\Post::factory(rand(1, 5))->create(['user_id' => $user->id]);
    });
}
```

Or keep it simple and let the factory handle user creation:

```php
public function run()
{
    \App\Models\User::factory(10)->create();  // Creates 10 users
    \App\Models\Post::factory(80)->create();  // Creates 80 posts with auto-generated users
}
```

#### 6. Run Migration and Seed

```bash
# Drop all tables, recreate them, and seed with fresh data
php artisan migrate:fresh --seed
```

**Alternative Commands:**
```bash
# Just run the new migration (if database already has data)
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Seed database without migration
php artisan db:seed
```

### Using the Relationship in Code

#### Accessing User from Post

```php
// In a controller or route
$post = Post::find(1);
$author = $post->user;  // Gets the User model
echo $author->name;     // Display author name
```

#### Accessing Posts from User

```php
$user = User::find(1);
$posts = $user->posts;  // Collection of all user's posts
$postCount = $user->posts->count();  // Number of posts
```

#### In Blade Templates

**Display post author:**
```blade
<h2>{{ $post->title }}</h2>
<p>By <i>{{ $post->user->name }}</i></p>
<p>{{ $post->body }}</p>
```

**Display all user's posts:**
```blade
<h2>Posts by {{ $user->name }}</h2>
@foreach($user->posts as $post)
    <div>
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->body }}</p>
    </div>
@endforeach
```

#### Creating Posts with User

```php
// Method 1: Direct assignment
$post = Post::create([
    'user_id' => auth()->id(),
    'title' => 'My Post',
    'slug' => 'my-post',
    'body' => 'Post content...'
]);

// Method 2: Using relationship
$user = auth()->user();
$post = $user->posts()->create([
    'title' => 'My Post',
    'slug' => 'my-post',
    'body' => 'Post content...'
]);
```

#### Querying with Relationships

```php
// Get all posts with their authors (eager loading)
$posts = Post::with('user')->get();

// Get posts from a specific user
$posts = Post::where('user_id', $userId)->get();

// Get users who have posts
$users = User::has('posts')->get();

// Get users with post count
$users = User::withCount('posts')->get();
foreach ($users as $user) {
    echo "{$user->name} has {$user->posts_count} posts";
}
```

### Database Notes

#### SQLite Limitations

When using SQLite (default in this project), be aware:

- **Cannot drop foreign keys**: You must use `dropColumn()` instead of `dropForeign()`
- **Limited ALTER TABLE support**: Some column modifications require table recreation
- **Best for development**: Not recommended for production with heavy concurrent writes

**Rollback Consideration:**
```php
// SQLite-compatible down() method
public function down()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn('user_id');  // ✓ Works with SQLite
        // $table->dropForeign(['user_id']);  // ✗ Fails with SQLite
    });
}
```

#### Switching to MySQL/PostgreSQL

For production or if you need full foreign key support:

**MySQL Configuration (.env):**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

**PostgreSQL Configuration (.env):**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel_db
DB_USERNAME=postgres
DB_PASSWORD=
```

After switching databases, run:
```bash
php artisan migrate:fresh --seed
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

