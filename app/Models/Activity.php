<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $table = 'activities';
    
    protected $fillable = ['user_id', 'description', 'actable_id', 'actable_type'];

    protected $dates = ['deleted_at'];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function actable()
    {
        return $this->morphTo();
    }
}
