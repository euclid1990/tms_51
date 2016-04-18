<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTask extends Model
{
    const USER_TASK_START = 1;
    const USER_TASK_TRAINING = 2;
    const USER_TASK_FINISH = 3;

    use SoftDeletes;

    protected $fillable = ['user_id', 'task_id', 'status'];
    
    protected $dates = ['deleted_at'];

    public function isStart()
    {
        return $this->status == self::USER_TASK_START;
    }

    public function isTraining()
    {
        return $this->status == self::USER_TASK_TRAINING;
    }

    public function isFinish()
    {
        return $this->status == self::USER_TASK_FINISH;
    }
}
