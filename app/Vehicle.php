<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Support\Traits\Filterable;
use App\Support\Traits\HasAuthorUser;
use App\Support\Traits\Sortable;

class Vehicle extends Model
{

    use Filterable;
    use Sortable;
    use HasAuthorUser;

    protected $fillable = [
        'author_user_id',
        'make',
        'model',
        'year',
        'vin',
    ];

    protected $filterable = [
        'make',
        'model',
        'year',
        'vin',
        'global',
    ];

    protected $filterableGlobal = [
        'make',
        'model',
        'year',
        'vin',
    ];

    protected $sortable = [
        'make',
        'model',
        'year',
        'vin',
    ];
    protected $sortFieldDefault = 'model';
    protected $sortOrderDefault = 'ASC';

    public function path($uri=null){
        $path = 'manage/vehicle/'.$this->id;
        return \App\Support\Formatters\PathFormatter::path($path, $uri);
    }

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::addAuthorUserIdToAttributes($attributes);
        $model = $query->create($attributes);
        $model->postSave($attributes);
        return $model;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $updateResponse = parent::update($attributes, $options);
        $this->postSave($attributes);
        return $updateResponse;
    }

    public function postSave(array $attributes = []){
    }

}
