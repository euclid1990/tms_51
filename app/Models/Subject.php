<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    const SUBJECT_START = 1;
    const SUBJECT_TRAINING = 2;
    const SUBJECT_FINISH = 3;

    use SoftDeletes;

    protected $morphClass = 'subject';

    protected $fillable = ['name', 'description', 'status'];
    
    protected $dates = ['deleted_at'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_subject')->withPivot('status');;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function isStart()
    {
        return $this->status == self::SUBJECT_START;
    }

    public function isTraining()
    {
        return $this->status == self::SUBJECT_TRAINING;
    }

    public function isFinish()
    {
        return $this->status == self::SUBJECT_FINISH;
    }

    public function getPivotStatusAttribute($value)
    {
        if ($this->pivot->status == UserSubject::USER_SUBJECT_START) {
            return '<span class="label label-default">' . trans('settings.start') . '</span>';
        } elseif ($this->pivot->status == UserSubject::USER_SUBJECT_TRAINING) {
            return '<span class="label label-primary">' . trans('settings.training') . '</span>';
        }
        return '<span class="label label-danger">' . trans('settings.finish') . '</span>';
    }

    public function isPivotStatusFinish()
    {
        return $this->pivot->status == UserSubject::USER_SUBJECT_FINISH;
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'actable');
    }
    
}
