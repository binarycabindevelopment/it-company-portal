<?php

namespace App\Support\Traits;

trait HasPassword{

    public static function attributesGeneratePasswordIfEmpty($attributes = []){
        if(empty($attributes['password'])){
            $attributes['password'] = str_random(11);
        }
        return $attributes;
    }

    public static function attributesHashPasswordIfExists($attributes = []){
        if(!empty($attributes['password'])){
            $attributes['password'] = \Hash::make($attributes['password']);
        }else{
            unset($attributes['password']);
        }
        return $attributes;
    }

}