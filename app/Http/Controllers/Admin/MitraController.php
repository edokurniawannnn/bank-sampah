<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Http\Requests\StoreMitraRequest;
use App\Http\Requests\UpdateMitraRequest;

class MitraController extends Controller
{
    protected $judul = "Data Mitra";
    protected $path = "admin.mitra";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['judul'] = $this->judul;
        $data['mitra'] = Mitra::latest()->paginate(10);
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
    public function store(StoreMitraRequest $request)
    {
        Mitra::create($request->validated());
        return redirect()->route($this->path . '.index')->with('success', 'Berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mitra $mitra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mitra $mitra)
    {
        $data['judul'] = $this->judul;
        $data['mitra'] = $mitra;
        return view($this->path . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMitraRequest $request, Mitra $mitra)
    {
        $mitra->update($request->validated());
        return redirect()->route($this->path . '.index')->with('success', 'Berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mitra $mitra)
    {
        $mitra->delete();
        return back()->with('success', 'Berhasil dihapus.');
    }
}
