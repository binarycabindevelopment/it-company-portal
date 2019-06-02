<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $fillable = [
        'markerable_id',
        'markerable_type',
        'map_id',
        'icon',
        'x',
        'y',
    ];

    public function getMarkerImageURL(){
        return '/img/markers/'.$this->icon.'.png';
    }

    public function getMarkerRGB(){
        if($this->type == 'person'){
            return [76,142,170];
        }
        if($this->type == 'attachment'){
            return [150,150,150];
        }
        return [76,170,92];
    }

}
