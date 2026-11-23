<?php

namespace App\Services;

use App\Models\User;
use App\Models\Reward;
use App\Models\Penukaran;
use App\Models\PoinLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PenukaranService
{
	public function tukar(User $user, Reward $reward): Penukaran
	{
		return DB::transaction(function () use ($user, $reward) {
			// lockForUpdate: kunci row supaya tidak terjadi double-spend
			// kalau ada 2 request tukar dikirim hampir bersamaan
			$reward = Reward::lockForUpdate()->findOrFail($reward->id);
			$user = User::lockForUpdate()->findOrFail($user->id);

			if (!$reward->aktif || $reward->stok < 1) {
				throw ValidationException::withMessages(['reward' => 'Stok reward habis.']);
			}

			if ($user->poin_saldo < $reward->poin_diperlukan) {
				throw ValidationException::withMessages(['reward' => 'Poin Anda tidak mencukupi.']);
			}

			$penukaran = Penukaran::create([
				'user_id'      => $user->id,
				'reward_id'    => $reward->id,
				'poin_dipakai' => $reward->poin_diperlukan,
				'status'       => 'diambil',
			]);

			$user->decrement('poin_saldo', $reward->poin_diperlukan);
			$reward->decrement('stok', 1);

			PoinLog::create([
				'user_id'      => $user->id,
				'jumlah'       => $reward->poin_diperlukan,
				'tipe'         => 'keluar',
				'referensi_id' => $penukaran->id,
				'keterangan'   => 'Tukar poin dengan reward: ' . $reward->nama,
			]);

			return $penukaran;
		});
	}
}
