<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Rejestracja użytkownika
    public function register(Request $request)
    {
        // Walidacja danych wejściowych
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Wymaga pola password_confirmation
        ]);

        // Tworzenie użytkownika
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Hashowanie hasła
        ]);

        return response()->json(['message' => 'Rejestracja zakończona sukcesem'], 201);
    }

    // Logowanie użytkownika
    public function login(Request $request)
    {
        // Walidacja danych wejściowych
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Próba logowania
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Nieprawidłowe dane logowania'], 401);
        }

        // Pobranie zalogowanego użytkownika
        $user = Auth::user();

        return response()->json([
            'message' => 'Zalogowano pomyślnie',
            'user' => $user,
        ]);
    }

    // Pobranie danych zalogowanego użytkownika
    public function user(Request $request)
    {
        // Zwrócenie danych zalogowanego użytkownika
        return response()->json(Auth::user());
    }

    // Wylogowanie użytkownika
    public function logout(Request $request)
    {
        // Wylogowanie użytkownika
        Auth::logout();

        return response()->json(['message' => 'Wylogowano pomyślnie']);
    }
}