<?php

namespace App\Support\Formatters;

class PathFormatter{

    public static function path($path, $uri=null){
        if($uri){
            $uri = ltrim($uri,'/');
            $path = $path.'/'.$uri;
        }
        return $path;
    }

}