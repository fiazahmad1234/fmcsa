<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class EmailSubjectImport implements ToCollection
{
    public $emails = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            // Skip first row if it contains headers
            if ($index === 0 && strtolower($row[0]) === 'email') {
                continue;
            }

            // Trim spaces
            $email = trim($row[0] ?? '');
            $subject = trim($row[1] ?? '');

            // Only add valid-looking emails
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->emails[] = [
                    'email'   => $email,
                    'subject' => $subject ?: "New Dispatch Available",
                ];
            }
        }
    }
}
