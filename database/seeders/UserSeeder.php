<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat 20 user dengan peran 'customer'
        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => 'Customer ' . $i,
                'email' => 'customer' . $i . '@example.com',
                'password' => Hash::make('password'), // Menggunakan password yang di-hash
            ]);
        }

        // Membuat 2 user dengan peran 'employee'
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => 'Employee ' . $i,
                'email' => 'employee' . $i . '@example.com',
                'password' => Hash::make('password'), // Menggunakan password yang di-hash
            ]);
        }
    }
}
