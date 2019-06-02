<?php

namespace App\Support\Traits;

trait HasCreatedAt{

    public function getDisplayCreatedAtDiffAttribute(){
        return $this->created_at->diffForHumans();
    }

}