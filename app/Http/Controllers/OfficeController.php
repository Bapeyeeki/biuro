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
        // Sprawdź, czy biuro jest już wynajęte
        if ($office->is_rented) {
            return response()->json(['message' => 'To biuro jest już wynajęte'], 400);
        }

        // Walidacja danych
        $validated = $request->validate([
            'start_date' => 'required|date',
        ]);

        // Utwórz rezerwację
        $reservation = new Reservation([
            'user_id' => Auth::id(),
            'office_id' => $office->id,
            'start_date' => $validated['start_date'],
            'is_active' => true,
        ]);
        $reservation->save();

        // Oznacz biuro jako wynajęte
        $office->is_rented = true;
        $office->save();

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
        // Sprawdź, czy biuro jest wynajęte
        if (!$office->is_rented) {
            return response()->json(['message' => 'To biuro nie jest wynajęte'], 400);
        }

        // Sprawdź, czy użytkownik jest właścicielem rezerwacji
        $reservation = $office->activeReservation();
        if (!$reservation || $reservation->user_id !== Auth::id()) {
            return response()->json(['message' => 'Nie masz uprawnień do zwolnienia tego biura'], 403);
        }

        // Zakończ rezerwację
        $reservation->is_active = false;
        $reservation->end_date = now();
        $reservation->save();

        // Oznacz biuro jako dostępne
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
        $activeReservations = $user->activeReservations();
        $offices = [];

        foreach ($activeReservations as $reservation) {
            $offices[] = $reservation->office;
        }

        return response()->json($offices);
    }
}
