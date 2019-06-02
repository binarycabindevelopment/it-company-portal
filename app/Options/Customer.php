<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class Customer extends BaseOption {

	public function getArray(){
        $items = [];
        $customers = \App\Customer::orderBy('name','ASC')->get();
        foreach($customers as $customer){
            $items[$customer->id] = $customer->name;
        }
        return $items;
    }

}