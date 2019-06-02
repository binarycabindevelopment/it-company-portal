<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'phoneable_type',
        'phoneable_id',
        'type',
        'number',
        'weight',
    ];
}
