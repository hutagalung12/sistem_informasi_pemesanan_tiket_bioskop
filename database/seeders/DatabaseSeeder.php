<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       
        User::updateOrCreate(
            ['email' => 'admin@bioskop.com'],
            [
                'name' => 'Admin Bioskop',
                'password' => Hash::make('123@abc'),
                'role' => 'admin'
            ]
        );

        User::updateOrCreate(
            ['email' => 'pelanggan@bioskop.com'],
            [
                'name' => 'Pelanggan Demo',
                'password' => Hash::make('password'),
                'role' => 'pelanggan'
            ]
        );
    }
}