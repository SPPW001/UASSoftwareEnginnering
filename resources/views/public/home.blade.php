@extends('layouts.public')
@section('title','Home')
@section('content')
<section class="hero mb-5">
  <div class="row align-items-center position-relative">
    <div class="col-lg-7">
      <span class="badge-eco">Ekowisata Terukur</span>
      <h1 class="display-5 fw-bold mt-3">Revenue Diversification & Pricing Intelligence untuk Batu Secret Zoo</h1>
      <p class="lead text-muted">Satu sistem untuk checkout tiket, upsell experience, membership, merchandise konservasi, partnership, dan laporan revenue.</p>
      <a href="{{ route('checkout.create') }}" class="btn btn-forest">Mulai Checkout</a>
      <a href="{{ route('events.public') }}" class="btn btn-outline-forest ms-2">Lihat Event</a>
    </div>
    <div class="col-lg-5"><div class="card card-soft p-4"><h5>3 Pilar Sistem</h5><div class="d-grid gap-3 mt-3"><div>🐾 Animal Welfare</div><div>🎓 Visitor Education</div><div>🌱 Conservation Impact</div></div></div></div>
  </div>
</section>
<div class="row g-4 mb-5">
  @foreach($upsells as $u)<div class="col-md-4"><div class="card card-soft h-100 p-3"><h5>{{ $u->nama_paket }}</h5><p class="text-muted">{{ $u->deskripsi }}</p><strong>Rp{{ number_format($u->harga,0,',','.') }}</strong></div></div>@endforeach
</div>
<h3 class="section-title">Merchandise Konservasi</h3>
<div class="row g-4 mb-5">
  @foreach($merchandises as $m)<div class="col-md-4"><div class="card card-soft h-100 p-3"><span class="badge-eco w-fit">{{ $m->kontribusi }}% konservasi</span><h5 class="mt-3">{{ $m->nama_produk }}</h5><p class="text-muted">Stok {{ $m->stok }}</p><strong>Rp{{ number_format($m->harga,0,',','.') }}</strong></div></div>@endforeach
</div>
@endsection
