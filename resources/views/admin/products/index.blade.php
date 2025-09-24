@extends('layouts.app')

@section('content')
<h2>Manajemen Produk (Admin)</h2>

<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Contoh Produk</td>
            <td>Rp 100.000</td>
            <td>
                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                <a href="#" class="btn btn-sm btn-danger">Hapus</a>
            </td>
        </tr>
    </tbody>
</table>
@endsection
