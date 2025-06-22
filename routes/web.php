<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\RetardController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Auth;

// Page d'accueil : redirige vers login ou dashboard
Route::get('/login', function () {
    if (!Auth::check()) {
        return view('login');
    }
    return redirect()->route('home');
})->name('login');

// Déconnexion
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Authentification Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Routes protégées
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('absences', AbsenceController::class);
    Route::resource('conges', CongeController::class);
    Route::resource('retards', RetardController::class);
    Route::get('/users/autocomplete', [UserController::class, 'autocomplete'])->name('users.autocomplete');
});