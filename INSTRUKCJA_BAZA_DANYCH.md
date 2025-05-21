# Instrukcja przywracania bazy danych

Aby przywrócić bazę danych z biurami, wykonaj jedną z poniższych metod:

## Metoda 1: Uruchomienie migracji i seedera (zalecana)

1. Otwórz terminal w głównym katalogu projektu
2. Wykonaj następujące polecenia:

```bash
php artisan migrate:fresh --seed
```

To polecenie usunie wszystkie tabele, utworzy je na nowo i wypełni danymi testowymi, w tym biurami A-F.

## Metoda 2: Bezpośrednie wstawienie danych do bazy

Jeśli Metoda 1 nie działa, możesz bezpośrednio wstawić dane do bazy:

1. Upewnij się, że masz dostęp do bazy danych MySQL
2. Uruchom plik SQL znajdujący się w projekcie:

```bash
mysql -u TWÓJ_UŻYTKOWNIK -p TWOJA_BAZA_DANYCH < insert_offices.sql
```

lub otwórz narzędzie do zarządzania bazą danych (np. phpMyAdmin) i wykonaj zawartość pliku `insert_offices.sql`.

## Metoda 3: Ręczne dodanie biur przez Tinker

Jeśli powyższe metody nie działają, możesz dodać biura ręcznie przez Tinker:

1. Otwórz terminal w głównym katalogu projektu
2. Uruchom Tinker:

```bash
php artisan tinker
```

3. Wklej i wykonaj poniższy kod:

```php
use App\Models\Office;

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
```

## Sprawdzenie, czy biura zostały dodane

Aby sprawdzić, czy biura zostały poprawnie dodane do bazy danych, możesz wykonać:

```bash
php artisan tinker --execute="App\Models\Office::all()"
```

lub sprawdzić w przeglądarce, czy biura są widoczne na stronie głównej.