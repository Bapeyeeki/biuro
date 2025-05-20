<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Trasy publiczne (dostępne bez uwierzytelnienia)
Route::post('/register', [AuthController::class, 'register']); // Rejestracja użytkownika
Route::post('/login', [AuthController::class, 'login']);       // Logowanie użytkownika

// Trasy chronione (wymagają uwierzytelnienia przez sesję)
Route::middleware('auth')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);      // Pobranie danych zalogowanego użytkownika
    Route::post('/logout', [AuthController::class, 'logout']); // Wylogowanie użytkownika
});