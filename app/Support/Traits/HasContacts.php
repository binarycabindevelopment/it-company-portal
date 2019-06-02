<?php

namespace App\Support\Traits;

trait HasContacts{

    public function contacts(){
        return $this->morphMany(\App\Contact::class, 'contactable');
    }

}