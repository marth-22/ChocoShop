<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // 📄 tampil semua produk
    public function index()
    {
        $produks = Produk::latest()->get();
        return view('produk.index', compact('produks'));
    }

    // ➕ halaman tambah produk
    public function create()
    {
        return view('produk.create');
    }

    // 💾 simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|integer',
            'gambar' => 'nullable|image'
        ]);

        $data = $request->all();

        // upload gambar kalau ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['gambar'] = $filename;
        }

        Produk::create($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // ✏️ halaman edit
    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    // 🔄 update data
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|integer',
            'gambar' => 'nullable|image'
        ]);

        $data = $request->all();

        // kalau upload gambar baru
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['gambar'] = $filename;
        }

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    // 🗑 hapus produk
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}