@extends('layouts.admin')
@section('title','Partnership')
@section('content')
<div class="d-flex justify-content-between"><h1 class="section-title">Partnership Manager</h1><a href="{{ route('admin.partnerships.create') }}" class="btn btn-forest">Tambah</a></div><table class="table bg-white"><thead><tr><th>Perusahaan</th><th>Jenis</th><th>Kontribusi</th><th>Status</th><th></th></tr></thead><tbody>@foreach($items as $i)<tr><td>{{ $i->perusahaan->nama_perusahaan }}</td><td>{{ $i->jenis_kerjasama }}</td><td>Rp{{ number_format($i->kontribusi,0,',','.') }}</td><td>{{ $i->status }}</td><td><a class="btn btn-sm btn-outline-forest" href="{{ route('admin.partnerships.edit',$i) }}">Edit</a></td></tr>@endforeach</tbody></table>{{ $items->links() }}
@endsection
