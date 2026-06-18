@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<h1 class="section-title">Dashboard Admin</h1>
<div class="row g-4 my-2">
  <div class="col-md-3"><div class="stat-card"><div class="text-muted">Pengunjung</div><h2>{{ $totalPengunjung }}</h2></div></div>
  <div class="col-md-3"><div class="stat-card"><div class="text-muted">Revenue</div><h2>Rp{{ number_format($totalRevenue,0,',','.') }}</h2></div></div>
  <div class="col-md-3"><div class="stat-card"><div class="text-muted">Transaksi</div><h2>{{ $totalTransaksi }}</h2></div></div>
  <div class="col-md-3"><div class="stat-card"><div class="text-muted">Member</div><h2>{{ $memberAktif }}</h2></div></div>
</div>
<div class="card card-soft p-4 mt-4"><h4>Transaksi Terbaru</h4><table class="table"><thead><tr><th>ID</th><th>Pengunjung</th><th>Tanggal</th><th>Total</th><th>Status</th></tr></thead><tbody>@foreach($recentTransaksi as $t)<tr><td>#{{ $t->id_transaksi }}</td><td>{{ $t->pengunjung->nama }}</td><td>{{ $t->tanggal }}</td><td>Rp{{ number_format($t->total,0,',','.') }}</td><td>{{ $t->status }}</td></tr>@endforeach</tbody></table></div>
@endsection
