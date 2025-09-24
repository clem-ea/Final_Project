@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📑 Daftar Invoice</h2>

    @if(isset($invoices) && count($invoices) > 0)
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nomor Invoice</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>#{{ $invoice->id }}</td>
                        <td>{{ $invoice->created_at->format('d M Y') }}</td>
                        <td>Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-primary">
                                Lihat
                            </a>
                            <a href="{{ route('invoices.print', $invoice->id) }}" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">
            Belum ada invoice.
        </div>
    @endif
</div>
@endsection
