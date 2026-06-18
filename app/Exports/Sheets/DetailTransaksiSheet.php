<?php

namespace App\Exports\Sheets;

use App\Models\DetailTransaksi;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DetailTransaksiSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Detail Transaksi';
    }

    public function array(): array
    {
        $rows = [
            ['LAPORAN DETAIL TRANSAKSI'],
            [$this->exportedAt()],
            ['ID Detail', 'ID Transaksi', 'Jenis Item', 'Nama Item', 'Jumlah', 'Subtotal', 'Kontribusi Konservasi'],
        ];

        foreach (DetailTransaksi::orderByDesc('created_at')->get() as $item) {
            $rows[] = [
                $item->id_detail,
                $item->id_transaksi,
                $item->jenis_item,
                $item->nama_item,
                (int) $item->jumlah,
                (float) $item->subtotal,
                (float) $item->kontribusi_konservasi,
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        $this->applyBaseStyles($sheet, 7, count($this->array()), ['F', 'G']);
        return [];
    }
}
