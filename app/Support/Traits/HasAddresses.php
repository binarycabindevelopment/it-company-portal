<?php

namespace App\Support\Traits;

trait HasAddresses{

    public function addresses(){
        return $this->morphMany(\App\Address::class, 'addressable');
    }

    public function getAddressesInputAttribute(){
        return $this->addresses->toArray();
    }

    public function attributesSyncAddresses($attributes = []){
        if(!empty($attributes['addresses_sync_input'])){
            foreach($this->addresses as $address){
                $address->delete();
            }
            if(isset($attributes['addresses_input'])){
                foreach($attributes['addresses_input'] as $addressInput){
                    if(!empty($addressInput['address_1']) || !empty($addressInput['city'])  || !empty($addressInput['state'])  || !empty($addressInput['zipcode'])){
                        $addressInput['addressable_type'] = get_class($this);
                        $addressInput['addressable_id'] = $this->id;
                        $address = \App\Address::create($addressInput);
                    }
                }
            }
        }
        return $attributes;
    }

}