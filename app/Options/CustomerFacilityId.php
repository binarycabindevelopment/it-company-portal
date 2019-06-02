<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class CustomerFacilityId extends BaseOption {

	public function getArray(){
	    $items = [];
	    $customers = \App\Customer::all();
	    foreach($customers as $customer){
            $items[$customer->id] = [];
            foreach($customer->facilities as $facility){
                $items[$customer->id][] = $facility->id;
            }
        }
        return $items;
    }

}