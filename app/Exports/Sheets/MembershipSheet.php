<?php

namespace App\Exports\Sheets;

use App\Models\Membership;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembershipSheet implements FromArray, WithTitle, ShouldAutoSize, WithStyles
{
    use BaseReportSheet;

    public function title(): string
    {
        return 'Membership';
    }

    public function array(): array
    {
        $rows = [
            ['LAPORAN MEMBERSHIP'],
            [$this->exportedAt()],
            ['ID Member', 'Pengunjung', 'Email', 'No HP', 'Status Member', 'Tanggal Daftar', 'Jumlah Kunjungan'],
        ];

        foreach (Membership::with('pengunjung')->orderByDesc('created_at')->get() as $item) {
            $rows[] = [
                $item->id_member,
                $item->pengunjung->nama ?? '-',
                $item->pengunjung->email ?? '-',
                $item->pengunjung->no_hp ?? '-',
                $item->status_member,
                optional($item->tanggal_daftar)->format('d-m-Y') ?: $item->tanggal_daftar,
                (int) $item->jumlah_kunjungan,
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
