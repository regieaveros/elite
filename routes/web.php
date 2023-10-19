<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Artists;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Auth/Login');
})->middleware('guest');

//Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/sales', [DashboardController::class, 'sales'])->name('dashboard.sales');
    Route::get('/dashboard/top-1', [DashboardController::class, 'top1'])->name('dashboard.top1');
    Route::post('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search');
});

Route::middleware('auth')->group(function () {

    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Artists
    Route::controller(ArtistsController::class)->group(function () {
        Route::get('/artists', 'index')->name('artists');
        Route::get('/artist/edit/{id}', 'edit')->name('artists.edit');
        Route::patch('/artist/update/{id}', 'update')->name('artists.update');
        Route::delete('/artist/delete/{id}', 'destroy')->name('artists.delete');
    });

    //Albums
    Route::controller(AlbumsController::class)->group(function () {
        Route::get('/albums', 'index')->name('albums');
        Route::get('/album/edit/{id}', 'edit')->name('albums.edit');
        Route::put('/album/update/{id}', 'update')->name('albums.update');
        Route::delete('/album/delete/{id}', 'destroy')->name('albums.delete');
    });
});

require __DIR__ . '/auth.php';
