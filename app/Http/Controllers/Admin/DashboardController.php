<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use App\Models\Mitra;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_kategori' => KategoriSampah::count(),
            'total_mitra' => Mitra::where('aktif', true)->count(),
            'total_reward' => Reward::where('aktif', true)->count(),
            'total_warga' => User::where('role', 'warga')->count(),

        ];

        return view('admin.dashboard.main', compact('stats'));
    }
}
