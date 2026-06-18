@extends('layouts.public')
@section('title','Checkout Berhasil')
@section('content')
<div class="card card-soft p-4">
  <h1 class="section-title">Checkout Berhasil</h1>
  <p>Invoice: <strong>#{{ $transaksi->id_transaksi }}</strong></p>
  <p>Pengunjung: {{ $transaksi->pengunjung->nama }} · {{ $transaksi->pengunjung->email }}</p>
  <table class="table"><thead><tr><th>Item</th><th>Jenis</th><th>Jumlah</th><th>Subtotal</th></tr></thead><tbody>@foreach($transaksi->details as $d)<tr><td>{{ $d->nama_item }}</td><td>{{ $d->jenis_item }}</td><td>{{ $d->jumlah }}</td><td>Rp{{ number_format($d->subtotal,0,',','.') }}</td></tr>@endforeach</tbody></table>
  <h3>Total: Rp{{ number_format($transaksi->total,0,',','.') }}</h3>
  <p>Status pembayaran: <span class="badge bg-success">{{ $transaksi->pembayaran->status }}</span></p>
  <a href="{{ route('home') }}" class="btn btn-forest">Kembali ke Home</a>
</div>
@endsection
