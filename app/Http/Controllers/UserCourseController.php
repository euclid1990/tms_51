<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\AddUserCourseRequest;
use App\Models\UserCourse;

class UserCourseController extends Controller
{
    public function store(AddUserCourseRequest $request)
    {
        try {
            if ($request->start_date && $request->end_date) {
                $requestUserCourse = $request->only([
                    'user_id', 
                    'course_id', 
                    'start_date', 
                    'end_date'
                ]);
            } else $requestUserCourse = $request->only(['user_id', 'course_id']);
            $userCourset = UserCourse::create($requestUserCourse);
            return redirect()
                ->route('admin.course.show', $request->course_id)
                ->with(['flash_message' => trans('settings.create_success')]);
        } catch (Exception $ex) {
            return redirect()
                ->route('admin.course.index')
                ->with(['flash_message' => trans('settings.error_exception')]);
        }
    }
}
