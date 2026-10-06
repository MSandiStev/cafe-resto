<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin dibuat dari ADMIN_EMAIL dan ADMIN_PASSWORD di file .env,
        // jadi tidak perlu membuat ulang lewat tinker setiap migrate:fresh.
        $email = config('cafe.admin_email');
        $password = config('cafe.admin_password');

        if ($email && $password) {
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name'              => 'Admin',
                    'password'          => $password,
                    'role'              => 'admin',
                    'email_verified_at' => now(),
                ]
            );
        }

        $this->call([
            MenuSeeder::class,
        ]);
    }
}
