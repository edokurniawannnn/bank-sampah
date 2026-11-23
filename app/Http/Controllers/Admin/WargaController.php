<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    protected $judul = "Data Warga";
    protected $path = "admin.warga";

    public function index(Request $request)
    {
        $data['judul'] = $this->judul;
        $data['warga'] = User::warga()
            ->when($request->search, fn($q) => $q->where('nama', 'like', "%{$request->search}%"))
            ->latest()
            ->paginate(10);

        return view($this->path . '.index', $data);
    }

    public function show(User $warga)
    {
        return view('admin.warga.show', compact('warga'));
    }

    public function edit(User $warga)
    {
        return view('admin.warga.edit', compact('warga'));
    }

    public function update(Request $request, User $warga)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'rt_rw' => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $warga->update($validated);
        return redirect()->route('admin.warga.index')->with('success', 'Data warga diperbarui.');
    }

    public function toggleStatus(User $warga)
    {
        $warga->update(['is_active' => !$warga->is_active]);
        return back()->with('success', 'Status akun diperbarui.');
    }
}
