<?php

namespace App\Support\Traits;

trait HasLinkedMaps{

    public function linkedMaps(){
        return $this->morphMany(\App\LinkedMap::class, 'mappable');
    }

    public function getMapsAttribute(){
        $maps = [];
        foreach($this->linkedMaps as $linkedMap){
            $maps[] = $linkedMap->map;
        }
        return collect($maps);
    }

}