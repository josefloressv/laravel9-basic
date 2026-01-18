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

