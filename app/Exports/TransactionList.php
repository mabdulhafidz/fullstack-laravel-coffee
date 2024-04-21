<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Resersvation;
use App\Models\Table;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionList implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): Collection
    {
        return TransactionDetail::all();
    }

  

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'Id',
            'Transaction Id',
            'Quantity',
            'Unit Price',
            'Amount',
            'Date of Issue',
            'Created_at',
            'Updated_at'
        ];
    }

    public function title(): string
    {
        return 'Laporan Transaksi'; 
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
                $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
                
                $event->sheet->setCellValue('A2', 'Date: ' . $startDate . ' - ' . $endDate);
            },
        ];
    }

    /**
    * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
    */
    public function styles(Worksheet $sheet)
    {
        $cellRange = 'A1:M1';

        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'FF2F75B5', 
                ],
                'endColor' => [
                    'argb' => 'FF2F75B5',
                ],
            ],
        ];

        $sheet->getStyle('A2:M' . ($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle($cellRange)->applyFromArray($styleArray);
    }
}
