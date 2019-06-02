<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetContact extends Model
{
    protected $fillable = [
        'asset_id',
        'contact_id',
    ];
}
