<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmailSubjectImport implements ToCollection
{
    public $emails = []; // Stores emails and subjects

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            // Skip header row
            if ($index === 0 && strtolower($row[0]) === 'email') {
                continue;
            }

            $email = trim($row[0] ?? '');
            $subject = trim($row[1] ?? '');

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->emails[] = [
                    'email'   => $email,
                    'subject' => $subject ?: "New Dispatch Available",
                ];
            }
        }
    }
}
