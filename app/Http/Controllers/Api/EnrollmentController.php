<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        return response()->json(['success'=>true,'data'=>Enrollment::with(['student','course'])->latest()->get()]);
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'student_id'=>'required|exists:students,id',
            'course_id'=>'required|exists:courses,id',
            'school_year'=>'required|string|max:20',
            'semester'=>'required|in:1st,2nd,Summer',
            'status'=>'required|in:Enrolled,Dropped,Completed'
        ]);
        $exists=Enrollment::where('student_id',$data['student_id'])
            ->where('course_id',$data['course_id'])
            ->where('school_year',$data['school_year'])
            ->where('semester',$data['semester'])->exists();

        if ($exists) return response()->json(['success'=>false,'message'=>'Enrollment already exists'],422);

        return response()->json([
            'success'=>true,'message'=>'Enrollment created successfully',
            'data'=>Enrollment::create($data)->load(['student','course'])
        ],201);
    }

    public function show(Enrollment $enrollment)
    {
        return response()->json(['success'=>true,'data'=>$enrollment->load(['student','course'])]);
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $data=$request->validate([
            'student_id'=>'required|exists:students,id',
            'course_id'=>'required|exists:courses,id',
            'school_year'=>'required|string|max:20',
            'semester'=>'required|in:1st,2nd,Summer',
            'status'=>'required|in:Enrolled,Dropped,Completed'
        ]);
        $enrollment->update($data);
        return response()->json(['success'=>true,'message'=>'Enrollment updated successfully','data'=>$enrollment->load(['student','course'])]);
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return response()->json(['success'=>true,'message'=>'Enrollment deleted successfully']);
    }
}
