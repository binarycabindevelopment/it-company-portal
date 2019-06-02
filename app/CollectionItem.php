<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionItem extends Model
{
    protected $fillable = [
        'collectable_id',
        'collectable_type',
        'collection_id',
    ];

    public function collection(){
        return $this->belongsTo(\App\Collection::class, 'collection_id');
    }

    public function collectable(){
        return $this->morphTo();
    }

}
