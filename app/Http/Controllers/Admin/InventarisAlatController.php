<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventarisAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alats = Alat::latest()->paginate(10);
        return view('admin.inventaris-alat.index', compact('alats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inventaris-alat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat'  => 'required|string|max:255',
            'jenis'      => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'harga_sewa' => 'required|integer|min:0',
            'stok'       => 'required|integer|min:0',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('alat_gambar', 'public');
            $validated['gambar'] = $path;
        }

        Alat::create($validated);

        return redirect()->route('admin.inventaris-alat.index')->with('success', 'Data alat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alat $inventaris_alat)
    {
        return view('admin.inventaris-alat.edit', ['alat' => $inventaris_alat]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alat $inventaris_alat)
    {
        $validated = $request->validate([
            'nama_alat'  => 'required|string|max:255',
            'jenis'      => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'harga_sewa' => 'required|integer|min:0',
            'stok'       => 'required|integer|min:0',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($inventaris_alat->gambar) {
                Storage::disk('public')->delete($inventaris_alat->gambar);
            }
            $path = $request->file('gambar')->store('alat_gambar', 'public');
            $validated['gambar'] = $path;
        }

        $inventaris_alat->update($validated);

        return redirect()->route('admin.inventaris-alat.index')->with('success', 'Data alat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $inventaris_alat)
    {
        if ($inventaris_alat->gambar) {
            Storage::disk('public')->delete($inventaris_alat->gambar);
        }
        $inventaris_alat->delete();

        return redirect()->route('admin.inventaris-alat.index')->with('success', 'Data alat berhasil dihapus.');
    }
}
