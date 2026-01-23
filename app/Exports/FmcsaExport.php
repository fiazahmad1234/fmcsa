<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class FmcsaExport implements FromCollection, WithHeadings
{
    protected $results;

    public function __construct($results)
    {
        $this->results = $results;
    }

    public function collection()
    {
        return new Collection($this->results);
    }

    public function headings(): array
    {
        return ['MC Number', 'Company Name', 'Email', 'Status'];
    }
}
