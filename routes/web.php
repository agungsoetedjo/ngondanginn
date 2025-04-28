<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentDestController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\WeddingController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserAuthController::class, 'showProfile'])->name('profile.index');
    Route::post('/profile', [UserAuthController::class, 'updateProfile'])->name('profile.update');

});

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register']);
});

Route::middleware(['auth', 'check.bendahara'])->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments/{kode_transaksi}/approve', [PaymentController::class, 'approvePayment'])->name('payments.approve');
    Route::post('/payments/{kode_transaksi}/reject', [PaymentController::class, 'rejectPayment'])->name('payments.reject');
    Route::get('/payments/{kode_transaksi}', [PaymentController::class, 'showPayment'])->name('payments.show');
    Route::resource('paymentdests', PaymentDestController::class);
});

Route::middleware(['auth', 'check.pengelola'])->group(function () {
    Route::resource('weddings', WeddingController::class);
    Route::put('/weddings/{id}/music', [WeddingController::class, 'updateMusic'])->name('weddings.updateMusic');
    Route::get('/weddings/{id}/rsvps', [RsvpController::class, 'index'])->name('rsvps.index');
    Route::get('/weddings/{id}/guest-books', [GuestBookController::class, 'index'])->name('guestbooks.index');
    Route::get('/weddings/{id}/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::post('/weddings/{id}/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::post('/weddings/process-wedding/{kode_transaksi}', [WeddingController::class, 'processWedding'])->name('weddings.processWedding');
    Route::post('/weddings/publish-wedding/{kode_transaksi}', [WeddingController::class, 'publishWedding'])->name('weddings.publishWedding');
    Route::post('/weddings/complete-wedding/{kode_transaksi}', [WeddingController::class, 'completeWedding'])->name('weddings.completeWedding');

    Route::resource('designs', DesignController::class);
    Route::get('/designs/preview/{templateId}', [DesignController::class, 'preview'])->name('designs.preview');

    Route::get('/musics', [MusicController::class, 'index'])->name('musics.index');
    Route::post('/musics', [MusicController::class, 'store'])->name('musics.store');
    Route::delete('/musics/{id}', [MusicController::class, 'destroy'])->name('musics.destroy');
    Route::delete('/rsvps/rsvps/{id}', [RsvpController::class, 'destroy'])->name('rsvps.destroy');
    Route::delete('/guest-books/{id}', [GuestBookController::class, 'destroy'])->name('guestbooks.destroy');
    Route::delete('/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders.index');
    Route::post('/orders/{kode_transaksi}/assign', [OrderController::class, 'assignOrder'])->name('orders.assignOrder');
    Route::get('/orders/{kode_transaksi}', [OrderController::class, 'adminShow'])->name('orders.show');
    
    Route::get('/archive', [OrderController::class, 'indexArchive'])->name('index-archive');
    Route::get('/archive/{kode_transaksi}', [OrderController::class, 'showArchive'])->name('show-archive');
});

Route::get('/fe/{slug}', [WeddingController::class, 'weddingChecks'])->name('wedding.checks');
Route::post('/fe/{slug}/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/pesan-undangan', [OrderController::class, 'create'])->name('order.create');
Route::post('/pesan-undangan', [OrderController::class, 'store'])->name('order.store');
Route::get('/cek-pesanan', [OrderController::class, 'cekForm'])->name('order.cek.form');
Route::post('/cek-pesanan', [OrderController::class, 'cekPesanan'])->name('order.cek.proses');
Route::get('/cek-pesanan/{kode_transaksi}/result', [OrderController::class, 'hasilPesanan'])->name('order.cek.result');
Route::post('/cek-pesanan/{kode_transaksi}/result', [PaymentController::class, 'uploadBukti'])->name('order.upload_bukti');
Route::post('/order/update-template/{kode_transaksi}', [OrderController::class, 'updateTemplate'])->name('order.update.template');

Route::get('/sneat', [DashboardController::class, 'sneat']);