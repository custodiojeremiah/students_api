<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_number' => 'required|string|unique:students',
            'student_name' => 'required|string',
            'contact_number' => 'required|string',
            'email_address' => 'required|string|email|unique:students',
            'age' => 'required|integer'
        ]);

        return Student::create($request->all());
    }

    public function show(Student $student)
    {
        return $student;
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_number' => 'sometimes|required|string|unique:students,student_number,' . $student->id,
            'student_name' => 'sometimes|required|string',
            'contact_number' => 'sometimes|required|string',
            'email_address' => 'sometimes|required|string|email|unique:students,email_address,' . $student->id,
            'age' => 'sometimes|required|integer'
        ]);

        $student->update($request->all());

        return $student;
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response(null, 204);
    }
}
