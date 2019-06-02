<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class SupportVendor extends BaseOption {

	public function getArray(){
        $items = [];
        $supportVendors = \App\SupportVendor::orderBy('name','ASC')->get();
        foreach($supportVendors as $supportVendor){
            $items[$supportVendor->id] = $supportVendor->name;
        }
        return $items;
    }

}