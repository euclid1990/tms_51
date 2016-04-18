<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'description'];

    protected $dates = ['deleted_at'];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
