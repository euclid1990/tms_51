<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Requests;
use App\Models\Subject;
use App\Models\Task;
use App\Services\TaskProcessor;

class SubjectController extends Controller
{
    protected $taskProcessor;

    public function __construct(TaskProcessor $taskProcessor)
    {
        $this->taskProcessor = $taskProcessor;
    }
    public function index()
    {
        $subjects = Subject::paginate(ENV('SUBJECT_PER_PAGE'));
        return view('common.subject.index', ['subjects' => $subjects]);
    }

    public function create()
    {
        return view('common.subject.add');
    }

    public function store(AddSubjectRequest $request)
    {
        try {
            //add subject
            $subjectRequest = $request->only(['name', 'description']);
            $subject = Subject::create($subjectRequest);
            //add task
            $taskNames = $request->taskName;
            $taskDescriptions = $request->taskDescription;
            $tasks = $this->taskProcessor->tasks($taskNames, $taskDescriptions);
            if ($tasks) {
                $subject->tasks()->saveMany($tasks);
            }
            return redirect()
                ->route('admin.subject.index')
                ->with(['flash_message' => trans('settings.create_success')]);
        } catch (Exception $ex) {
            return redirect()
                ->route('admin.subject.index')
                ->with(['flash_message' => trans('settings.error_exception')]);
        }
    }

    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        return view('common.subject.show', [
            'subject' => $subject
        ]);
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('common.subject.edit', [
            'subject' => $subject
        ]);
    }

    public function update(UpdateSubjectRequest $request, $id)
    {
        try {
            $subjectRequest = $request->only(['name', 'description']);
            $subject = Subject::findOrFail($id);
            $subject->update($subjectRequest);
            return redirect()
                ->route('admin.subject.index')
                ->with(['flash_message' => trans('settings.update_success')]);

        } catch (Exception $ex) {
            return redirect()
                ->route('admin.subject.index')
                ->with(['flash_message' => trans('settings.error_exception')]);
        }
    }

    public function destroy($id)
    {
        try {
            $subject = Subject::findOrFail($id);
            $subject->tasks()->delete();
            $subject->delete();
            return redirect()
                ->route('admin.subject.index')
                ->with(['flash_message' => trans('settings.delete_success')]);
        } catch (Exception $ex) {
            return redirect()
                ->route('admin.subject.index')
                ->with(['flash_message' => trans('settings.error_exception')]);
        }
        
    }
}
