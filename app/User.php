<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    const ROLE_TRAINEE = 1;
    const ROLE_SUPERVISOR = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject');
    }

    public function tasks($)
    {
        return $this->belongsToMany('App\Task');
    }

    public function isTrainee()
    {
        return $this->role == ROLE_TRAINEE;
    }

    public function isSupervisor()
    {
        return $this->role == ROLE_SUPERVISOR;
    }

}
