<?php

namespace App\Exports\Sheets;

use App\Models\EventPromo;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EventPromoSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Event Promo';
    }

    public function array(): array
    {
        $rows = [
            ['LAPORAN EVENT & PROMO'],
            [$this->exportedAt()],
            ['ID', 'Nama Event', 'Tanggal Mulai', 'Tanggal Selesai', 'Diskon (%)', 'Status', 'Deskripsi'],
        ];

        foreach (EventPromo::orderByDesc('tanggal_mulai')->get() as $item) {
            $rows[] = [
                $item->id,
                $item->nama_event,
                optional($item->tanggal_mulai)->format('d-m-Y') ?: $item->tanggal_mulai,
                optional($item->tanggal_selesai)->format('d-m-Y') ?: $item->tanggal_selesai,
                (float) $item->diskon_persen,
                $item->aktif ? 'Aktif' : 'Nonaktif',
                $item->deskripsi ?? '-',
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        $this->applyBaseStyles($sheet, 7, count($this->array()));
        return [];
    }
}
