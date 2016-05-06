<?php

namespace App\Http\Controllers\Trainee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Subject;
use App\Models\Course;
use App\Models\User;
use Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->courses;
        return view('trainee.course.index', ['courses' => $courses]);
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        $trainees = $course->users()->trainee()->get();
        $subjects = $course->subjects; 
        return view('trainee.course.show', [
            'course' => $course,
            'trainees' => $trainees,
            'subjects' => $subjects,
        ]);
    }

}
