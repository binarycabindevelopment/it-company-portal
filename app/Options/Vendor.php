<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class Vendor extends BaseOption {

	public function getArray(){
        $items = [];
        $vendors = \App\SupportVendor::->get();

        foreach($vendors as $vendors){
            $items[$vendors->id] = $vendors->last_name;
        }
        return $items;
    }

}