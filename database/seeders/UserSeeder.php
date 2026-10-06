<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun Administrator
        User::updateOrCreate(
            ['email' => 'admin@lemaripeduli.com'],
            [
                'name' => 'Administrator Lemari Peduli',
                'password' => Hash::make('password'),
                'phone' => '081234567890',
                'role' => 'admin',
            ]
        );

        // Akun Donatur
        User::updateOrCreate(
            ['email' => 'donatur@lemaripeduli.com'],
            [
                'name' => 'Donatur Contoh',
                'password' => Hash::make('password'),
                'phone' => '089876543210',
                'role' => 'donatur',
            ]
        );
    }
}
