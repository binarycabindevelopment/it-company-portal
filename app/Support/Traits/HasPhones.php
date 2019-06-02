<?php

namespace App\Support\Traits;

trait HasPhones{

    public function phones(){
        return $this->morphMany(\App\Phone::class, 'phoneable');
    }

    public function getPhonesInputAttribute(){
        return $this->phones->toArray();
    }

    public function attributesSyncPhones($attributes = []){
        if(!empty($attributes['phones_sync_input'])){
            foreach($this->phones as $phone){
                $phone->delete();
            }
            if(isset($attributes['phones_input'])){
                foreach($attributes['phones_input'] as $phoneInput){
                    if(!empty($phoneInput['number'])){
                        $phoneInput['phoneable_type'] = get_class($this);
                        $phoneInput['phoneable_id'] = $this->id;
                        $phone = \App\Phone::create($phoneInput);
                    }
                }
            }
        }
        return $attributes;
    }

}