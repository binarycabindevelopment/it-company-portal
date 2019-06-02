<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkedMap extends Model {

    protected $fillable = [
        'mappable_id',
        'mappable_type',
        'map_id',
    ];

    public function map(){
        return $this->belongsTo(\App\Map::class,'map_id');
    }

    public function mappable(){
        return $this->morphTo('mappable');
    }
}
