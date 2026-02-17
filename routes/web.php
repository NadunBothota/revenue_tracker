<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\RevenueSheetController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\CalculationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/operators', [OperatorController::class, 'index'])->name('operators.index');
    Route::get('/operators/{operator}', [OperatorController::class, 'show'])->name('operators.show');

    Route::get('/operators/{operator}/sheets/create', [RevenueSheetController::class, 'create'])->name('sheets.create');
    Route::post('/operators/{operator}/sheets', [RevenueSheetController::class, 'store'])->name('sheets.store');

    Route::get('/agreements/create', [AgreementController::class, 'create'])->name('agreements.create');
    Route::post('/agreements', [AgreementController::class, 'store'])->name('agreements.store');

    Route::post('/sheets/{sheet}/calculate', [CalculationController::class, 'calculate'])->name('sheets.calculate');
    Route::get('/sheets/{sheet}/results', [CalculationController::class, 'results'])->name('sheets.results');

});

require __DIR__.'/auth.php';
