<?php

namespace App\Exports\Sheets;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

trait BaseReportSheet
{
    protected function applyBaseStyles(Worksheet $sheet, int $lastColumnIndex, int $lastRow, array $moneyColumns = []): void
    {
        $lastColumn = Coordinate::stringFromColumnIndex($lastColumnIndex);
        $lastRow = max($lastRow, 3);

        $sheet->mergeCells("A1:{$lastColumn}1");
        $sheet->getRowDimension(1)->setRowHeight(30);
        $sheet->getRowDimension(2)->setRowHeight(22);
        $sheet->getRowDimension(3)->setRowHeight(24);

        $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2E7D32'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->mergeCells("A2:{$lastColumn}2");
        $sheet->getStyle("A2:{$lastColumn}2")->applyFromArray([
            'font' => [
                'italic' => true,
                'size' => 10,
                'color' => ['rgb' => '33691E'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E8F5E9'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ]);

        $sheet->getStyle("A3:{$lastColumn}3")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '173B1F'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9EAD3'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'A5D6A7'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        if ($lastRow >= 4) {
            $sheet->getStyle("A4:{$lastColumn}{$lastRow}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'D9EAD3'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ]);

            for ($row = 4; $row <= $lastRow; $row++) {
                if ($row % 2 === 0) {
                    $sheet->getStyle("A{$row}:{$lastColumn}{$row}")->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'F7FBF6'],
                        ],
                    ]);
                }
            }
        }

        foreach ($moneyColumns as $column) {
            $sheet->getStyle("{$column}4:{$column}{$lastRow}")
                ->getNumberFormat()
                ->setFormatCode('"Rp" #,##0');
        }

        $sheet->freezePane('A4');
        $sheet->setAutoFilter("A3:{$lastColumn}{$lastRow}");
        $sheet->getStyle("A1:{$lastColumn}{$lastRow}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    }

    protected function exportedAt(): string
    {
        return 'Tanggal export: ' . now()->format('d-m-Y H:i') . ' | ZooLand ERP';
    }
}
