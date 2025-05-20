<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Biuro A
        Office::create([
            'name' => 'Biuro A',
            'size' => 12,
            'capacity' => 6,
            'floor' => '1',
            'price' => 900.00,
            'x' => 14,
            'y' => 15,
            'amenities' => ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe', 'Sala konferencyjna', 'Kuchnia'],
            'is_rented' => false,
        ]);

        // Biuro B
        Office::create([
            'name' => 'Biuro B',
            'size' => 6,
            'capacity' => 3,
            'floor' => '1',
            'price' => 480.00,
            'x' => 32,
            'y' => 15,
            'amenities' => ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe', 'Sala konferencyjna', 'Kuchnia', 'Monitoring'],
            'is_rented' => false,
        ]);

        // Biuro C
        Office::create([
            'name' => 'Biuro C',
            'size' => 18,
            'capacity' => 9,
            'floor' => '1',
            'price' => 1260.00,
            'x' => 55,
            'y' => 15,
            'amenities' => ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe', 'Kuchnia'],
            'is_rented' => false,
        ]);

        // Biuro D
        Office::create([
            'name' => 'Biuro D',
            'size' => 11,
            'capacity' => 5,
            'floor' => '1',
            'price' => 880.00,
            'x' => 27,
            'y' => 70,
            'amenities' => ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe', 'Sala konferencyjna', 'Kuchnia', 'Recepcja'],
            'is_rented' => false,
        ]);

        // Biuro E
        Office::create([
            'name' => 'Biuro E',
            'size' => 17,
            'capacity' => 8,
            'floor' => '1',
            'price' => 1190.00,
            'x' => 55,
            'y' => 70,
            'amenities' => ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe'],
            'is_rented' => false,
        ]);

        // Biuro F
        Office::create([
            'name' => 'Biuro F',
            'size' => 13,
            'capacity' => 6,
            'floor' => '1',
            'price' => 1040.00,
            'x' => 85,
            'y' => 70,
            'amenities' => ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe', 'Sala konferencyjna', 'Kuchnia', 'Parking'],
            'is_rented' => false,
        ]);
    }
}