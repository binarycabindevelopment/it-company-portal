<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'linkable_type',
        'linkable_id',
        'label',
        'type',
        'url',
        'weight',
    ];
}
