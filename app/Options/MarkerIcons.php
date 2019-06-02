<?php

namespace App\Options;

use App\Support\Markers\Repositories\MarkerRepository;
use KilroyWeb\Options\BaseOption;

class MarkerIcons extends BaseOption {

	public function getArray(){
	    $icons = MarkerRepository::icons();
        $items = [];
        foreach($icons as $icon){
            $items[$icon] = $icon;
        }
        return $items;
    }

}