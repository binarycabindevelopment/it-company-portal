<?php

namespace App;

use App\Support\Traits\Filterable;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class SupportVendor extends Model
{

    use Filterable;
    use Sortable;

    protected $fillable = [
        'name',
    ];

    protected $filterable = [
        'name',
        'global',
    ];

    protected $filterableGlobal = [
        'name',
    ];

    protected $sortable = [
        'created_at',
        'name',
    ];

    protected $sortFieldDefault = 'name';
    protected $sortOrderDefault = 'ASC';

}
