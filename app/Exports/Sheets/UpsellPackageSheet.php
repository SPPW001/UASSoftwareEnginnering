<?php

namespace App\Exports\Sheets;

use App\Models\UpsellPackage;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UpsellPackageSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Upsell Package';
    }

    public function array(): array
    {
        $rows = [
            ['LAPORAN UPSELL PACKAGE'],
            [$this->exportedAt()],
            ['ID', 'Nama Paket', 'Harga', 'Status', 'Deskripsi'],
        ];

        foreach (UpsellPackage::orderBy('nama_paket')->get() as $item) {
            $rows[] = [
                $item->id,
                $item->nama_paket,
                (float) $item->harga,
                $item->aktif ? 'Aktif' : 'Nonaktif',
                $item->deskripsi ?? '-',
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        $this->applyBaseStyles($sheet, 5, count($this->array()), ['C']);
        return [];
    }
}
