<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    /**
     * Get all offices.
     */
    public function index()
    {
        $offices = Office::all();
        return response()->json($offices);
    }

    /**
     * Get a specific office.
     */
    public function show(Office $office)
    {
        return response()->json($office);
    }

    /**
     * Rent an office.
     */
    public function rent(Request $request, Office $office)
    {
        $user = Auth::user();
        $isAdmin = $user && ($user->email === 'admin@arris.pl' || $user->email === 'admin@test.pl');

        // Sprawdź, czy biuro jest już wynajęte (admin może wynająć każde biuro)
        if ($office->is_rented && !$isAdmin) {
            return response()->json(['message' => 'To biuro jest już wynajęte'], 400);
        }

        // Walidacja danych
        $validated = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Złóż pełną datę z dzisiejszym dniem
        $today = now()->format('Y-m-d');
        $startDate = $today . ' ' . $validated['start_time'] . ':00';
        $endDate = $today . ' ' . $validated['end_time'] . ':00';

        // Utwórz rezerwację
        $reservation = new Reservation([
            'user_id' => Auth::id(),
            'office_id' => $office->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_active' => true,
        ]);
        $reservation->save();

        // Oznacz biuro jako wynajęte (chyba że admin - wtedy nie zmieniaj statusu)
        if (!$isAdmin) {
            $office->is_rented = true;
            $office->save();
        }

        return response()->json([
            'message' => 'Biuro zostało pomyślnie wynajęte',
            'office' => $office,
            'reservation' => $reservation,
        ]);
    }

    /**
     * Release an office.
     */
    public function release(Office $office)
    {
        $user = Auth::user();
        $isAdmin = $user && ($user->email === 'admin@arris.pl' || $user->email === 'admin@test.pl');

        // Sprawdź, czy biuro jest wynajęte (admin może zwolnić każde biuro)
        if (!$office->is_rented && !$isAdmin) {
            return response()->json(['message' => 'To biuro nie jest wynajęte'], 400);
        }

        // Sprawdź, czy użytkownik jest właścicielem rezerwacji lub adminem
        $reservation = $office->activeReservation();
        if (!$isAdmin && (!$reservation || $reservation->user_id !== Auth::id())) {
            return response()->json(['message' => 'Nie masz uprawnień do zwolnienia tego biura'], 403);
        }

        // Zakończ rezerwację (jeśli istnieje)
        if ($reservation) {
            $reservation->is_active = false;
            $reservation->end_date = now();
            $reservation->save();
        }

        // Oznacz biuro jako dostępne (admin może wymusić)
        $office->is_rented = false;
        $office->save();

        return response()->json([
            'message' => 'Biuro zostało pomyślnie zwolnione',
            'office' => $office,
        ]);
    }

    /**
     * Get user's rented offices.
     */
    public function userOffices()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Nie jesteś zalogowany'], 401);
        }
        $isAdmin = $user->email === 'admin@arris.pl' || $user->email === 'admin@test.pl';

        // Admin widzi wszystkie biura jako swoje
        if ($isAdmin) {
            $offices = \App\Models\Office::all();
        } else {
            // Pobierz aktywne rezerwacje użytkownika
            $offices = \App\Models\Office::whereHas('reservations', function($q) use ($user) {
                $q->where('user_id', $user->id)->where('is_active', true);
            })->get();
        }

        return response()->json($offices);
    }
}
