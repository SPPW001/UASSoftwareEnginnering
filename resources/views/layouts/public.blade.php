<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ZooLand ERP')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/zooland.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">🌿 ZooLand ERP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <li class="nav-item"><a class="nav-link" href="{{ route('checkout.create') }}">Checkout</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('membership.public') }}">Membership</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('merchandise.public') }}">Merchandise</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('events.public') }}">Event & Promo</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('partnership.public') }}">Partnership</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
        <li class="nav-item"><a class="btn btn-forest" href="{{ route('login') }}">Staff Login</a></li>
      </ul>
    </div>
  </div>
</nav>
<main class="container py-4">
    @if(session('success'))<div class="alert alert-success rounded-4">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger rounded-4">{{ session('error') }}</div>@endif
    @yield('content')
</main>
<footer class="py-4 mt-5 bg-white border-top"><div class="container small text-muted">ZooLand ERP - Ekowisata Terukur. Frontend + backend Laravel starter.</div></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
