<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Services\PenukaranService;
use Illuminate\Validation\ValidationException;

class RewardController extends Controller
{
    public function __construct(protected PenukaranService $service) {}

    public function index()
    {
        $reward = Reward::with('mitra')
            ->where('aktif', true)
            ->where('stok', '>', 0)
            ->get();

        return view('warga.reward.index', compact('reward'));
    }

    public function tukar(Reward $reward)
    {
        try {
            $this->service->tukar(auth()->user(), $reward);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }

        return back()->with('success', 'Berhasil menukar poin dengan ' . $reward->nama . '.');
    }
}
