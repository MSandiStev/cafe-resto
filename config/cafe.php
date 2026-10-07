<?php

return [
    // Ongkir flat sementara. Nanti bisa diganti hitung berdasarkan jarak.
    'delivery_fee' => 10000,

    // Akun admin yang dibuat otomatis oleh `php artisan db:seed` (isi di file .env).
    'admin_email' => env('ADMIN_EMAIL'),
    'admin_password' => env('ADMIN_PASSWORD'),

    // Info kafe, dipakai di beranda dan footer.
    'address' => 'Jl. Contoh No. 123, Bandung',   // GANTI dengan alamat asli
    'whatsapp' => '6281234567890',                 // GANTI, format 62xxx tanpa + dan tanpa 0 di depan
    'about' => null,                            // Isi 2-3 kalimat tentang kafe Anda (boleh dikosongkan)

    // Jam buka per hari: 1 = Senin ... 7 = Minggu.
    'hours' => [
        1 => ['08.00', '22.00'],
        2 => ['08.00', '22.00'],
        3 => ['08.00', '22.00'],
        4 => ['08.00', '22.00'],
        5 => ['08.00', '22.00'],
        6 => ['08.00', '23.00'],
        7 => ['08.00', '23.00'],
    ],
];
