@extends('layouts.admin')
@section('title','Event Promo')
@section('content')
<div class="d-flex justify-content-between"><h1 class="section-title">Event & Promo</h1><a href="{{ route('admin.events.create') }}" class="btn btn-forest">Tambah</a></div><table class="table bg-white"><thead><tr><th>Event</th><th>Periode</th><th>Diskon</th><th>Aktif</th><th></th></tr></thead><tbody>@foreach($items as $i)<tr><td>{{ $i->nama_event }}</td><td>{{ $i->tanggal_mulai }} - {{ $i->tanggal_selesai }}</td><td>{{ $i->diskon_persen }}%</td><td>{{ $i->aktif?'Ya':'Tidak' }}</td><td><a class="btn btn-sm btn-outline-forest" href="{{ route('admin.events.edit',$i) }}">Edit</a></td></tr>@endforeach</tbody></table>{{ $items->links() }}
@endsection
