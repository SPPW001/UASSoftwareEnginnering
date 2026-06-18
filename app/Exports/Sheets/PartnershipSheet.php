<?php

namespace App\Exports\Sheets;

use App\Models\Partnership;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PartnershipSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Partnership';
    }

    public function array(): array
    {
        $rows = [
            ['LAPORAN PARTNERSHIP'],
            [$this->exportedAt()],
            ['ID Partnership', 'Perusahaan', 'Email Perusahaan', 'Kontak', 'Jenis Kerja Sama', 'Tanggal Mulai', 'Tanggal Selesai', 'Kontribusi', 'Status'],
        ];

        foreach (Partnership::with('perusahaan')->orderByDesc('created_at')->get() as $item) {
            $rows[] = [
                $item->id_partnership,
                $item->perusahaan->nama_perusahaan ?? '-',
                $item->perusahaan->email ?? '-',
                $item->perusahaan->kontak ?? '-',
                $item->jenis_kerjasama,
                optional($item->tanggal_mulai)->format('d-m-Y') ?: $item->tanggal_mulai,
                optional($item->tanggal_selesai)->format('d-m-Y') ?: $item->tanggal_selesai,
                (float) $item->kontribusi,
                $item->status,
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        $this->applyBaseStyles($sheet, 9, count($this->array()), ['H']);
        return [];
    }
}
