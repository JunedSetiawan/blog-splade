<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\PostCategoryController;
use App\Http\Controllers\ImageUpload;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();
    require __DIR__ . '/auth.php';
    Route::get('/', [HomeController::class, 'index'])->name('main');

    Route::get('/post-category', [PostCategoryController::class, 'index'])->name('post.category');
    Route::get('/load-more-posts', [PostCategoryController::class, 'loadMore'])->name('loadMore');
    Route::get('/post-category/{slug}', [PostCategoryController::class, 'categorySelect'])->name('category.select');
    Route::get('/post-category/{slug}/load-more', [PostCategoryController::class, 'loadMoreCategory'])
        ->name('category.load-more');

    Route::get('/posts/{filter}', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/{filter}/load', [PostController::class, 'filter'])->name('post.filter.load');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

    Route::middleware('auth')->group(function () {
        Route::get('testing-table', [UserController::class, 'index'])->name('test.table');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::get('{filename}', [ImageUpload::class, 'getImageFile'])->name('getImage');
});
