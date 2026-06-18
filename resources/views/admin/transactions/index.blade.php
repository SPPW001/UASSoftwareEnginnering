@extends('layouts.admin')
@section('title','Transaksi')
@section('content')
<h1 class="section-title">Transaksi Checkout</h1><table class="table bg-white"><thead><tr><th>ID</th><th>Pengunjung</th><th>Tanggal</th><th>Total</th><th>Pembayaran</th><th></th></tr></thead><tbody>@foreach($items as $i)<tr><td>#{{ $i->id_transaksi }}</td><td>{{ $i->pengunjung->nama }}</td><td>{{ $i->tanggal }}</td><td>Rp{{ number_format($i->total,0,',','.') }}</td><td>{{ $i->pembayaran?->status }}</td><td><a class="btn btn-sm btn-outline-forest" href="{{ route('admin.transactions.show',$i) }}">Detail</a></td></tr>@endforeach</tbody></table>{{ $items->links() }}
@endsection
