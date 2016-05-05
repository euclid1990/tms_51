<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;

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
        'name', 'email', 'password', 'avatar', 'role', 'facebook_id', 'google_id', 'github_id'
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
        return $this->hasMany(Activity::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_course')
            ->withPivot('start_date',  'end_date', 'status');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'user_subject')->withPivot('status');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'user_task')->withPivot('status');
    }

    public function isTrainee()
    {
        return $this->role == self::ROLE_TRAINEE;
    }

    public function isSupervisor()
    {
        return $this->role == self::ROLE_SUPERVISOR;
    }

    public function setPassWordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getAvatarAttribute($value)
    {
        return ($value) ? $value : asset('images/no_image_user.png');
    }

    public function scopeTrainee($query)
    {
        return $query->where('role', self::ROLE_TRAINEE);
    }
}
