<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function createStudent(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students',
            'password' => 'required|string',
            'course_ids' => 'array',
        ]);

        // Create the student
        $student = Student::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Add courses to the student
        if (isset($validatedData['course_ids'])) {
            $student->courses()->attach($validatedData['course_ids']);
        }

        return redirect()->route('teacher-form')->with('success', 'Student created successfully');
    }

    public function updateStudent(Request $request, Student $student)
    {
        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'course_ids' => 'array',
        ]);

        // Update the student
        $student->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Sync courses for the student
        if (isset($validatedData['course_ids'])) {
            $student->courses()->sync($validatedData['course_ids']);
        } else {
            $student->courses()->detach();
        }

        return redirect()->route('teacher-form')->with('success', 'Student updated successfully');
    }

    public function deleteStudent(Student $student): \Illuminate\Http\RedirectResponse
    {
        // Delete the student
        $student->delete();

        return redirect()->route('teacher-form')->with('success', 'Student deleted successfully');
    }
}
