<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use App\Http\Requests\StoreKategoriSampahRequest;
use App\Http\Requests\UpdateKategoriSampahRequest;

class KategoriSampahController extends Controller
{
    protected $judul = "Kategori Sampah";
    protected $path = "admin.kategori-sampah";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['judul'] = $this->judul;
        $data['kategori'] = KategoriSampah::latest()->paginate(10);
        return view($this->path . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['judul'] = $this->judul;
        return view($this->path . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriSampahRequest $request)
    {
        KategoriSampah::create($request->validated());
        return redirect()->route($this->path . '.index')->with('success', 'Berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriSampah $kategoriSampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriSampah $kategoriSampah)
    {
        return view($this->path . '.edit', compact('kategoriSampah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriSampahRequest $request, KategoriSampah $kategoriSampah)
    {
        $kategoriSampah->update($request->validated());
        return redirect()->route($this->path . '.index')->with('success', 'Berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriSampah $kategoriSampah)
    {
        $kategoriSampah->delete();
        return back()->with('success', 'Berhasil dihapus.');
    }
}
