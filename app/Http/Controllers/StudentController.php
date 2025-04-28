<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();
        return view('students', compact('students'));
    }

    public function addStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:students',
            'email' => 'required|email|unique:students',
            'phone' => 'required|unique:students',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'success' => true,
            'student' => $student,
        ]);
    }

    public function updateStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        $student = Student::find($request->id);

        if (!$student) {
            return response()->json(['success' => false]);
        }

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'success' => true,
            'student' => $student,
        ]);
    }

    public function deleteStudent(Request $request)
    {
        $student = Student::find($request->id);

        if (!$student) {
            return response()->json(['success' => false]);
        }

        $student->delete();

        return response()->json(['success' => true]);
    }
}
