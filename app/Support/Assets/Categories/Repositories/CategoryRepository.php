<?php

namespace App\Support\Assets\Categories\Repositories;

class CategoryRepository{

    public static function all(){
        return [
            \App\Support\Assets\Categories\PrinterCategory::class,
        ];
    }

}