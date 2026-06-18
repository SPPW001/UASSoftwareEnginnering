@extends('layouts.public')
@section('title','FAQ')
@section('content')
<h1 class="section-title">FAQ</h1><div class="accordion" id="faq"><div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#a1">Apakah harus login untuk beli tiket?</button></h2><div id="a1" class="accordion-collapse collapse show"><div class="accordion-body">Tidak perlu login. Pengunjung cukup mengisi nama, email, dan no HP saat checkout.</div></div></div><div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#a2">Siapa yang kelola partnership?</button></h2><div id="a2" class="accordion-collapse collapse"><div class="accordion-body">Partnership dikelola oleh Manager. Admin tidak diberi akses mengubah partnership.</div></div></div></div>
@endsection
