<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// database/seeders/UserSeeder.php
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'nama' => 'Admin Bank Sampah',
            'email' => 'admin@banksampah.test',
        ]);

        User::factory()->petugas()->create([
            'nama' => 'Budi Petugas',
            'email' => 'petugas@banksampah.test',
        ]);

        User::factory()->create([
            'nama' => 'Siti Warga',
            'email' => 'warga@banksampah.test',
            'poin_saldo' => 150,
        ]);

        User::factory(10)->create();
    }
}
