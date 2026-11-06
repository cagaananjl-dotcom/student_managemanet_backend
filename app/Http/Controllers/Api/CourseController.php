<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index() { return response()->json(['success'=>true,'data'=>Course::latest()->get()]); }

    public function store(Request $request)
    {
        $data=$request->validate([
            'course_code'=>'required|string|max:30|unique:courses,course_code',
            'course_name'=>'required|string|max:150',
            'description'=>'nullable|string'
        ]);
        return response()->json(['success'=>true,'message'=>'Course created successfully','data'=>Course::create($data)],201);
    }

    public function show(Course $course) { return response()->json(['success'=>true,'data'=>$course->load('enrollments')]); }

    public function update(Request $request, Course $course)
    {
        $data=$request->validate([
            'course_code'=>['required','string','max:30',Rule::unique('courses','course_code')->ignore($course->id)],
            'course_name'=>'required|string|max:150',
            'description'=>'nullable|string'
        ]);
        $course->update($data);
        return response()->json(['success'=>true,'message'=>'Course updated successfully','data'=>$course]);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['success'=>true,'message'=>'Course deleted successfully']);
    }
}
