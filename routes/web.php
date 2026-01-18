<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/health', fn () => response()->json([
    'ok' => true,
    'app' => config('app.name'),
]))->name('health');

Route::get('blog/search', function (Request $request) {
    return $request->all();
})->name('blog.search');

Route::controller(PostController::class)->group(function () {
    Route::get('blog', 'postIndex')->name('blog.index');
    Route::get('blog/{slug}', 'postsShow')->name('blog.show');
});
