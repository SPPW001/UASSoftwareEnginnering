@extends('layouts.public')
@section('title','Checkout Gabungan')
@section('content')
<h1 class="section-title mb-3">Checkout Gabungan</h1>
<p class="text-muted">Daftar pengunjung → pilih tiket → opsional upsell/merchandise/membership → pembayaran. Rumit? Iya, makanya dibuat sistem.</p>
<form method="post" action="{{ route('checkout.store') }}" class="row g-4" id="checkoutForm">
@csrf
<div class="col-lg-8">
  <div class="card card-soft p-4 mb-4">
    <h4>Data Pengunjung</h4>
    <div class="row g-3">
      <div class="col-md-4"><label class="form-label">Nama</label><input name="nama" class="form-control" required></div>
      <div class="col-md-4"><label class="form-label">Email</label><input name="email" type="email" class="form-control" required></div>
      <div class="col-md-4"><label class="form-label">No HP</label><input name="no_hp" class="form-control" required></div>
      <div class="col-md-6"><label class="form-label">Tanggal Kunjungan</label><input name="tanggal_kunjungan" type="date" class="form-control" required></div>
    </div>
  </div>
  <div class="card card-soft p-4 mb-4">
    <h4>Tiket</h4>
    <div class="row g-3">
      <div class="col-md-8"><select name="id_tiket" class="form-select price-source" required>
        <option value="">Pilih tiket</option>
        @foreach($tikets as $t)<option value="{{ $t->id_tiket }}" data-price="{{ $t->harga }}">{{ $t->jenis_tiket }} - Rp{{ number_format($t->harga,0,',','.') }}</option>@endforeach
      </select></div>
      <div class="col-md-4"><input name="jumlah_tiket" type="number" class="form-control" value="1" min="1" required></div>
    </div>
  </div>
  <div class="card card-soft p-4 mb-4"><h4>Upsell Package</h4><div class="row g-3">
    @foreach($upsells as $u)<div class="col-md-4"><label class="card p-3 h-100 rounded-4"><input type="checkbox" name="id_upsell_package[]" value="{{ $u->id }}" data-price="{{ $u->harga }}" class="optional-price me-2"> <strong>{{ $u->nama_paket }}</strong><span class="small text-muted">Rp{{ number_format($u->harga,0,',','.') }}</span></label></div>@endforeach
  </div></div>
  <div class="card card-soft p-4 mb-4"><h4>Merchandise</h4><div class="row g-3">
    @foreach($merchandises as $m)<div class="col-md-4"><div class="card p-3 h-100 rounded-4"><label><input type="checkbox" name="id_produk[]" value="{{ $m->id_produk }}" data-price="{{ $m->harga }}" class="merch-check me-2"> <strong>{{ $m->nama_produk }}</strong></label><div class="small text-muted">Rp{{ number_format($m->harga,0,',','.') }} · Stok {{ $m->stok }} · {{ $m->kontribusi }}% konservasi</div><input type="number" name="jumlah_produk[{{ $m->id_produk }}]" min="0" value="0" class="form-control mt-2 merch-qty"></div></div>@endforeach
  </div></div>
  <div class="card card-soft p-4"><h4>Membership Opsional</h4><select name="membership_tier" class="form-select"><option value="">Tidak daftar membership</option><option>Silver</option><option>Gold</option><option>Premium</option></select></div>
</div>
<div class="col-lg-4"><div class="card card-soft p-4 sticky-top" style="top:90px"><h4>Ringkasan</h4><p class="text-muted">Total akan dihitung final oleh server dengan dynamic pricing.</p><div class="fs-3 fw-bold" id="previewTotal">Rp0</div><label class="form-label mt-3">Metode Pembayaran</label><select name="metode" class="form-select" required><option value="QRIS">QRIS</option><option value="Transfer Bank">Transfer Bank</option><option value="E-Wallet">E-Wallet</option></select><button class="btn btn-forest w-100 mt-4">Checkout Sekarang</button></div></div>
</form>
@endsection
@push('scripts')
<script>
function rupiah(n){return new Intl.NumberFormat('id-ID',{style:'currency',currency:'IDR',maximumFractionDigits:0}).format(n)}
function calc(){let total=0;let ticket=document.querySelector('[name=id_tiket]');let opt=ticket.options[ticket.selectedIndex];let qty=parseInt(document.querySelector('[name=jumlah_tiket]').value||1);if(opt&&opt.dataset.price) total+=parseFloat(opt.dataset.price)*qty;document.querySelectorAll('.optional-price:checked').forEach(e=>total+=parseFloat(e.dataset.price));document.querySelectorAll('.merch-check:checked').forEach(e=>{let q=parseInt(e.closest('.card').querySelector('.merch-qty').value||0);total+=parseFloat(e.dataset.price)*q});document.getElementById('previewTotal').innerText=rupiah(total)}
document.getElementById('checkoutForm').addEventListener('change',calc);document.getElementById('checkoutForm').addEventListener('input',calc);calc();
</script>
@endpush
