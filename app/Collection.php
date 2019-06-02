<?php

namespace App;

use App\Events\Collections\CollectionDeleting;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{

    protected $dispatchesEvents = [
        'deleting' => CollectionDeleting::class,
    ];


    public function items(){
        return $this->hasMany(\App\CollectionItem::class,'collection_id');
    }

}
