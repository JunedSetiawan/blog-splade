<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ImageUpload;
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

    Route::middleware('auth')->group(function () {
        Route::get('testing-table', [UserController::class, 'index'])->name('test.table');
        Route::get('/dashboard', function () {
            return view('pages.dashboard.dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::get('{filename}', [ImageUpload::class, 'getImageFile'])->name('getImage');
});
