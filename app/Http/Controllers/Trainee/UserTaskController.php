<?php

namespace App\Http\Controllers\Trainee;

use App\Http\Controllers\Controller;
use Request;
use App\Models\UserTask;
use App\Http\Requests;
use Response;

class UserTaskController extends Controller
{
    public function update($id)
    {
        if (Request::ajax()) {
            $usertask = UserTask::findOrFail($id);
            $usertask->update(['status' => UserTask::USER_TASK_FINISH]);
            return Response::json(['success' => true]);
        }
        return Response::json(['success' => false, 'messages' => trans('settings.error_exception')]);
    }
}
