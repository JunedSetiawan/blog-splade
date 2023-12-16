<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\PostCategoryController;
use App\Http\Controllers\ImageUpload;
use App\Http\Controllers\Post\CollectionController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
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
    require __DIR__ . '/dashboard.php';

    Route::middleware('auth')->group(function () {
        Route::group(['middleware' => ['permission:create-posts|edit-posts|delete-posts']], function () {
            Route::get('post/create', [PostController::class, 'create'])->name('post.create');
            Route::post('post/create', [PostController::class, 'store'])->name('post.store');
            Route::get('post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
            Route::patch('post/{id}/edit', [PostController::class, 'update'])->name('post.update');
            Route::delete('post/{id}/delete', [PostController::class, 'destroy'])->name('post.destroy');
        });

        // route for profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // create routes for comments
        Route::post('/post/{id}/comment', [PostController::class, 'commentStore'])->name('post.comment.store');
        Route::delete('/post/{post:id}/comment/{comment:id}/delete', [PostController::class, 'commentDestroy'])
            ->name('post.comment.destroy');

        // create routes for likes
        Route::post('/post/{id}/like', [PostController::class, 'likeStore'])->name('post.like.store');

        // create routes for collections post
        Route::get('/collections', [CollectionController::class, 'index'])->name('post.collections');
        Route::post('/collections/create', [CollectionController::class, 'store'])->name('post.collection.store');
        Route::delete('/collection/{collection:id}/delete', [CollectionController::class, 'destroy'])->name('post.collection.delete');

        //route for reports
        Route::post('/posts/{post:id}/report', [ReportController::class, 'store'])->name('post.report.store');

        Route::get('/posts/mypost', [PostController::class, 'personal_post'])->name('personal-post');
    });

    Route::get('/', [HomeController::class, 'index'])->name('main');

    //route for post category
    Route::get('/post-category', [PostCategoryController::class, 'index'])->name('post.category');
    Route::get('/load-more-posts', [PostCategoryController::class, 'loadMore'])->name('loadMore');
    Route::get('/post-category/{slug}', [PostCategoryController::class, 'categorySelect'])->name('category.select');
    Route::get('/post-category/{slug}/load-more', [PostCategoryController::class, 'loadMoreCategory'])
        ->name('category.load-more');

    //route for posts filter
    Route::get('/posts/{filter}', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/{filter}/load', [PostController::class, 'filter'])->name('post.filter.load');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');



    Route::get('/post/{filename}/image', [ImageUpload::class, 'getImageFile'])->name('getImage');
});
