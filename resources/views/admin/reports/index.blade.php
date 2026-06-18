@extends('layouts.admin')
@section('title','Laporan')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h1 class="section-title mb-1">Laporan & Analytics</h1>
        <p class="text-muted mb-0">Ringkasan revenue, transaksi, merchandise, konservasi, dan partnership ZooLand ERP.</p>
    </div>
    <a href="{{ route('admin.reports.export.excel') }}" class="btn btn-forest shadow-sm">
        Export Excel Multi-Sheet
    </a>
</div>

<div class="card card-soft p-4 mb-4 border-0" style="background:linear-gradient(135deg,#e8f5e9,#fffde7);">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <h5 class="fw-bold mb-1">Export laporan lengkap</h5>
            <div class="text-muted">File Excel berisi sheet Ringkasan, Transaksi, Detail Transaksi, Tiket, Merchandise, Membership, Pembayaran, Event Promo, Upsell Package, Partnership, dan Analytics.</div>
        </div>
        <a href="{{ route('admin.reports.export.excel') }}" class="btn btn-outline-forest">
            Download .xlsx
        </a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3"><div class="stat-card"><div>Revenue</div><h4>Rp{{ number_format($totalRevenue,0,',','.') }}</h4></div></div>
    <div class="col-md-3"><div class="stat-card"><div>Transaksi</div><h4>{{ $totalTransaksi }}</h4></div></div>
    <div class="col-md-3"><div class="stat-card"><div>Pengunjung</div><h4>{{ $totalPengunjung }}</h4></div></div>
    <div class="col-md-3"><div class="stat-card"><div>Dana Konservasi</div><h4>Rp{{ number_format($konservasi,0,',','.') }}</h4></div></div>
</div>

<div class="card card-soft p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Laporan Penjualan Tiket</h4>
        <span class="badge-eco">Tiket</span>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Tiket</th><th>Jumlah</th><th>Total</th></tr></thead>
            <tbody>
            @forelse($tiketRows as $r)
                <tr><td>{{ $r->nama_item }}</td><td>{{ $r->qty }}</td><td>Rp{{ number_format($r->total,0,',','.') }}</td></tr>
            @empty
                <tr><td colspan="3" class="text-muted text-center">Belum ada data tiket.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card card-soft p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Laporan Merchandise & Konservasi</h4>
        <span class="badge-eco">Merchandise</span>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Produk</th><th>Jumlah</th><th>Total</th><th>Konservasi</th></tr></thead>
            <tbody>
            @forelse($merchRows as $r)
                <tr><td>{{ $r->nama_item }}</td><td>{{ $r->qty }}</td><td>Rp{{ number_format($r->total,0,',','.') }}</td><td>Rp{{ number_format($r->konservasi,0,',','.') }}</td></tr>
            @empty
                <tr><td colspan="4" class="text-muted text-center">Belum ada data merchandise.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
