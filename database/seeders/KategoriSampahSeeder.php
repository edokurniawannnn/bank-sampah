<?php

namespace Database\Seeders;

use App\Models\KategoriSampah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriSampah::insert([
            ['nama' => 'Plastik', 'nilai_poin_per_kg' => 50, 'satuan' => 'kg', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kertas',  'nilai_poin_per_kg' => 30, 'satuan' => 'kg', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Logam',   'nilai_poin_per_kg' => 100, 'satuan' => 'kg', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kaca',    'nilai_poin_per_kg' => 20, 'satuan' => 'kg', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
