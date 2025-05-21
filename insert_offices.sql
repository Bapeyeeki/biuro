-- Wyczyszczenie tabeli biur
TRUNCATE TABLE offices;

-- Wstawienie biur
INSERT INTO offices (name, size, capacity, floor, price, x, y, amenities, is_rented, created_at, updated_at) VALUES
('Biuro A', 12, 6, '1', 900.00, 14, 15, '["Internet światłowodowy", "Klimatyzacja", "Dostęp 24/7", "Meble biurowe", "Sala konferencyjna", "Kuchnia"]', 0, NOW(), NOW()),
('Biuro B', 6, 3, '1', 480.00, 32, 15, '["Internet światłowodowy", "Klimatyzacja", "Dostęp 24/7", "Meble biurowe", "Sala konferencyjna", "Kuchnia", "Monitoring"]', 0, NOW(), NOW()),
('Biuro C', 18, 9, '1', 1260.00, 55, 15, '["Internet światłowodowy", "Klimatyzacja", "Dostęp 24/7", "Meble biurowe", "Kuchnia"]', 0, NOW(), NOW()),
('Biuro D', 11, 5, '1', 880.00, 27, 70, '["Internet światłowodowy", "Klimatyzacja", "Dostęp 24/7", "Meble biurowe", "Sala konferencyjna", "Kuchnia", "Recepcja"]', 0, NOW(), NOW()),
('Biuro E', 17, 8, '1', 1190.00, 55, 70, '["Internet światłowodowy", "Klimatyzacja", "Dostęp 24/7", "Meble biurowe"]', 0, NOW(), NOW()),
('Biuro F', 13, 6, '1', 1040.00, 85, 70, '["Internet światłowodowy", "Klimatyzacja", "Dostęp 24/7", "Meble biurowe", "Sala konferencyjna", "Kuchnia", "Parking"]', 0, NOW(), NOW());