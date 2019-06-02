<?php

namespace App\Support\Traits;

trait HasContactTypes{

    public function contactTypes(){
        return $this->hasMany(\App\ContactType::class, 'contact_id');
    }

    public function getContactTypesInputAttribute(){
        $items = [];
        foreach($this->contactTypes as $contactType){
            $items[] = $contactType->type;
        }
        return $items;
    }

    public function attributesSyncContactTypes($attributes = []){
        if(!empty($attributes['contact_types_sync_input'])){
            foreach($this->contactTypes as $contactType){
                $contactType->delete();
            }
            if(isset($attributes['contact_types_input'])){
                foreach($attributes['contact_types_input'] as $contactTypeInputType){
                    if(!empty($contactTypeInputType)){
                        $contactTypeInput = [];
                        $contactTypeInput['type'] = $contactTypeInputType;
                        $contactTypeInput['contact_id'] = $this->id;
                        $contactType = \App\ContactType::create($contactTypeInput);
                    }
                }
            }
        }
        return $attributes;
    }

    public function getContactTypesListAttribute(){
        $items = [];
        foreach($this->contactTypes as $contactType){
            $items[] = $contactType->type;
        }
        return implode(', ', $items);
    }

}