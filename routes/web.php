<?php

// Dans routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\RetardController;
use App\Http\Controllers\Auth\GoogleController;

// // Routes publiques
// Route::get('/', function () {
//     if (!Auth::check()) {
//         return redirect('/auth/google');
//     }
//     return app(HomeController::class)->index();
// })->name('home');

// Routes protégées par authentification
// Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('absences', AbsenceController::class);
    Route::resource('conges', CongeController::class);
    Route::resource('retards', RetardController::class);

