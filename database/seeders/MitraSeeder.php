<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mitra::insert([
            [
                'nama' => 'Toko Sembako Berkah',
                'alamat' => 'Jl. Keputih Perintis I, Sukolilo, Surabaya',
                'kontak' => '081234567890',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Warung Kelontong Cak Nur',
                'alamat' => 'Jl. Ketintang Baru, Gayungan, Surabaya',
                'kontak' => '085678901234',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Agen Pulsa & PPOB Lancar Jaya',
                'alamat' => 'Jl. MT Haryono No. 45, Lowokwaru, Malang',
                'kontak' => '089876543210',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Minimarket Surya',
                'alamat' => 'Jl. Pahlawan No. 88, Sidoarjo',
                'kontak' => '082133445566',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // Contoh data mitra yang sedang tidak aktif / tutup sementara
                'nama' => 'Koperasi Warga Makmur',
                'alamat' => 'Jl. Raya Gubeng, Surabaya',
                'kontak' => '03155667788',
                'aktif' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
