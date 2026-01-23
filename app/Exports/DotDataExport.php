<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DotDataExport implements FromArray, WithHeadings, WithEvents
{
    protected array $data;

    public function __construct(array $data)
    {
        // Trim long text for manageable Excel cells
        $this->data = array_map(function($row) {
            return [
                'DOT' => $row['DOT'] ?? '',
                'CompanyName' => mb_strimwidth($row['CompanyName'] ?? '', 0, 50, '...'),
                'MC' => $row['MC'] ?? '',
                'Status' => $row['Status'] ?? '',
                'PowerUnits' => $row['PowerUnits'] ?? '',
                'Drivers' => $row['Drivers'] ?? '',
                'Phone' => $row['Phone'] ?? '',
                'Email' => mb_strimwidth($row['Email'] ?? '', 0, 50, '...'),
                'Country' => $row['Country'] ?? '',
                'Source' => mb_strimwidth($row['Source'] ?? '', 0, 50, '...'),
                'Error' => mb_strimwidth($row['Error'] ?? '', 0, 50, '...')
            ];
        }, $data);
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'DOT',
            'Company',
            'MC',
            'Status',
            'Power Units',
            'Drivers',
            'Phone',
            'Email',
            'Country',
            'Source',
            'Error'
        ];
    }

    // Optional: auto-width and wrap text
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                foreach(range('A','K') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                $sheet->getStyle('A1:K'.($sheet->getHighestRow()))
                      ->getAlignment()->setWrapText(true);
            },
        ];
    }
}
