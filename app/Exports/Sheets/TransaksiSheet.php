<?php

namespace App\Exports\Sheets;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Transaksi';
    }

    public function array(): array
    {
        $rows = [
            ['LAPORAN TRANSAKSI'],
            [$this->exportedAt()],
            ['ID Transaksi', 'Pengunjung', 'Email', 'Tanggal', 'Total', 'Status', 'Dibuat Pada'],
        ];

        foreach (Transaksi::with('pengunjung')->orderByDesc('created_at')->get() as $item) {
            $rows[] = [
                $item->id_transaksi,
                $item->pengunjung->nama ?? '-',
                $item->pengunjung->email ?? '-',
                optional($item->tanggal)->format('d-m-Y') ?: $item->tanggal,
                (float) $item->total,
                $item->status,
                optional($item->created_at)->format('d-m-Y H:i'),
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        $this->applyBaseStyles($sheet, 7, count($this->array()), ['E']);
        return [];
    }
}
