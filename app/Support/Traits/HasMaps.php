<?php

namespace App\Support\Traits;

trait HasMaps{

    public function maps(){
        return $this->morphMany(\App\Map::class, 'mappable');
    }

}