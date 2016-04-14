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

    protected $fillable = ['name', 'description', 'status'];
    
    protected $dates = ['deleted_at'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
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
    
}
