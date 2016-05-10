<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CourseSubject;

class Course extends Model
{
    const COURSE_START = 1;
    const COURSE_TRAINING = 2;
    const COURSE_FINISH = 3;

    use SoftDeletes;

    protected $morphClass = 'course';

    protected $fillable = ['name', 'description', 'status'];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_course');;
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->wherePivot('deleted_at');
    }

    public function courseSubject($subject_id)
    {
        return CourseSubject::where('course_id', $this->id)
            ->where('subject_id', $subject_id)
            ->first();
    }

    public function isStart()
    {
        return $this->status == self::COURSE_START;
    }

    public function isTraining()
    {
        return $this->status == self::COURSE_TRAINING;
    }

    public function isFinish()
    {
        return $this->status == self::COURSE_FINISH;
    }

    public function scopeTraining($query)
    {
        return $query->where('courses.status', self::COURSE_TRAINING);
    }

    public function getPivotStatusAttribute($value)
    {
        if ($this->pivot->status == UserCourse::USER_COURSE_START) {
            return '<span class="label label-default">' . trans('settings.start') . '</span>';
        } elseif ($this->pivot->status == UserCourse::USER_COURSE_TRAINING) {
            return '<span class="label label-primary">' . trans('settings.training') . '</span>';
        }
        return '<span class="label label-danger">' . trans('settings.finish') . '</span>';
    }

    public function isPivotStatusFinish()
    {
        return $this->pivot->status == UserCourse::USER_COURSE_FINISH;
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'actable');
    }

}

