<?php

namespace App;

use App\Support\Traits\Filterable;
use App\Support\Traits\HasImage;
use App\Support\Traits\HasUUID;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{

    use HasUUID;
    use HasImage;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'uuid',
        'mappable_id',
        'mappable_type',
        'name',
    ];

    protected $filterable = [
        'name',
        'mappable_id',
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

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::addUuidToAttributesIfEmpty($attributes);
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
        $this->attributesUpdateImage($attributes);
    }

    public function mappable()
    {
        return $this->morphTo();
    }

    public function linkedMaps(){
        return $this->hasMany(\App\LinkedMap::class,'map_id');
    }

    public function getAssetsAttribute(){
        $assets = [];
        foreach($this->linkedMaps as $linkedMap){
            if($linkedMap->mappable){
                $assets[] = $linkedMap->mappable;
            }
        }
        return collect($assets);
    }

    public function path($uri=null){
        $path = '/manage/map/'.$this->id;
        return \App\Support\Formatters\PathFormatter::path($path, $uri);
    }

    public function pathView($uri=null){
        $path = '/manage/map/'.$this->id.'/view';
        return \App\Support\Formatters\PathFormatter::path($path, $uri);
    }

    public function getCustomerIdAttribute(){
        if($this->mappable){
            if($this->mappable->facilityable){
                return $this->mappable->facilityable->id;
            }
        }
        return null;
    }

    public function markers(){
        return $this->hasMany(\App\Marker::class,'map_id');
    }


}
