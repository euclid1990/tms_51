<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    const COURSE_START = 1;
    const COURSE_TRAINING = 2;
    const COURSE_FINISH = 3;

    use SoftDeletes;
    
    protected $fillable = ['name', 'description', 'status'];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
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
}
