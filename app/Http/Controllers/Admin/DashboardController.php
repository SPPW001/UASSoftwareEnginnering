<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Merchandise;
use App\Models\Pengunjung;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalPengunjung' => Pengunjung::count(),
            'totalRevenue' => Transaksi::where('status', 'berhasil')->sum('total'),
            'totalTransaksi' => Transaksi::count(),
            'memberAktif' => Membership::count(),
            'produkStokRendah' => Merchandise::where('stok', '<=', 5)->count(),
            'recentTransaksi' => Transaksi::with('pengunjung')->latest()->take(8)->get(),
        ]);
    }
}
