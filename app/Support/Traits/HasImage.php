<?php

namespace App\Support\Traits;

trait HasImage{

    public function image(){
        return $this->morphOne(\App\Image::class, 'imageable');
    }

    public function storeImage($attributes = []){
        $data = [
            'imageable_type' => get_class($this),
            'imageable_id' => $this->id,
        ];
        $data = $data+$attributes;
        $image = \App\Image::attachAndCreate($data);
        return $image;
    }

    public function attributesUpdateImage($attributes = []){
        if(!empty($attributes['image_file'])){
            $file = $attributes['image_file'];
            if($this->image){
                $this->image->updateAttachment($file);
            }else{
                $imageData = [
                    'file' => $file,
                ];
                $image = $this->storeImage($imageData);
            }
        }
    }

    public function getImageWidthAttribute(){
        if(!$this->image){
            return null;
        }
        return $this->image->width;
    }

    public function getImageHeightAttribute(){
        if(!$this->image){
            return null;
        }
        return $this->image->height;
    }

}