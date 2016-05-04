<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCourse extends Model
{
    const USER_COURSE_START = 1;
    const USER_COURSE_TRAINING = 2;
    const USER_COURSE_FINISH = 3;

    use SoftDeletes;

    protected $table ='user_course';

    protected $fillable = ['user_id', 'course_id', 'start_date', 'end_date', 'status'];

    protected $dates = ['deleted_at'];

    public function isStart()
    {
        return $this->status == self::USER_COURSE_START;
    }

    public function isTraining()
    {
        return $this->status == self::USER_COURSE_TRAINING;
    }


    public function isFinish()
    {
        return $this->status == self::USER_COURSE_FINISH;
    }
    
}
