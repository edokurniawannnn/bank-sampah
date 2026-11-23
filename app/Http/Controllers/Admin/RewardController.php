<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\Mitra;
use App\Http\Requests\StoreRewardRequest;
use App\Http\Requests\UpdateRewardRequest;

class RewardController extends Controller
{
    protected $judul = "Katalog Reward";
    protected $path = "admin.reward";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['judul'] = $this->judul;
        $data['reward'] = Reward::with('mitra')->latest()->paginate(10);

        return view($this->path . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['judul'] = $this->judul;

        $data['mitra'] = Mitra::where('aktif', true)->get();
        return view($this->path . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRewardRequest $request)
    {
        Reward::create($request->validated());
        return redirect()->route($this->path . '.index')->with('success', 'Reward berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reward $reward) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reward $reward)
    {
        $data['judul'] = $this->judul;
        $data['reward'] = $reward;

        $data['mitra'] = Mitra::where('aktif', true)->get();

        return view($this->path . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRewardRequest $request, Reward $reward)
    {
        $reward->update($request->validated());
        return redirect()->route($this->path . '.index')->with('success', 'Reward berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reward $reward)
    {
        $reward->delete();
        return back()->with('success', 'Reward berhasil dihapus.');
    }
}
