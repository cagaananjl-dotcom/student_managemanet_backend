<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(['success'=>true, 'data'=>Student::latest()->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id'=>'required|string|max:50|unique:students,student_id',
            'first_name'=>'required|string|max:100',
            'last_name'=>'required|string|max:100',
            'email'=>'required|email|max:255|unique:students,email',
            'phone'=>'nullable|string|max:30',
            'gender'=>'nullable|string|max:20',
            'birth_date'=>'nullable|date',
            'address'=>'nullable|string|max:255',
            'course'=>'required|string|max:100',
            'year_level'=>'required|integer|min:1|max:6',
        ]);
        return response()->json([
            'success'=>true,
            'message'=>'Student created successfully',
            'data'=>Student::create($data)
        ], 201);
    }

    public function show(Student $student)
    {
        return response()->json(['success'=>true, 'data'=>$student->load('enrollments')]);
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'student_id'=>['required','string','max:50',Rule::unique('students','student_id')->ignore($student->id)],
            'first_name'=>'required|string|max:100',
            'last_name'=>'required|string|max:100',
            'email'=>['required','email','max:255',Rule::unique('students','email')->ignore($student->id)],
            'phone'=>'nullable|string|max:30',
            'gender'=>'nullable|string|max:20',
            'birth_date'=>'nullable|date',
            'address'=>'nullable|string|max:255',
            'course'=>'required|string|max:100',
            'year_level'=>'required|integer|min:1|max:6',
        ]);
        $student->update($data);
        return response()->json(['success'=>true,'message'=>'Student updated successfully','data'=>$student]);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['success'=>true,'message'=>'Student deleted successfully']);
    }
}
