<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SubjectService; // MUST match namespace exactly

class SubjectController extends Controller
{
    protected $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function index()
    {
        $subjects = $this->subjectService->all();
        return view('users', compact('subjects'));
    }

    public function create()
    {
        return view('users');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->subjectService->createSubject($data);
        return redirect()->route('subject.index')->with('success', 'Subject created successfully!');
    }
}
