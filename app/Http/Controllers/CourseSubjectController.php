<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Requests\AddCourseSubjectRequest;
use App\Models\CourseSubject;
use Response;

class CourseSubjectController extends Controller
{
    public function store(AddCourseSubjectRequest $request)
    {
        if ($request->ajax()) {
            $requestCourseSubject = $request->only(['course_id', 'subject_id']);
            $courseSubject = CourseSubject::create($requestCourseSubject);
            return Response::json(['success' => true]);
        }
        return Response::json(['success' => false, 'messages' => trans('settings.error_exception')]);
    }

    public function destroy($id)
    {
        if (Request::ajax()) {
            $courseSubject = CourseSubject::findOrFail($id);
            $courseSubject->delete();
            return Response::json(['success' => true]);
        }
        return Response::json(['success' => false, 'messages' => trans('settings.error_exception')]);
    }
}
