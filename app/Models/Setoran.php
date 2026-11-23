<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;
    protected $table = 'setoran';
    protected $fillable = ['user_id', 'petugas_id', 'status', 'total_poin', 'catatan'];

    public function warga()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
    public function detailSetoran()
    {
        return $this->hasMany(DetailSetoran::class);
    }
}
