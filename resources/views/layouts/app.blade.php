<!DOCTYPE html>
<html>
<head>
    <title>V-Phone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">V-Phone</a>
            <div>
                <a class="btn btn-outline-light btn-sm" href="{{ route('products.index') }}">Produk</a>
                <a class="btn btn-outline-light btn-sm" href="{{ route('cart.index') }}">Keranjang</a>
                <a class="btn btn-outline-light btn-sm" href="{{ route('invoices.index') }}">Invoice</a>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
