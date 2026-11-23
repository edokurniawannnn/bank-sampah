<?php

namespace App\Services;

use App\Models\Setoran;
use App\Models\KategoriSampah;
use Illuminate\Support\Facades\DB;

class SetoranService
{
	public function simpan(array $data): Setoran
	{
		return DB::transaction(function () use ($data) {
			$setoran = Setoran::create([
				'user_id' => $data['user_id'],
				'petugas_id' => auth()->id(),
				'status' => 'pending',
				'catatan' => $data['catatan'] ?? null,
			]);

			foreach ($data['items'] as $item) {
				$kategori = KategoriSampah::findOrFail($item['kategori_id']);
				$poin = $kategori->nilai_poin_per_kg * $item['berat_kg'];

				$setoran->detailSetoran()->create([
					'kategori_id' => $item['kategori_id'],
					'berat_kg' => $item['berat_kg'],
					'poin_didapat' => $poin,
				]);
			}

			return $setoran;
		});
	}
}
