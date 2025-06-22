<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenceController;

Route::resource('absences', AbsenceController::class);
Route::resource('conges', CongeController::class);
Route::resource('retards', RetardController::class);
Route::get('/absences', [AbsenceController::class, 'index']);

