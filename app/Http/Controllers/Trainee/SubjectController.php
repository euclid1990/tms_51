<?php

namespace App\Http\Controllers\Trainee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Subject;
use App\Models\User;
use Auth;

class SubjectController extends Controller
{
    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        $trainees = $subject->users()->trainee()->get();
        $taskInSubject = $subject->tasks->pluck('id')->all();
        $tasks = Auth::user()->tasks->whereIn('id', $taskInSubject);
        $activities = $subject->activities()->paginate(ENV('ACTIVITY_PER_PAGE'));
        return view('trainee.subject.show', [
            'subject' => $subject,
            'trainees' => $trainees,
            'tasks' => $tasks,
            'activities' => $activities,
        ]);
    }

}
