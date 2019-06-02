<?php

namespace App\Support\Traits;

trait HasUUID{

    public static function generateUuid(){
        return \Uuid::generate()->string;
    }

    public static function findByUuid($uuid){
        return static::where('uuid', $uuid)->first();
    }

    public static function addUuidToAttributesIfEmpty($attributes){
        if(empty($attributes['uuid'])){
            $attributes['uuid'] = static::generateUuid();
        }
        return $attributes;
    }

}