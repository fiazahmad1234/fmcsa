<?php

namespace App\Services; // MUST be plural "Services"

use App\Models\Subject;

class SubjectService
{
    // Create a new Subject
    public function createSubject(array $data)
    {
        return Subject::create($data);
    }

    // Get all subjects
    public function all()
    {
        return Subject::all();
    }
}
