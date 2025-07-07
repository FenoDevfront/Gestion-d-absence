<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\RetardController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes d'authentification
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');


// Routes protégées par le middleware d'authentification
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Routes pour tous les employés (employe, superviseur, rh, directeur, admin)
    Route::resource('absences', AbsenceController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('conges', CongeController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('retards', RetardController::class)->only(['index', 'create', 'store', 'show']);

    // Routes pour les superviseurs, RH et directeurs
    Route::middleware(['role:superviseur,rh,directeur,admin'])->group(function () {
        Route::resource('absences', AbsenceController::class)->only(['edit', 'update']);
        Route::resource('conges', CongeController::class)->only(['edit', 'update']);
        Route::resource('retards', RetardController::class)->only(['edit', 'update']);
    });

    // Routes pour les RH et directeurs
    Route::middleware(['role:rh,directeur,admin'])->group(function () {
        Route::resource('absences', AbsenceController::class)->only(['destroy']);
        Route::resource('conges', CongeController::class)->only(['destroy']);
        Route::resource('retards', RetardController::class)->only(['destroy']);
    });

    // Routes pour l'administrateur
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('users', AdminController::class)->except(['show']);
    });
});

