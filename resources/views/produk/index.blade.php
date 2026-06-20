<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ChocoShop</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f0ea;
        }

        /* HEADER */
        .header {
            background: #3b2f2f;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
        }

        /* BUTTON TAMBAH */
        .container {
            width: 90%;
            margin: 20px auto;
        }

        .btn-add {
            display: inline-block;
            background: #8b4513;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .btn-add:hover {
            background: #a0522d;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .desc {
            font-size: 13px;
            color: #555;
            margin-bottom: 10px;
        }

        .price {
            color: #8b4513;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* BUTTON ACTION */
        .btn {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            text-decoration: none;
            margin-right: 5px;
        }

        .edit {
            background: #f0ad4e;
            color: white;
        }

        .delete {
            background: #d9534f;
            color: white;
            border: none;
            cursor: pointer;
        }

        .empty {
            text-align: center;
            color: #777;
            margin-top: 50px;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>🍫 Toko Coklat Premium</h1>
    <p>Manis, lembut, dan bikin bahagia</p>
</div>

<div class="container">

    <a href="{{ route('produk.create') }}" class="btn-add">+ Tambah Produk</a>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @if($produks->count() == 0)
        <div class="empty">
            Belum ada produk 😢
        </div>
    @else

    <div class="grid">
        @foreach($produks as $produk)
        <div class="card">

            @if($produk->gambar)
                <img src="{{ asset('images/'.$produk->gambar) }}">
            @else
                <img src="https://via.placeholder.com/300x200?text=Coklat">
            @endif

            <div class="card-body">
                <div class="title">{{ $produk->nama }}</div>
                <div class="desc">{{ $produk->deskripsi }}</div>
                <div class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>

                <a href="{{ route('produk.edit', $produk->id) }}" class="btn edit">Edit</a>

                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn delete" onclick="return confirm('Hapus produk ini?')">
                        Hapus
                    </button>
                </form>

            </div>
        </div>
        @endforeach
    </div>

    @endif

</div>

</body>
</html>