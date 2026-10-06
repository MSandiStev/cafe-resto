<?php

return [
    // Ongkir flat sementara. Nanti bisa diganti hitung berdasarkan jarak.
    'delivery_fee' => 10000,

    // Akun admin yang dibuat otomatis oleh `php artisan db:seed` (isi di file .env).
    'admin_email'    => env('ADMIN_EMAIL'),
    'admin_password' => env('ADMIN_PASSWORD'),
];
