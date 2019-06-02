<?php

namespace App;

use App\Support\Traits\Filterable;
use App\Support\Traits\HasAuthorUser;
use App\Support\Traits\HasUUID;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{

    use Filterable;
    use Sortable;
    use HasUUID;
    use HasAuthorUser;

    protected $fillable = [
        'uuid',
        'author_user_id',
        'name',
        'url',
        'username',
        'password_encrypted',
    ];

    protected $filterable = [
        'name',
        'url',
        'username',
        'global',
    ];

    protected $filterableGlobal = [
        'name',
        'url',
        'username',
    ];

    protected $sortable = [
        'name',
        'url',
        'username',
    ];

    protected $sortFieldDefault = 'name';
    protected $sortOrderDefault = 'ASC';

    public function path($uri=null){
        $path = 'manage/credential/'.$this->id;
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
        if(!empty($attributes['password'])){
            $this->password_encrypted = \Crypt::encryptString($attributes['password']);
            $this->save();
        }
    }

    public function getPasswordAttribute(){
        if(!empty($this->password_encrypted)) {
            try {
                return \Crypt::decryptString($this->password_encrypted);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $exception){
                return null;
            }
        }
        return null;
    }

}
