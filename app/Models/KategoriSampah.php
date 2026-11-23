<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSampah extends Model
{
    /** @use HasFactory<\Database\Factories\KategoriSampahFactory> */
    use HasFactory;

    protected $table = 'kategori_sampah';

    protected $fillable = ['nama', 'nilai_poin_per_kg', 'satuan', 'deskripsi', 'aktif',];

    public function detailSetoran()
    {
        return $this->hasMany(DetailSetoran::class, 'kategori_id');
    }
}
