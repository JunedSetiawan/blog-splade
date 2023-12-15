<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\PostCategoryController;
use App\Http\Controllers\ImageUpload;
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

    Route::middleware('auth')->group(function () {
        Route::group(['middleware' => ['permission:create-posts|edit-posts|delete-posts']], function () {
            Route::get('post/create', [PostController::class, 'create'])->name('post.create');
            Route::post('post/create', [PostController::class, 'store'])->name('post.store');
            Route::get('post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
            Route::patch('post/{id}/edit', [PostController::class, 'update'])->name('post.update');
            Route::delete('post/{id}/delete', [PostController::class, 'destroy'])->name('post.destroy');
        });
        Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role:admin', 'permission:access-dashboard')->name('dashboard');

        // route for profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


        // create route for manage all users
        Route::group(['middleware' => ['permission:create-users|edit-users|delete-users']], function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::patch('/users/{id}/edit', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
        });

        // create routes for comments
        Route::post('/post/{id}/comment', [PostController::class, 'commentStore'])->name('post.comment.store');
        Route::delete('/post/{post:id}/comment/{comment:id}/delete', [PostController::class, 'commentDestroy'])
            ->name('post.comment.destroy');

        // create routes for likes
        Route::post('/post/{id}/like', [PostController::class, 'likeStore'])->name('post.like.store');

        // create routes for collections post
        Route::get('/collections', [PostController::class, 'collections'])->name('post.collections');
        Route::get('/collections/create', [PostController::class, 'createCollection'])->name('post.collection.create');
        Route::post('/collections/create', [PostController::class, 'storeCollection'])->name('post.collection.store');
        Route::get('/collections/{id}/edit', [PostController::class, 'editCollection'])->name('post.collection.edit');
        Route::patch('/collections/{id}/edit', [PostController::class, 'updateCollection'])->name('post.collection.update');
        Route::delete('/collection/{id}/delete', [PostController::class, 'deleteCollection'])->name('post.collection.delete');

        //route for reports
        Route::post('/posts/report', [PostController::class, 'reportStore'])->name('post.report.store');
        Route::group(['middleware' => ['permission:view-reports|accept-reports|create-reports']], function () {
            Route::get('/posts/report', [ReportController::class, 'report'])->name('post.report');
            Route::delete('/posts/report/{id}/delete', [ReportController::class, 'reportDestroy'])->name('post.report.destroy');
            Route::patch('/posts/report/{id}/accept', [ReportController::class, 'reportAccept'])->name('post.report.accept');
        });
        Route::get('/posts/mypost', [PostController::class, 'personal_post'])->name('personal-post');
    });

    Route::get('/', [HomeController::class, 'index'])->name('main');

    //route for post category
    Route::get('/post-category', [PostCategoryController::class, 'index'])->name('post.category');
    Route::get('/load-more-posts', [PostCategoryController::class, 'loadMore'])->name('loadMore');
    Route::get('/post-category/{slug}', [PostCategoryController::class, 'categorySelect'])->name('category.select');
    Route::get('/post-category/{slug}/load-more', [PostCategoryController::class, 'loadMoreCategory'])
        ->name('category.load-more');

    //route for posts

    //route for posts filter
    Route::get('/posts/{filter}', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/{filter}/load', [PostController::class, 'filter'])->name('post.filter.load');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');



    Route::get('/post/{filename}/image', [ImageUpload::class, 'getImageFile'])->name('getImage');
});
