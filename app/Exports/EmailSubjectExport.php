<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmailSubjectExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data)->map(function($item) {
            return [
                'email' => $item['Email'] ?? '',
                'subject' => $item['subject'] ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return ['Email', 'Subject'];
    }
}
