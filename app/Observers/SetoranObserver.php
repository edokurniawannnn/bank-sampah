<?php

namespace App\Observers;

use App\Models\PoinLog;
use App\Models\Setoran;
use Illuminate\Support\Facades\DB;

class SetoranObserver
{
    /**
     * Handle the Setoran "created" event.
     */
    public function created(Setoran $setoran): void
    {
        //
    }

    /**
     * Handle the Setoran "updated" event.
     */
    public function updated(Setoran $setoran): void
    {
        if ($setoran->isDirty('status') && $setoran->status === 'verified') {
            DB::transaction(function () use ($setoran) {
                $totalPoin = $setoran->detailSetoran()->sum('poin_didapat');

                $setoran->updateQuietly(['total_poin' => $totalPoin]);

                $setoran->warga()->increment('poin_saldo', $totalPoin);

                PoinLog::create([
                    'user_id'      => $setoran->user_id,
                    'jumlah'       => $totalPoin,
                    'tipe'         => 'masuk',
                    'referensi_id' => $setoran->id,
                    'keterangan'   => 'Poin dari setoran #' . $setoran->id,
                ]);
            });
        }
    }

    /**
     * Handle the Setoran "deleted" event.
     */
    public function deleted(Setoran $setoran): void
    {
        //
    }

    /**
     * Handle the Setoran "restored" event.
     */
    public function restored(Setoran $setoran): void
    {
        //
    }

    /**
     * Handle the Setoran "force deleted" event.
     */
    public function forceDeleted(Setoran $setoran): void
    {
        //
    }
}
