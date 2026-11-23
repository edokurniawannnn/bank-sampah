<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    protected $table = 'reward';
    protected $fillable = ['mitra_id', 'nama', 'poin_diperlukan', 'stok', 'aktif'];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function penukaran()
    {
        return $this->hasMany(Penukaran::class);
    }
}
