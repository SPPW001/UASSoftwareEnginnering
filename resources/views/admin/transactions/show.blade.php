@extends('layouts.admin')
@section('title','Detail Transaksi')
@section('content')
<h1 class="section-title">Transaksi #{{ $item->id_transaksi }}</h1><div class="card card-soft p-4"><p>{{ $item->pengunjung->nama }} · {{ $item->pengunjung->email }}</p><table class="table"><thead><tr><th>Item</th><th>Jenis</th><th>Qty</th><th>Subtotal</th><th>Konservasi</th></tr></thead><tbody>@foreach($item->details as $d)<tr><td>{{ $d->nama_item }}</td><td>{{ $d->jenis_item }}</td><td>{{ $d->jumlah }}</td><td>Rp{{ number_format($d->subtotal,0,',','.') }}</td><td>Rp{{ number_format($d->kontribusi_konservasi,0,',','.') }}</td></tr>@endforeach</tbody></table><h4>Total Rp{{ number_format($item->total,0,',','.') }}</h4></div>
@endsection
