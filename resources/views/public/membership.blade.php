@extends('layouts.public')
@section('title','Membership')
@section('content')
<h1 class="section-title">Membership</h1><div class="row g-4">@foreach(['Silver','Gold','Premium'] as $tier)<div class="col-md-4"><div class="card card-soft p-4 h-100"><h3>{{ $tier }}</h3><p class="text-muted">Benefit kunjungan, promo, dan akses experience sesuai tier.</p><a href="{{ route('checkout.create') }}" class="btn btn-forest">Daftar via Checkout</a></div></div>@endforeach</div>
@endsection
