<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = ['subject_id', 'name', 'description'];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    
    public function getPivotStatusAttribute($value)
    {
        if ($this->pivot->status == UserTask::USER_TASK_START) {
            return '<span class="label label-default">' . trans('settings.start') . '</span>';
        } elseif ($this->pivot->status == UserTask::USER_TASK_TRAINING) {
            return '<span class="label label-primary">' . trans('settings.training') . '</span>';
        }
        return '<span class="label label-danger">' . trans('settings.finish') . '</span>';
    }

    public function getCheckboxStatusAttribute($value)
    {
        if ($this->pivot->status == UserTask::USER_TASK_FINISH) {
            return '<input class="btnTaskFinish" checked disabled type="checkbox" value="' . $this->pivot->id . '" /> ' . trans("settings.finish"); 
        }
        return '<input class="btnTaskFinish" type="checkbox" value="' . $this->pivot->id . '" /> ' . trans("settings.finish");
    }

    public function isPivotStatusFinish()
    {
        return $this->pivot->status == UserTask::USER_TASK_FINISH;
    }
}
