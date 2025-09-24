@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">🛒 Keranjang Belanja</h2>

    @if(isset($cart) && count($cart) > 0)
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama Barang</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp. {{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <a href="{{ route('invoice.create') }}" class="btn btn-success">Cetak Faktur</a>
        </div>
    @else
        <div class="alert alert-warning">
            Keranjang masih kosong.
        </div>
    @endif
</div>
@endsection
