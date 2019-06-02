<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkedContact extends Model
{

    protected $fillable = [
        'contactable_id',
        'contactable_type',
        'contact_id',
    ];

    public function contact(){
        return $this->belongsTo(\App\Contact::class,'contact_id');
    }

    public function contactable(){
        return $this->morphTo('contactable');
    }
}
