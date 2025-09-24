@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <div class="card shadow-lg p-4 rounded">
        <h1 class="mb-3">Selamat Datang di <strong>ChipiChapa</strong></h1>
        <p class="lead">Pilih menu di atas untuk mulai belanja dan nikmati promo menarik!</p>

        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg mt-3">
            Lihat Produk
        </a>
    </div>
</div>
@endsection
