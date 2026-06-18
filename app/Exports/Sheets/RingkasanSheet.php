<?php

namespace App\Exports\Sheets;

use App\Models\DetailTransaksi;
use App\Models\EventPromo;
use App\Models\Membership;
use App\Models\Merchandise;
use App\Models\Partnership;
use App\Models\Pembayaran;
use App\Models\Pengunjung;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\UpsellPackage;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RingkasanSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Ringkasan';
    }

    public function array(): array
    {
        return [
            ['LAPORAN RINGKASAN ZOOLAND ERP'],
            [$this->exportedAt()],
            ['Bidang', 'Jumlah / Total'],
            ['Total Pengunjung', Pengunjung::count()],
            ['Total Tiket Aktif', Tiket::where('aktif', true)->count()],
            ['Total Transaksi', Transaksi::count()],
            ['Transaksi Berhasil', Transaksi::where('status', 'berhasil')->count()],
            ['Total Revenue Berhasil', Transaksi::where('status', 'berhasil')->sum('total')],
            ['Total Pembayaran Berhasil', Pembayaran::where('status', 'berhasil')->sum('nominal')],
            ['Total Detail Item Terjual', DetailTransaksi::sum('jumlah')],
            ['Total Dana Konservasi', DetailTransaksi::sum('kontribusi_konservasi')],
            ['Total Produk Merchandise', Merchandise::count()],
            ['Total Member', Membership::count()],
            ['Total Event & Promo Aktif', EventPromo::where('aktif', true)->count()],
            ['Total Upsell Package Aktif', UpsellPackage::where('aktif', true)->count()],
            ['Total Partnership', Partnership::count()],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        $this->applyBaseStyles($sheet, 2, count($this->array()), ['B']);
        return [];
    }
}
