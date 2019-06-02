<?php

namespace App\Support\Traits;

trait HasLogo{

    public function logo(){
        return $this->morphOne(\App\Logo::class, 'logoable');
    }

    public function storeLogo($attributes = []){
        $data = [
            'logoable_type' => get_class($this),
            'logoable_id' => $this->id,
        ];
        $data = $data+$attributes;
        $logo = \App\Logo::attachAndCreate($data);
        return $logo;
    }

    public function attributesUpdateLogo($attributes = []){
        if(!empty($attributes['logo_file'])){
            $file = $attributes['logo_file'];
            if($this->logo){
                $this->logo->updateAttachment($file);
            }else{
                $logoData = [
                    'file' => $file,
                ];
                $logo = $this->storeLogo($logoData);
            }
        }
    }

}