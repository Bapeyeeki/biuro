<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Reservation;
use App\Models\User; // Jeśli używasz User w kontrolerze
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    // Stałe sloty godzinowe
    private $timeSlots = [
        ['start' => '08:00', 'end' => '10:00'],
        ['start' => '10:00', 'end' => '12:00'],
        ['start' => '12:00', 'end' => '14:00'],
        ['start' => '14:00', 'end' => '16:00'],
        ['start' => '16:00', 'end' => '18:00'],
        ['start' => '08:00', 'end' => '18:00'], // cały dzień
    ];

    /**
     * Get all offices.
     */
    public function index()
    {
        $offices = Office::all();
        return response()->json($offices);
    }

    /**
     * Get a specific office with reservations.
     */
    public function show(Office $office)
    {
        $today = now()->format('Y-m-d');
        $reservations = \App\Models\Reservation::where('office_id', $office->id)
            ->whereDate('start_date', $today)
            ->orderBy('start_date')
            ->get();

        return response()->json([
            'office' => $office,
            'reservations' => $reservations,
        ]);
    }

    /**
     * Get reservations for an office (today).
     */
    public function reservations(Office $office)
    {
        $today = now()->format('Y-m-d');
        $reservations = \App\Models\Reservation::where('office_id', $office->id)
            ->whereDate('start_date', $today)
            ->orderBy('start_date')
            ->get();

        // Zawsze zwracaj tablicę (nawet pustą)
        return response()->json($reservations->values());
    }

    /**
     * Rent an office for a specific time slot or recurring.
     */
    public function rent(Request $request, Office $office)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Nie jesteś zalogowany'], 401);
        }

        // Walidacja danych
        $validated = $request->validate([
            'slot_index' => 'required|integer|min:0|max:5',
            'recurring' => 'boolean',
            'days' => 'nullable|integer|min:1|max:30',
        ]);

        $slot = $this->timeSlots[$validated['slot_index']];
        $today = now()->format('Y-m-d');
        $recurring = $validated['recurring'] ?? false;
        $days = $recurring ? ($validated['days'] ?? 1) : 1;

        $reservations = [];
        for ($i = 0; $i < $days; $i++) {
            $date = now()->addDays($i)->format('Y-m-d');
            $startDate = $date . ' ' . $slot['start'] . ':00';
            $endDate = $date . ' ' . $slot['end'] . ':00';

            // Nie pozwól rezerwować na przeszłość
            if ($startDate < now()->format('Y-m-d H:i:s')) {
                continue;
            }

            // Sprawdź kolizje z innymi rezerwacjami tego biura (tego dnia)
            $overlap = \App\Models\Reservation::where('office_id', $office->id)
                ->whereDate('start_date', $date)
                ->where(function($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<', $endDate)
                      ->where('end_date', '>', $startDate);
                })
                ->exists();

            if ($overlap) {
                if ($days == 1) {
                    return response()->json(['message' => 'Wybrany przedział czasowy jest już zarezerwowany'], 409);
                }
                continue; // pomiń ten dzień, ale próbuj dalej
            }

            // Utwórz rezerwację
            $reservation = new \App\Models\Reservation([
                'user_id' => $user->id,
                'office_id' => $office->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'is_active' => true,
            ]);
            $reservation->save();
            $reservations[] = $reservation;
        }

        // Jeśli nie utworzono żadnej rezerwacji:
        if (empty($reservations)) {
            return response()->json(['message' => 'Brak możliwych terminów do rezerwacji'], 409);
        }

        return response()->json([
            'message' => $recurring ? 'Rezerwacje cykliczne zostały utworzone' : 'Biuro zostało pomyślnie zarezerwowane',
            'reservations' => $reservations,
        ]);
    }

    /**
     * Release an office reservation (end reservation early).
     */
    public function release(Office $office)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Nie jesteś zalogowany'], 401);
        }

        // Znajdź aktywną rezerwację użytkownika na dziś
        $today = now()->format('Y-m-d');
        $reservation = \App\Models\Reservation::where('office_id', $office->id)
            ->where('user_id', $user->id)
            ->where('is_active', true)
            ->whereDate('start_date', $today)
            ->first();

        if (!$reservation) {
            return response()->json(['message' => 'Nie masz aktywnej rezerwacji tego biura na dziś'], 403);
        }

        $reservation->is_active = false;
        $reservation->end_date = now();
        $reservation->save();

        return response()->json([
            'message' => 'Rezerwacja została zakończona',
            'reservation' => $reservation,
        ]);
    }

    /**
     * Get user's active reservations (today).
     */
    public function userOffices()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Nie jesteś zalogowany'], 401);
        }

        $today = now()->format('Y-m-d');
        $reservations = \App\Models\Reservation::where('user_id', $user->id)
            ->whereDate('start_date', $today)
            ->where('is_active', true)
            ->get();

        $officeIds = $reservations->pluck('office_id')->unique();

        if ($officeIds->isEmpty()) {
            return response()->json([]);
        }

        $offices = \App\Models\Office::whereIn('id', $officeIds)->get();

        return response()->json($offices);
    }

    /**
     * Udostępnij sloty godzinowe do frontendu (dla wszystkich biur).
     */
    public function timeSlots()
    {
        return response()->json($this->timeSlots);
    }

    /**
     * Udostępnij sloty godzinowe dla konkretnego biura.
     */
    public function officeTimeSlots(Office $office)
    {
        // Możesz tu dodać logikę zależną od biura, np. inne sloty dla różnych biur
        return response()->json($this->timeSlots);
    }
}
