<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Models\Task;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\AddTaskRequest;
use Response;

class TaskController extends Controller
{
    public function store(AddTaskRequest $request)
    {
        if ($request->ajax()) {
            $taskRequest = $request->only(['name', 'description', 'subject_id']);
            $task = Task::create($taskRequest);
            return Response::json(['success' => true]);
        }
        return Response::json(['success' => false, 'messages' => trans('settings.error_exception')]);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        if ($request->ajax()) {
            $task = Task::findOrFail($id);
            $taskRequest = $request->only(['name', 'description']);
            $task->update($taskRequest);
            return Response::json(['success' => true]);
        }
        return Response::json(['success' => false, 'messages' => trans('settings.error_exception')]);
    }

    public function destroy($id)
    {
        if (Request::ajax()) {
            $task = Task::findOrFail($id);
            $task->delete();
            return Response::json(['success' => true]);
        }
        return Response::json(['success' => false, 'messages' => trans('settings.error_exception')]);
    }
}
