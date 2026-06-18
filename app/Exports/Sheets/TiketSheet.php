<?php

namespace App\Exports\Sheets;

use App\Models\Tiket;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TiketSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Tiket';
    }

    public function array(): array
    {
        $rows = [
            ['LAPORAN DATA TIKET'],
            [$this->exportedAt()],
            ['ID Tiket', 'Jenis Tiket', 'Kategori', 'Harga Dasar', 'Kapasitas Harian', 'Status Aktif'],
        ];

        foreach (Tiket::orderBy('jenis_tiket')->get() as $item) {
            $rows[] = [
                $item->id_tiket,
                $item->jenis_tiket,
                $item->kategori ?? '-',
                (float) $item->harga,
                (int) $item->kapasitas_harian,
                $item->aktif ? 'Aktif' : 'Nonaktif',
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        $this->applyBaseStyles($sheet, 6, count($this->array()), ['D']);
        return [];
    }
}
