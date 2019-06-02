<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class Facility extends BaseOption {

	public function getArray(){
	    $items = [];
	    $facilities = \App\Facility::orderBy('name','ASC')->get();
	    foreach($facilities as $facility){
            $items[$facility->id] = $facility->name;
        }
        return $items;
    }

}