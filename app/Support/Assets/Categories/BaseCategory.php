<?php

namespace App\Support\Assets\Categories;

abstract class BaseCategory{

    protected $label;

    public function getLabel(){
        return $this->label;
    }

}