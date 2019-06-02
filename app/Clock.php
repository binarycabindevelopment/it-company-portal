<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Clock extends Model
{

    protected $fillable = [
        'clockable_id',
        'clockable_type',
        'created_at',
        'closed_at',
        'closed_manually',
    ];

    protected $dates = [
        'closed_at',
    ];

    protected $editableDateTimes = [
        'created_at_format' => 'created_at',
        'closed_at_format' => 'closed_at',
    ];

    public function clockable(){
        return $this->morphTo('clockable');
    }

    public function close($manual=false){
        $this->closed_at = Carbon::now();
        $this->closed_manually = $manual;
        $this->save();
    }

}
