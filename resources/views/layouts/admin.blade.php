<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - ZooLand ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/zooland.css') }}" rel="stylesheet">
</head>
<body>
@php($currentUser = session('user_id') ? \App\Models\User::find(session('user_id')) : null)
<div class="container-fluid">
  <div class="row">
    <aside class="col-md-3 col-lg-2 sidebar p-3">
      <h4 class="fw-bold mb-4">🌿 ZooLand</h4>
      <div class="small mb-3 text-white-50">{{ $currentUser?->name }} · {{ strtoupper($currentUser?->role) }}</div>
      <a href="{{ route('admin.dashboard') }}">Dashboard</a>
      <a href="{{ route('admin.tickets.index') }}">Tiket & Pricing</a>
      <a href="{{ route('admin.upsells.index') }}">Upsell Package</a>
      <a href="{{ route('admin.events.index') }}">Event & Promo</a>
      <a href="{{ route('admin.merchandise.index') }}">Merchandise</a>
      <a href="{{ route('admin.memberships.index') }}">Membership</a>
      <a href="{{ route('admin.transactions.index') }}">Transaksi</a>
      <a href="{{ route('admin.reports.index') }}">Laporan & Analytics</a>
      @if($currentUser?->role === 'manager')<a href="{{ route('admin.partnerships.index') }}">Partnership</a>@endif
      <form action="{{ route('logout') }}" method="post" class="mt-4">@csrf<button class="btn btn-light rounded-pill w-100">Logout</button></form>
    </aside>
    <main class="col-md-9 col-lg-10 p-4">
      @if(session('success'))<div class="alert alert-success rounded-4">{{ session('success') }}</div>@endif
      @yield('content')
    </main>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
