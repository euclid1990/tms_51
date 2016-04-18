<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubject extends Model
{
    const USER_SUBJECT_START = 1;
    const USER_SUBJECT_TRAINING = 2;
    const USER_SUBJECT_FINISH = 3;

    use SoftDeletes;

    protected $fillable = ['user_id', 'subject_id', 'status'];

    protected $dates = ['deleted_at'];

    public function isStart()
    {
        return $this->status == self::USER_SUBJECT_START;
    }

    public function isTraining()
    {
        return $this->status == self::USER_SUBJECT_TRAINING;
    }

    public function isFinish()
    {
        return $this->status == self::USER_SUBJECT_FINISH;
    }
}
