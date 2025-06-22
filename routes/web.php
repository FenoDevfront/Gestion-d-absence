<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\RetardController;

Route::resource('absences', AbsenceController::class);
Route::resource('conges', CongeController::class);
Route::resource('retards', RetardController::class);
Route::get('/', function () {
    return view('home');
})->name('home');


