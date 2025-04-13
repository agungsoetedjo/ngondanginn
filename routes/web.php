<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\WeddingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index']);

// Testing started section page
// Route::get('/', function () {
//     return view('index');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('weddings', WeddingController::class);
    Route::resource('designs', DesignController::class);
    Route::get('/designs/preview/{templateId}', [DesignController::class, 'preview'])->name('designs.preview');

    Route::get('/weddings/{id}/rsvps', [RsvpController::class, 'index'])->name('rsvps.index');
    Route::get('/weddings/{id}/guest-books', [GuestBookController::class, 'index'])->name('guestbooks.index');
    Route::get('/weddings/{id}/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/musics', [MusicController::class, 'index'])->name('musics.index');
    Route::delete('/dashboard/rsvps/{id}', [RsvpController::class, 'destroy'])->name('rsvps.destroy');
    Route::delete('/guest-books/{id}', [GuestBookController::class, 'destroy'])->name('guestbooks.destroy');
    Route::delete('/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    Route::delete('/musics/{id}', [MusicController::class, 'destroy'])->name('musics.destroy');
    Route::post('/weddings/{id}/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::post('/musics', [MusicController::class, 'store'])->name('musics.store');

    Route::get('/profile', [UserAuthController::class, 'showProfile'])->name('profile.index');
    Route::post('/profile', [UserAuthController::class, 'updateProfile'])->name('profile.update');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login']);

    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register']);
});

Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout')->middleware('auth');