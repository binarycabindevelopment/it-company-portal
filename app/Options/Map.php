<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class Map extends BaseOption {

	public function getArray(){
        $items = [];
        $mapsQuery = \App\Map::orderBy('name','ASC');
        if(!empty($this->attributes['mappable_id'])){
            $mapsQuery->where('mappable_id',$this->attributes['mappable_id']);
        }
        if(!empty($this->attributes['mappable_type'])){
            $mapsQuery->where('mappable_type',$this->attributes['mappable_type']);
        }
        $maps = $mapsQuery->get();
        foreach($maps as $map){
            $items[$map->id] = $map->name;
        }
        return $items;
    }

}