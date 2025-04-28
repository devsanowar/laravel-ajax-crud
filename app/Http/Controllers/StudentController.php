<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        return view('students');
    }

    public function addStudent(Request $request){
        $request->validate([
            'name' => 'required|unique:students',
            'email' => 'required|email|unique:students',
            'phone' => 'required|unique:students',
        ]);

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

    }
}
