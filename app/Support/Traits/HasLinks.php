<?php

namespace App\Support\Traits;

trait HasLinks{

    public function links(){
        return $this->morphMany(\App\Link::class, 'linkable');
    }

    public function getLinksInputAttribute(){
        return $this->links->toArray();
    }

    public function attributesSyncLinks($attributes = []){
        if(!empty($attributes['links_sync_input'])){
            foreach($this->links as $link){
                $link->delete();
            }
            if(isset($attributes['links_input'])){
                foreach($attributes['links_input'] as $linkInput){
                    if(!empty($linkInput['url'])){
                        $linkInput['linkable_type'] = get_class($this);
                        $linkInput['linkable_id'] = $this->id;
                        $link = \App\Link::create($linkInput);
                    }
                }
            }
        }
        return $attributes;
    }

}