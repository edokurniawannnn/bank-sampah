<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use App\Models\DetailSetoran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $petugasId = Auth::id();

        $stats = [
            'setoran_hari_ini' => Setoran::where('petugas_id', $petugasId)
                ->whereDate('created_at', today())
                ->count(),

            'menunggu_verifikasi' => Setoran::where('petugas_id', $petugasId)
                ->where('status', 'pending')
                ->count(),

            'total_kg_hari_ini' => DetailSetoran::whereHas('setoran', function ($q) use ($petugasId) {
                $q->where('petugas_id', $petugasId)
                    ->whereDate('created_at', today());
            })->sum('berat_kg'),
        ];

        return view('petugas.dashboard.main', compact('stats'));
    }
}
