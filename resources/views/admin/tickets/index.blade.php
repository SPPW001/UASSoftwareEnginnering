@extends('layouts.admin')
@section('title','Tiket')
@section('content')
<div class="d-flex justify-content-between align-items-center"><h1 class="section-title">Tiket & Dynamic Pricing</h1><a href="{{ route('admin.tickets.create') }}" class="btn btn-forest">Tambah</a></div>
<table class="table bg-white rounded-4 overflow-hidden"><thead><tr><th>Jenis</th><th>Kategori</th><th>Harga</th><th>Kapasitas</th><th>Aktif</th><th></th></tr></thead><tbody>@foreach($items as $i)<tr><td>{{ $i->jenis_tiket }}</td><td>{{ $i->kategori }}</td><td>Rp{{ number_format($i->harga,0,',','.') }}</td><td>{{ $i->kapasitas_harian }}</td><td>{{ $i->aktif?'Ya':'Tidak' }}</td><td><a href="{{ route('admin.tickets.edit',$i) }}" class="btn btn-sm btn-outline-forest">Edit</a></td></tr>@endforeach</tbody></table>{{ $items->links() }}
@endsection
