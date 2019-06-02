<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class Contact extends BaseOption {

	public function getArray(){
	    $items = [];
	    $contacts = \App\Contact::where('contactable_type',$this->attributes['contactable_type'])
            ->where('contactable_id',$this->attributes['contactable_id'])
            ->get();
	    $ignoreIds = [];
	    if(!empty($this->attributes['ignore'])){
            foreach($this->attributes['ignore'] as $ignoreModel){
                $ignoreIds[] = $ignoreModel->id;
            }
        }
	    foreach($contacts as $contact){
	        if(!in_array($contact->id,$ignoreIds)){
                $items[$contact->id] = $contact->last_name.', '.$contact->first_name.' ('.$contact->email.')';
            }
        }
        return $items;
    }

}