<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Membership;
use App\Models\Partnership;
use App\Models\Pengunjung;
use App\Models\Transaksi;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index', [
            'totalRevenue' => Transaksi::where('status', 'berhasil')->sum('total'),
            'totalTransaksi' => Transaksi::count(),
            'totalPengunjung' => Pengunjung::count(),
            'totalMember' => Membership::count(),
            'konservasi' => DetailTransaksi::sum('kontribusi_konservasi'),
            'tiketRows' => DetailTransaksi::where('jenis_item','tiket')->selectRaw('nama_item, SUM(jumlah) as qty, SUM(subtotal) as total')->groupBy('nama_item')->get(),
            'merchRows' => DetailTransaksi::where('jenis_item','merchandise')->selectRaw('nama_item, SUM(jumlah) as qty, SUM(subtotal) as total, SUM(kontribusi_konservasi) as konservasi')->groupBy('nama_item')->get(),
            'partnerships' => Partnership::with('perusahaan')->get(),
        ]);
    }
}
