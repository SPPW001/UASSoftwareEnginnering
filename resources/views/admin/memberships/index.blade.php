@extends('layouts.admin')
@section('title','Membership')
@section('content')
<h1 class="section-title">Membership</h1><table class="table bg-white"><thead><tr><th>Pengunjung</th><th>Email</th><th>Status</th><th>Tanggal</th><th>Kunjungan</th></tr></thead><tbody>@foreach($items as $i)<tr><td>{{ $i->pengunjung->nama }}</td><td>{{ $i->pengunjung->email }}</td><td>{{ $i->status_member }}</td><td>{{ $i->tanggal_daftar }}</td><td>{{ $i->jumlah_kunjungan }}</td></tr>@endforeach</tbody></table>{{ $items->links() }}
@endsection
