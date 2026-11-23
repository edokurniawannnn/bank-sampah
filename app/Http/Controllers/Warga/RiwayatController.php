<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Setoran;

class RiwayatController extends Controller
{
    public function index()
    {
        $setoran = Setoran::with('detailSetoran.kategoriSampah')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('warga.riwayat.index', compact('setoran'));
    }
}
