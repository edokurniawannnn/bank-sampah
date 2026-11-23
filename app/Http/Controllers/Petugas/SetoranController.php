<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSetoranRequest;
use App\Models\KategoriSampah;
use App\Models\Setoran;
use App\Models\User;
use App\Services\SetoranService;
use Illuminate\Http\Request;

// app/Http/Controllers/Petugas/SetoranController.php
class SetoranController extends Controller
{
    public function __construct(protected SetoranService $service) {}

    public function index()
    {
        $setoran = Setoran::with('warga')
            ->where('petugas_id', auth()->id())
            ->latest()->paginate(10);
        return view('petugas.setoran.index', compact('setoran'));
    }

    public function create()
    {
        $warga = User::where('role', 'warga')->where('is_active', true)->get();
        $kategori = KategoriSampah::where('aktif', true)->get();
        return view('petugas.setoran.create', compact('warga', 'kategori'));
    }

    public function store(StoreSetoranRequest $request)
    {
        $this->service->simpan($request->validated());
        return redirect()->route('petugas.setoran.index')->with('success', 'Setoran berhasil disimpan, menunggu verifikasi.');
    }

    public function show(Setoran $setoran)
    {
        $setoran->load('detailSetoran.kategoriSampah', 'warga');
        return view('petugas.setoran.show', compact('setoran'));
    }

    public function verifikasi(Setoran $setoran)
    {
        $setoran->update(['status' => 'verified']);
        return back()->with('success', 'Setoran #' . $setoran->id . ' terverifikasi, poin sudah ditambahkan.');
    }
}
