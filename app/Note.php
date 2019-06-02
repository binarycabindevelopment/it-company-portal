<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\HasAuthorUser;


class Note extends Model
{
    use HasAuthorUser;

    protected $fillable = [
        'notable_id',
        'notable_type',
        'author_user_id',
        'title',
        'body',
    ];

    public function notable(){
        return $this->morphTo('notable');
    }

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::addAuthorUserIdToAttributes($attributes);
        $model = $query->create($attributes);

        $model->postSave($attributes);

        return $model;
    }

    public function postSave(array $attributes = []){
    }

    public function update(array $attributes = [], array $options = [])
    {
        $updateResponse = parent::update($attributes, $options);
        $this->postSave($attributes);
        return $updateResponse;
    }

    public function user(){
        return $this->belongsTo(\App\User::class,'author_user_id');
    }
}
