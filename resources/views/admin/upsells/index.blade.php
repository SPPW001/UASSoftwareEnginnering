@extends('layouts.admin')
@section('title','Upsell')
@section('content')
<div class="d-flex justify-content-between"><h1 class="section-title">Upsell Package</h1><a href="{{ route('admin.upsells.create') }}" class="btn btn-forest">Tambah</a></div><table class="table bg-white"><thead><tr><th>Paket</th><th>Harga</th><th>Aktif</th><th></th></tr></thead><tbody>@foreach($items as $i)<tr><td>{{ $i->nama_paket }}</td><td>Rp{{ number_format($i->harga,0,',','.') }}</td><td>{{ $i->aktif?'Ya':'Tidak' }}</td><td><a class="btn btn-sm btn-outline-forest" href="{{ route('admin.upsells.edit',$i) }}">Edit</a></td></tr>@endforeach</tbody></table>{{ $items->links() }}
@endsection
