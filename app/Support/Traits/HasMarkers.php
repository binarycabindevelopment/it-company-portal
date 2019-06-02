<?php

namespace App\Support\Traits;

trait HasMarkers{

    public function markers(){
        return $this->morphMany(\App\Marker::class, 'markerable');
    }

    protected function storeMarkerIfInAttributes(array $attributes = []){
        if(!empty($attributes['marker'])){
            $marker = $attributes['marker'];
            $markerData = $marker;
            $markerData['markerable_id'] = $this->id;
            $markerData['markerable_type'] = get_class($this);
            $marker = \App\Marker::create($markerData);
            if(!empty($marker['map_id'])){
                $mapId = $marker['map_id'];
                $existingLinkedMap = $this->linkedMaps()->where('map_id',$mapId)->first();
                if(!$existingLinkedMap){
                    \App\LinkedMap::create([
                        'mappable_id' => $this->id,
                        'mappable_type' => get_class($this),
                        'map_id' => $mapId,
                    ]);
                }
            }
        }
    }

}