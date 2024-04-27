<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Menu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MenuExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Menu::all();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'Id',
            'name',
            'description',
            'image',
            'price',
            'Created_at',
            'Updated_at'
        ];
    }

    /**
    * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
    */
    public function styles(Worksheet $sheet)
    {
        $cellRange = 'A1:G1';

        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'FF2F75B5', 
                ],
                'endColor' => [
                    'argb' => 'FF2F75B5',
                ],
            ],
        ];

        $sheet->getStyle('A2:G' . ($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle($cellRange)->applyFromArray($styleArray);
    }
}
