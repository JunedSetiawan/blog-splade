<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Post\ReportController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['can:view-dashboard', 'auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/posts', [DashboardController::class, 'posts'])->name('dashboard.posts');

    // create route for manage all users
    Route::group(['middleware' => ['permission:create-users|edit-users|delete-users']], function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{id}/edit', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // route for Report Post
    Route::group(['middleware' => ['permission:view-reports|accept-reports|delete-reports', 'role:admin']], function () {
        Route::get('/posts/report', [ReportController::class, 'index'])->name('post.report');
        Route::delete('/posts/report/{id}/delete', [ReportController::class, 'reportDestroy'])->name('post.report.destroy');
        Route::patch('/posts/report/{id}/accept', [ReportController::class, 'reportAccept'])->name('post.report.accept');
    });

    Route::get('/mark-as-read', [ReportController::class, 'markAsRead'])->name('mark-as-read');
});
