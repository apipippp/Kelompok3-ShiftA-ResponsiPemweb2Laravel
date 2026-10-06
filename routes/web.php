<?php

use App\Http\Controllers\DistributionController;
use App\Http\Controllers\ProfileController;
use App\Models\Distribution;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/laporan', [DistributionController::class, 'publicIndex'])
    ->name('laporan.public');


Route::get('/dashboard', function () {

    $totalDistributions = Distribution::count();

    $totalDistributedItems = Distribution::sum('items_count');

    $totalDonations = 0;

    if (
        class_exists(\App\Models\Donation::class)
        && Schema::hasTable('donations')
    ) {
        $totalDonations = \App\Models\Donation::sum('quantity');
    }

    $totalDropPoints = 0;

    if (
        class_exists(\App\Models\DropPoint::class)
        && Schema::hasTable('drop_points')
    ) {
        $totalDropPoints = \App\Models\DropPoint::count();
    }

    return view('dashboard', compact(
        'totalDistributions',
        'totalDistributedItems',
        'totalDonations',
        'totalDropPoints'
    ));

})->middleware(['auth', 'verified', 'admin'])->name('dashboard');


Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('distributions', DistributionController::class)
            ->except(['show']);

    });

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';
