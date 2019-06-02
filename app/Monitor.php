<?php

namespace App;

use App\Support\Traits\Filterable;
use App\Support\Traits\HasAuthorUser;
use App\Support\Traits\HasUUID;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{

    use Filterable;
    use Sortable;
    use HasUUID;
    use HasAuthorUser;

    protected $fillable = [
        'uuid',
        'author_user_id',
        'url',
        'expected_status_code',
        'expected_response_content',
    ];

    protected $filterable = [
        'url',
        'global',
    ];

    protected $filterableGlobal = [
        'url',
    ];

    protected $sortable = [
        'url',
    ];

    protected $sortFieldDefault = 'url';
    protected $sortOrderDefault = 'ASC';

    public function path($uri=null){
        $path = 'manage/monitor/'.$this->id;
        return \App\Support\Formatters\PathFormatter::path($path, $uri);
    }

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::addAuthorUserIdToAttributes($attributes);
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
        //
    }

    public function createPing($attributes=[]){
        $ping = \App\Ping::create([
            'pingable_type' => get_class($this),
            'pingable_id' => $this->id,
            'url' => $this->url,
        ]);
        $ping->fetch();
    }

    public function pings(){
        return $this->morphMany(\App\Ping::class,'pingable')->orderBy('created_at','DESC');
    }

    public function getPingLastAttribute(){
        $pings = $this->pings;
        if($pings->count() > 0){
            return $pings->first();
        }
        return null;
    }

}
