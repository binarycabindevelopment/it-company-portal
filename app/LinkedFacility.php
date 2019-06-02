<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkedFacility extends Model
{
    protected $fillable = [
        'facilityable_id',
        'facilityable_type',
        'facility_id'
    ];
  	
  	public function facilityable(){
       return $this->morphTo('facilityable');
   	}

    public function facility(){
        return $this->hasOne(\App\Facility::class,'id','facility_id');
    }
}
