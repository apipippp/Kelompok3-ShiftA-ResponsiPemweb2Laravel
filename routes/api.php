<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DistributionApiController;
use App\Http\Controllers\Api\DonationApiController;
use App\Http\Controllers\Api\DropPointApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RESTful API Routes - Lemari Peduli (Sanctum Authenticated)
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. PUBLIC API ROUTES (Tanpa Token Sanctum)
// =========================================================================

// Autentikasi Publik
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

// Lacak Resi Publik
Route::get('/tracking/{code}', [DonationApiController::class, 'track'])->name('api.tracking');

// Titik Posko Publik
Route::get('/drop-points', [DropPointApiController::class, 'index'])->name('api.drop-points.index');
Route::get('/drop-points/{dropPoint}', [DropPointApiController::class, 'show'])->name('api.drop-points.show');

// Laporan Penyaluran Publik
Route::get('/distributions', [DistributionApiController::class, 'index'])->name('api.distributions.index');
Route::get('/distributions/{distribution}', [DistributionApiController::class, 'show'])->name('api.distributions.show');

// =========================================================================
// 2. PROTECTED API ROUTES (Wajib Bearer Token Sanctum)
// =========================================================================
Route::middleware('auth:sanctum')->group(function () {
    // Info User & Logout
    Route::get('/user', [AuthController::class, 'me'])->name('api.user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    // CRUD Donasi Pakaian (Donatur & Admin)
    Route::get('/donations', [DonationApiController::class, 'index'])->name('api.donations.index');
    Route::post('/donations', [DonationApiController::class, 'store'])->name('api.donations.store');
    Route::get('/donations/{donation}', [DonationApiController::class, 'show'])->name('api.donations.show');
    Route::put('/donations/{donation}', [DonationApiController::class, 'update'])->name('api.donations.update');
    Route::delete('/donations/{donation}', [DonationApiController::class, 'destroy'])->name('api.donations.destroy');

    // Khusus Admin (Status Transition)
    Route::patch('/donations/{donation}/status', [DonationApiController::class, 'updateStatus'])->name('api.donations.status');

    // CRUD Posko (Admin)
    Route::post('/drop-points', [DropPointApiController::class, 'store'])->name('api.drop-points.store');
    Route::put('/drop-points/{dropPoint}', [DropPointApiController::class, 'update'])->name('api.drop-points.update');
    Route::delete('/drop-points/{dropPoint}', [DropPointApiController::class, 'destroy'])->name('api.drop-points.destroy');

    // CRUD Penyaluran (Admin)
    Route::post('/distributions', [DistributionApiController::class, 'store'])->name('api.distributions.store');
    Route::put('/distributions/{distribution}', [DistributionApiController::class, 'update'])->name('api.distributions.update');
    Route::delete('/distributions/{distribution}', [DistributionApiController::class, 'destroy'])->name('api.distributions.destroy');
});
