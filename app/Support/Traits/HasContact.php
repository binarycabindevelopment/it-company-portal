<?php

namespace App\Support\Traits;

trait HasContact{

    public function contact(){
        return $this->morphOne(\App\Contact::class, 'contactable');
    }

    public function attributesSyncContact($attributes=[]){
        if(!empty($attributes['contact_input'])){
            $contact = $this->contact;
            $contactData = $attributes['contact_input'];
            if(!$contact){
                $contactData['contactable_id'] = $this->id;
                $contactData['contactable_type'] = get_class($this);
                $contact = \App\Contact::create($contactData);
            }else{
                $contact->update($contactData);
            }
        }
    }

    public function getContactInputAttribute(){
        if($this->contact){
            $contactArray = $this->contact->toArray();
            $contactArray['phones_input'] = $this->contact->phones_input;
            $contactArray['addresses_input'] = $this->contact->addresses_input;
            return $contactArray;
        }
        return [];
    }

}