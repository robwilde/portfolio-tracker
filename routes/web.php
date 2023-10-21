<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestedCapitalController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/portfolios/{portfolio}', [PortfolioController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('portfolio.index');

Route::get('/invested-capital', [InvestedCapitalController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('invested-capital.index');

require __DIR__.'/auth.php';
