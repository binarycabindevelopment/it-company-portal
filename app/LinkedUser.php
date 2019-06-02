<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkedUser extends Model
{
    protected $fillable = [
        'userable_id',
        'userable_type',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }

    public function userable(){
        return $this->morphTo('userable');
    }
}
