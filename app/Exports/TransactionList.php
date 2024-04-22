<?php

namespace App\Exports;

use App\Models\TransactionDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionList implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TransactionDetail::with('transaction')->get()->map(function ($transactionDetail) {
            return [
                'id' => $transactionDetail->id,
                'transaction_id' => $transactionDetail->transaction_id,
                'quantity' => $transactionDetail->quantity,
                'unit_price' => $transactionDetail->unit_price,
                'subtotal' => $transactionDetail->subtotal,
                'transaction_date' => $transactionDetail->transaction->transaction_date,
            ];
        });
    }
    
    
    
    /**
     * @return string
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(5); //no
                $event->sheet->getColumnDimension('B')->setAutoSize(True); //nama produk
                $event->sheet->getColumnDimension('C')->setAutoSize(True); //created at
                $event->sheet->getColumnDimension('D')->setAutoSize(True); //Updated at

                //judul atas
                $event->sheet->insertNewRowBefore(1, 3);
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->mergeCells('A2:D2');
                $event->sheet->setCellValue('A1', "DATA LAPORAN");
                $event->sheet->SetCellValue('A2', "PER TANGGAL " . date('d M Y'));

                //style
                $event->sheet->getStyle('A1:A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A2:B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                //border
                $event->sheet->getStyle('A4:F' . $event->sheet->getHighestRow())->ApplyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            }
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Transaksi Id',
            'Quantity',
            'Unit Price',
            'Subtotal',
            'Tanggal Transaksi',
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:F1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '00FF00']]],
        ];
    }
}