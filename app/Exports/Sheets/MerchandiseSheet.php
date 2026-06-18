<?php

namespace App\Exports\Sheets;

use App\Models\Merchandise;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MerchandiseSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Merchandise';
    }

    public function array(): array
    {
        $rows = [
            ['LAPORAN MERCHANDISE & KONSERVASI'],
            [$this->exportedAt()],
            ['ID Produk', 'Nama Produk', 'Kategori', 'Harga', 'Stok', 'Jumlah Terjual', 'Kontribusi (%)'],
        ];

        foreach (Merchandise::orderBy('nama_produk')->get() as $item) {
            $rows[] = [
                $item->id_produk,
                $item->nama_produk,
                $item->kategori ?? '-',
                (float) $item->harga,
                (int) $item->stok,
                (int) $item->jumlah_terjual,
                (float) $item->kontribusi,
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        $this->applyBaseStyles($sheet, 7, count($this->array()), ['D']);
        return [];
    }
}
