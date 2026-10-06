<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// =========================================================================
// 1. RUTE PUBLIK (Bebas diakses pengunjung / tanpa login)
// =========================================================================
Route::get('/', function () {
    $totalClothing = \App\Models\Donation::where('status', '!=', 'dibatalkan')->sum('quantity');
    $totalDonors = \App\Models\User::where('role', 'donatur')->count();
    $recentDonations = \App\Models\Donation::where('status', '!=', 'dibatalkan')->latest()->take(3)->get();
    return view('welcome', compact('totalClothing', 'totalDonors', 'recentDonations'));
})->name('home');

// Cek Resi / Tracking Donasi Publik
Route::get('/tracking', [DonationController::class, 'track'])->name('donations.track');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// =========================================================================
// 2. RUTE USER LOGIN (Donatur & Admin)
// =========================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Modul Donasi Pakaian (Afif)
    Route::resource('donations', DonationController::class);
    Route::get('/donations/{donation}/print', [DonationController::class, 'printLabel'])->name('donations.print');
});

// =========================================================================
// 3. RUTE KHUSUS ADMIN (Dilindungi Middleware IsAdmin)
// =========================================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Update status verifikasi donasi pakaian
    Route::patch('/donations/{donation}/status', [DonationController::class, 'updateStatus'])->name('donations.status');
});

require __DIR__.'/auth.php';
