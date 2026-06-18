<?php

namespace App\Exports\Sheets;

use App\Models\DetailTransaksi;
use App\Models\Membership;
use App\Models\Merchandise;
use App\Models\Partnership;
use App\Models\Pembayaran;
use App\Models\Pengunjung;
use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AnalyticsSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Analytics';
    }

    public function array(): array
    {
        $totalRevenue = (float) Transaksi::where('status', 'berhasil')->sum('total');
        $totalTransaksi = Transaksi::count();
        $totalBerhasil = Transaksi::where('status', 'berhasil')->count();
        $totalGagal = Transaksi::where('status', '!=', 'berhasil')->count();
        $totalPengunjung = Pengunjung::count();
        $konservasi = (float) DetailTransaksi::sum('kontribusi_konservasi');
        $pembayaranBerhasil = (float) Pembayaran::where('status', 'berhasil')->sum('nominal');
        $rataTransaksi = $totalBerhasil > 0 ? round($totalRevenue / $totalBerhasil, 2) : 0;

        return [
            ['LAPORAN ANALYTICS'],
            [$this->exportedAt()],
            ['Metrik', 'Nilai'],
            ['Total Revenue Berhasil', $totalRevenue],
            ['Rata-rata Nilai Transaksi Berhasil', $rataTransaksi],
            ['Total Pembayaran Berhasil', $pembayaranBerhasil],
            ['Dana Konservasi Terkumpul', $konservasi],
            ['Jumlah Pengunjung', $totalPengunjung],
            ['Jumlah Transaksi', $totalTransaksi],
            ['Jumlah Transaksi Berhasil', $totalBerhasil],
            ['Jumlah Transaksi Belum/Gagal', $totalGagal],
            ['Jumlah Detail Item Terjual', DetailTransaksi::sum('jumlah')],
            ['Jumlah Produk Merchandise', Merchandise::count()],
            ['Jumlah Member', Membership::count()],
            ['Jumlah Partnership', Partnership::count()],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        $this->applyBaseStyles($sheet, 2, count($this->array()), ['B']);
        return [];
    }
}
