<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinLog extends Model
{
	use HasFactory;

	protected $table = 'poin_log';

	protected $fillable = [
		'user_id',
		'jumlah',
		'tipe',
		'referensi_id',
		'keterangan',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
