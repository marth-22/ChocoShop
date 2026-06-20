<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = [
            [
                'nama' => 'Coklat Dark Premium',
                'harga' => 25000,
                'deskripsi' => 'Coklat hitam dengan rasa pekat dan premium',
                'gambar' => 'dark.jpg'
            ],
            [
                'nama' => 'Coklat Susu Almond',
                'harga' => 30000,
                'deskripsi' => 'Coklat susu dengan taburan almond renyah',
                'gambar' => 'almond.jpg'
            ],
            [
                'nama' => 'Coklat White Strawberry',
                'harga' => 28000,
                'deskripsi' => 'White chocolate dengan rasa strawberry segar',
                'gambar' => 'strawberry.jpg'
            ],
        ];

        return view('produk.index', compact('produks'));
    }
}