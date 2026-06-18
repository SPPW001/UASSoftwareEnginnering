<?php

namespace App\Exports\Sheets;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PembayaranSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Pembayaran';
    }

    public function array(): array
    {
        $rows = [
            ['LAPORAN PEMBAYARAN'],
            [$this->exportedAt()],
            ['ID Pembayaran', 'ID Transaksi', 'Metode', 'Status', 'Nominal', 'Kode Referensi', 'Tanggal Input'],
        ];

        foreach (Pembayaran::orderByDesc('created_at')->get() as $item) {
            $rows[] = [
                $item->id_pembayaran,
                $item->id_transaksi,
                $item->metode,
                $item->status,
                (float) $item->nominal,
                $item->kode_referensi ?? '-',
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
