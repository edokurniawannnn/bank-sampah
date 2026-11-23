<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reward::insert([
            [
                'mitra_id' => 1,
                'nama' => 'Beras Premium 5kg',
                'poin_diperlukan' => 5000,
                'stok' => 10,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mitra_id' => 1,
                'nama' => 'Minyak Goreng 1 Liter',
                'poin_diperlukan' => 1600,
                'stok' => 25,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Reward dari Mitra 2 (Warung Kelontong Cak Nur)
            [
                'mitra_id' => 2,
                'nama' => 'Sabun Cuci Pakaian Cair 800ml',
                'poin_diperlukan' => 850,
                'stok' => 30,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mitra_id' => 2,
                'nama' => 'Gula Pasir 1kg',
                'poin_diperlukan' => 1200,
                'stok' => 15,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Reward dari Mitra 3 (Agen Pulsa & PPOB Lancar Jaya)
            [
                'mitra_id' => 3,
                'nama' => 'Pulsa All Operator Rp 10.000',
                'poin_diperlukan' => 1100,
                'stok' => 100,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mitra_id' => 3,
                'nama' => 'Token Listrik Rp 20.000',
                'poin_diperlukan' => 2100,
                'stok' => 50,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mitra_id' => 4,
                'nama' => 'Voucher Belanja Rp 50.000',
                'poin_diperlukan' => 5500,
                'stok' => 5,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mitra_id' => 4,
                'nama' => 'Paket Sembako Ramadhan',
                'poin_diperlukan' => 10000,
                'stok' => 0, // Contoh data dengan stok habis
                'aktif' => false, // Contoh data yang sedang tidak aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
