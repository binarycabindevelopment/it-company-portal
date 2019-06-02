<?php

namespace App\Support\Traits;

trait HasAuthorUser{

    public static function addAuthorUserIdToAttributes(array $attributes = []){
        if(\Auth::user() && !isset($attributes['author_user_id'])){
            $attributes['author_user_id'] = \Auth::user()->id;
        }
        return $attributes;
    }

    public function authorUser(){
        return $this->belongsTo(\App\User::class,'author_user_id');
    }

}