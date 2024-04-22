<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoryExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil seluruh data kategori
        $categories = Category::all();

        // Buat koleksi baru dengan hanya mengambil kolom-kolom yang diinginkan
        $selectedColumns = $categories->map(function ($category) {
            return [
                'Id' => $category->id,
                'Name' => $category->name,
                'Image' => $category->image,
                'Description' => $category->description,
            ];
        });

        return $selectedColumns;
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        // Judul kolom
        return [
            'Id',
            'Name',
            'Image',
            'Description',
        ];
    }

    /**
    * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
    */
    public function styles(Worksheet $sheet)
    {
        // Merge cells untuk judul "Category"
        // $sheet->mergeCells('A1:D1');
        // $sheet->setCellValue('A1', 'Category');
    
        // Set style untuk judul "Category"
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
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
        ]);
    
        // Menyesuaikan lebar kolom untuk "Description"
        $sheet->getColumnDimension('D')->setWidth(30);
    
        // Style untuk headings
        $cellRange = 'A2:D1';
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
    
        $sheet->getStyle($cellRange)->applyFromArray($styleArray);
    
        // Style untuk seluruh data
        $sheet->getStyle('A2:D' . ($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
    }
}
