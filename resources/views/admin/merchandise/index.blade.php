@extends('layouts.admin')
@section('title','Merchandise')
@section('content')
<div class="d-flex justify-content-between"><h1 class="section-title">Merchandise</h1><a href="{{ route('admin.merchandise.create') }}" class="btn btn-forest">Tambah</a></div><table class="table bg-white"><thead><tr><th>Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Konservasi</th><th></th></tr></thead><tbody>@foreach($items as $i)<tr><td>{{ $i->nama_produk }}</td><td>{{ $i->kategori }}</td><td>Rp{{ number_format($i->harga,0,',','.') }}</td><td>{{ $i->stok }}</td><td>{{ $i->kontribusi }}%</td><td><a class="btn btn-sm btn-outline-forest" href="{{ route('admin.merchandise.edit',$i) }}">Edit</a></td></tr>@endforeach</tbody></table>{{ $items->links() }}
@endsection
