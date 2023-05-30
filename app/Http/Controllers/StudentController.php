<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        // Get the authenticated student
        $student = auth()->user();

        // Load the courses for the student
        $student->load('courses');

        return view('profile', compact('student'));
    }
}
