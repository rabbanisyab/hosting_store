<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['register' => false]);

Route::group(['middleware' => ['is_admin','auth'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // booking
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class)->only(['index', 'destroy']);
    // travel packages
    Route::resource('travel_packages', \App\Http\Controllers\Admin\TravelPackageController::class)->except('show');
    // profile
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('homepage');
// hosting packages
Route::get('hosting-package', [\App\Http\Controllers\TravelPackageController::class, 'index'])->name('travel_package.index');
Route::get('hosting-package/{travel_package:slug}', [\App\Http\Controllers\TravelPackageController::class, 'show'])->name('travel_package.show');

// domain
Route::get('domain', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('domain/{domain:slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// contact
Route::get('contact', function() {
    return view('contact');
})->name('contact');
// booking
Route::post('booking', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');

// Domain Search
Route::get('search-domain', [\App\Http\Controllers\DomainSearchController::class, 'search'])->name('domain.search');
