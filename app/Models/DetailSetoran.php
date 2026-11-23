<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSetoran extends Model
{
    use HasFactory;
    protected $table = 'detail_setoran';
    protected $fillable = ['setoran_id', 'kategori_id', 'berat_kg', 'poin_didapat'];

    public function setoran()
    {
        return $this->belongsTo(Setoran::class);
    }
    public function kategoriSampah()
    {
        return $this->belongsTo(KategoriSampah::class, 'kategori_id');
    }
}
