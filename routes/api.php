<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfficeController;

// Trasy publiczne (dostępne bez uwierzytelnienia)
Route::post('/register', [AuthController::class, 'register']); // Rejestracja użytkownika
Route::post('/login', [AuthController::class, 'login']);       // Logowanie użytkownika
Route::get('/offices', [OfficeController::class, 'index']);    // Pobranie wszystkich biur
Route::get('/offices/{office}', [OfficeController::class, 'show']); // Pobranie konkretnego biura

// Trasy chronione (wymagają uwierzytelnienia przez sesję)
Route::middleware('auth')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);      // Pobranie danych zalogowanego użytkownika
    Route::post('/logout', [AuthController::class, 'logout']); // Wylogowanie użytkownika
    Route::post('/offices/{office}/rent', [OfficeController::class, 'rent']); // Wynajęcie biura
    Route::post('/offices/{office}/release', [OfficeController::class, 'release']); // Zwolnienie biura
    Route::get('/user/offices', [OfficeController::class, 'userOffices']); // Pobranie biur użytkownika
});