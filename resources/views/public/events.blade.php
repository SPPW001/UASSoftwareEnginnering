@extends('layouts.public')
@section('title','Event & Promo')
@section('content')
<h1 class="section-title">Event & Promo</h1><div class="row g-4">@foreach($events as $e)<div class="col-md-4"><div class="card card-soft p-4 h-100"><span class="badge-eco">Diskon {{ $e->diskon_persen }}%</span><h4 class="mt-3">{{ $e->nama_event }}</h4><p>{{ $e->tanggal_mulai }} s/d {{ $e->tanggal_selesai }}</p><p class="text-muted">{{ $e->deskripsi }}</p></div></div>@endforeach</div>
@endsection
