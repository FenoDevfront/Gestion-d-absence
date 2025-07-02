<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\RetardController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// Page d'accueil : redirige vers login ou dashboard
Route::get('/login', function () {
    if (!Auth::check()) {
        return view('login');
    }
    return redirect()->route('home');
})->name('login');

// Déconnexion
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Authentification Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/test-gemini', [App\Http\Controllers\GeminiController::class, 'test']);

Route::get('/test', function () {
    return 'ok';
});

// Routes protégées
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Gestion des demandes
    // Les employés peuvent voir, créer et afficher leurs propres demandes.
    Route::resource('absences', AbsenceController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('conges', CongeController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('retards', RetardController::class)->only(['index', 'create', 'store', 'show']);

    // Les superviseurs peuvent modifier et mettre à jour.
    Route::resource('absences', AbsenceController::class)->only(['edit', 'update'])->middleware('role:superviseur,rh,directeur');
    Route::resource('conges', CongeController::class)->only(['edit', 'update'])->middleware('role:superviseur,rh,directeur');
    Route::resource('retards', RetardController::class)->only(['edit', 'update'])->middleware('role:superviseur,rh,directeur');

    // Les RH peuvent supprimer.
    Route::resource('absences', AbsenceController::class)->only(['destroy'])->middleware('role:rh,directeur');
    Route::resource('conges', CongeController::class)->only(['destroy'])->middleware('role:rh,directeur');
    Route::resource('retards', RetardController::class)->only(['destroy'])->middleware('role:rh,directeur');

    // Routes pour les directeurs (si spécifiques)
    Route::middleware(['role:directeur'])->group(function () {
        // Ajoutez ici les routes spécifiques au directeur
    });

    Route::get('/users/autocomplete', [UserController::class, 'autocomplete'])->name('users.autocomplete');

    // Routes pour l'administrateur
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'index'])->name('users.index');
        Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    });
});

