<?php

namespace App\Support\Traits;

trait HasLinkedContacts{

    public function linkedContacts(){
        return $this->morphMany(\App\LinkedContact::class, 'contactable');
    }

    public function getContactsAttribute(){
        $contacts = [];
        foreach($this->linkedContacts as $linkedContact){
            $contacts[] = $linkedContact->contact;
        }
        return collect($contacts);
    }

    public function getDisplayContactsAttribute(){
        $items = [];
        foreach($this->contacts as $contact){
            $items[] = $contact->name;
        }
        return implode(', ',$items);
    }

}