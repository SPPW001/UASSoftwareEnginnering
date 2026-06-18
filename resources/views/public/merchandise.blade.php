@extends('layouts.public')
@section('title','Merchandise')
@section('content')
<h1 class="section-title">Merchandise Store</h1><div class="row g-4">@foreach($merchandises as $m)<div class="col-md-4"><div class="card card-soft p-4 h-100"><span class="badge-eco">{{ $m->kontribusi }}% untuk konservasi</span><h4 class="mt-3">{{ $m->nama_produk }}</h4><p>Stok: {{ $m->stok }}</p><h5>Rp{{ number_format($m->harga,0,',','.') }}</h5></div></div>@endforeach</div>
@endsection
