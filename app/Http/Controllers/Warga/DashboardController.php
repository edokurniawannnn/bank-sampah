<?php

namespace App\Http\Controllers\Warga;


use App\Http\Controllers\Controller;
use App\Models\Setoran;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $riwayatTerbaru = Setoran::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $totalBerat = \App\Models\DetailSetoran::whereHas('setoran', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum('berat_kg');

        $stats = [
            'total_setoran' => \App\Models\Setoran::where('user_id', $user->id)->count(),
            'menunggu_verifikasi' => \App\Models\Setoran::where('user_id', $user->id)
                ->where('status', 'pending')->count(),
            'total_berat' => $totalBerat,
        ];

        return view('warga.dashboard.main', compact('user', 'riwayatTerbaru', 'stats'));
    }
}
