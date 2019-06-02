<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\HasCents;
use App\Support\Traits\HasImage;
use App\Support\Traits\Filterable;
use App\Support\Traits\Sortable;

class Product extends Model
{
    use HasCents;
    use HasImage;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'name',
        'sku',
        'category',
        'supplier',
        'brand',
        'description',
        'buy_price_cents',
        'wholesale_price_cents',
        'retail_price_cents',
        'stock',
    ];

    protected $filterableGlobal = [
        'name',
        'supplier',
        'brand',
        'sku',
        'category'
    ];

    protected $filterable = [
        'name',
        'supplier',
        'category',
        'brand',
        'global',
    ];

    protected $sortable = [
        'name',
        'supplier',
        'category',
        'brand',
    ];

    protected $centFields = [
        'buy_price_cents',
        'wholesale_price_cents',
        'retail_price_cents',
    ];

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::attributesDollarsToCents($attributes);
        $model = $query->create($attributes);
        $model->postSave($attributes);
        return $model;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $attributes = static::attributesDollarsToCents($attributes);
        $updateResponse = parent::update($attributes, $options);
        $this->postSave($attributes);
        return $updateResponse;
    }
    public function postSave(array $attributes = []){
        $this->attributesUpdateImage($attributes);
    }

    public function getBuyPriceAttribute(){
        return static::centsToDollars($this->buy_price_cents);
    }

    public function getWholesalePriceAttribute(){
        return static::centsToDollars($this->wholesale_price_cents);
    }
    public function getRetailPriceAttribute(){
        return static::centsToDollars($this->retail_price_cents);
    }

    public function path($uri=null){
        $path = 'manage/inventory/'.$this->id;
        return \App\Support\Formatters\PathFormatter::path($path, $uri);
    }
}
