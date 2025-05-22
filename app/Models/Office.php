<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Reservation;

class Office extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'size',
        'capacity',
        'floor',
        'price',
        'x',
        'y',
        'amenities',
        'is_rented',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amenities' => 'array',
        'is_rented' => 'boolean',
        'x' => 'float',
        'y' => 'float',
    ];

    /**
     * Get the reservations for the office.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Get the active reservation for the office.
     */
    public function activeReservation()
    {
        return $this->reservations()->where('is_active', true)->first();
    }
}
