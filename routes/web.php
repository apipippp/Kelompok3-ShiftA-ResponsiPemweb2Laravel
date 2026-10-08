<?php

use App\Http\Controllers\DistributionController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DropPointController;
use App\Http\Controllers\ProfileController;
use App\Models\Distribution;
use App\Models\Donation;
use App\Models\DropPoint;
use Illuminate\Support\Facades\Route;

// =========================================================================
// 1. RUTE PUBLIK (Bebas diakses pengunjung / tanpa login)
// =========================================================================
Route::get('/', function () {
    $totalClothing = \App\Models\Donation::where('status', '!=', 'dibatalkan')->sum('quantity');
    $totalDonors = \App\Models\User::where('role', 'donatur')->count();
    $totalDistributed = \App\Models\Distribution::sum('items_count');
    $totalDropPoints = \App\Models\DropPoint::count();

    $sampleDropPoints = \App\Models\DropPoint::latest()->take(3)->get();
    $recentDistributions = \App\Models\Distribution::latest('distribution_date')->take(3)->get();

    return view('welcome', compact(
        'totalClothing',
        'totalDonors',
        'totalDistributed',
        'totalDropPoints',
        'sampleDropPoints',
        'recentDistributions'
    ));
})->name('home');

// Cek Resi / Tracking Donasi Publik (Afif)
Route::get('/tracking', [DonationController::class, 'track'])->name('donations.track');

// Galeri Laporan Penyaluran Publik (Faizal)
Route::get('/laporan', [DistributionController::class, 'publicIndex'])->name('laporan.public');

// Daftar Titik Posko Publik (Nurul)
Route::get('/posko', [DropPointController::class, 'publicIndex'])->name('posko.public');

// =========================================================================
// 2. DASHBOARD (Admin & Ringkasan Metrik)
// =========================================================================
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        $totalDistributions = Distribution::count();
        $totalDistributedItems = Distribution::sum('items_count');
        $totalDonations = Donation::sum('quantity');
        $totalDropPoints = DropPoint::count();

        return view('dashboard', compact(
            'user',
            'totalDistributions',
            'totalDistributedItems',
            'totalDonations',
            'totalDropPoints'
        ));
    }

    // Data Khusus Donatur
    $myDonations = $user->donations()->latest()->take(5)->get();
    $myTotalItems = $user->donations()->where('status', '!=', 'dibatalkan')->sum('quantity');
    $myPending = $user->donations()->where('status', 'menunggu')->count();
    $myVerified = $user->donations()->where('status', 'diverifikasi')->count();
    $myDistributed = $user->donations()->where('status', 'disalurkan')->count();

    return view('dashboard', compact(
        'user',
        'myDonations',
        'myTotalItems',
        'myPending',
        'myVerified',
        'myDistributed'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// =========================================================================
// 3. RUTE USER LOGIN (Donatur & Admin)
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
// 4. RUTE KHUSUS ADMIN (Dilindungi Middleware IsAdmin)
// =========================================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Kelola Penyaluran Bantuan (Faizal)
    Route::resource('distributions', DistributionController::class)->except(['show']);

    // Kelola Titik Posko Drop-Off (Nurul)
    Route::resource('drop-points', DropPointController::class);

    // Update Status Verifikasi Donasi (Afif)
    Route::patch('/donations/{donation}/status', [DonationController::class, 'updateStatus'])->name('donations.status');
});

require __DIR__.'/auth.php';
