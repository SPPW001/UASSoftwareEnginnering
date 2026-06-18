@extends('layouts.admin')
@section('title','Form Upsell')
@section('content')
<h1 class="section-title">{{ $item->exists ? 'Edit' : 'Tambah' }} Upsell Package</h1><form class="card card-soft p-4" method="post" action="{{ $item->exists ? route('admin.upsells.update',$item) : route('admin.upsells.store') }}">@csrf @if($item->exists) @method('PUT') @endif
<div class="row g-3"><div class="col-md-6"><label>Nama Paket</label><input name="nama_paket" value="{{ old('nama_paket',$item->nama_paket) }}" class="form-control" required></div><div class="col-md-6"><label>Harga</label><input name="harga" type="number" value="{{ old('harga',$item->harga) }}" class="form-control" required></div><div class="col-12"><label>Deskripsi</label><textarea name="deskripsi" class="form-control">{{ old('deskripsi',$item->deskripsi) }}</textarea></div></div><input type="hidden" name="aktif" value="1"><button class="btn btn-forest mt-4">Simpan</button></form>
@endsection
