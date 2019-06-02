<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkedEmployee extends Model
{
    protected $fillable = [
        'employeeable_id',
        'employeeable_type',
        'employee_id',
    ];

    public function employee(){
        return $this->belongsTo(\App\Employee::class,'employee_id');
    }

    public function employeeable(){
        return $this->morphTo('employeeable');
    }


}
