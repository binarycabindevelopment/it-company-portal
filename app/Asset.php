<?php

namespace App;

use App\Support\Traits\Filterable;
use App\Support\Traits\HasAuthorUser;
use App\Support\Traits\HasContacts;
use App\Support\Traits\HasDateInputs;
use App\Support\Traits\HasLinkedMaps;
use App\Support\Traits\HasLinks;
use App\Support\Traits\HasMarkers;
use App\Support\Traits\HasUUID;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Asset extends Model
{
    use Filterable;
    use Sortable;
    use HasUUID;
    use HasLinks;
    use HasContacts;
    use HasDateInputs;
    use HasAuthorUser;
    use HasLinkedMaps;
    use HasMarkers;

    protected $fillable = [
        'uuid',
        'assetable_id',
        'assetable_type',
        'author_user_id',
        'type',
        'category',
        'name',
        'tag_key',
        'sales_vendor_name',
        'support_vendor_id',
        'manufacturer',
        'serial_number',
        'model_number',
        'client_tag',
        'purchase_at',
        'installed_at',
        'installed_by',
        'warranty_start_at',
        'warranty_end_at',
        'expires_at',
        'configuration_status',
        'configuration_type',
        'configuration_name',
    ];

    protected $dates = [
        'purchase_at',
        'installed_at',
        'warranty_start_at',
        'warranty_end_at',
        'expires_at',
    ];

    protected $dateInputs = [
        'purchase_at',
        'installed_at',
        'warranty_start_at',
        'warranty_end_at',
        'expires_at',
    ];

    protected $filterable = [
        'name',
        'tag_key',
        'assetable_id',
        'archived',
        'global',
    ];

    protected $filterableGlobal = [
        'name',
        'tag_key',
    ];

    protected $sortable = [
        'created_at',
        'name',
        'tag_key',
        'category',
    ];

    protected $sortFieldDefault = 'name';
    protected $sortOrderDefault = 'ASC';

    public function path($uri=null){
        $path = 'manage/asset/'.$this->id;
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
        $this->attributesSyncLinks($attributes);
        $this->attributesSetDates($attributes);
        $this->storeMarkerIfInAttributes($attributes);
    }



    public function getCategoryLabelAttribute(){
        if($this->category){
            $categoryObject = new $this->category;
            return $categoryObject->getLabel();
        }
        return null;
    }

    public function getArchivedAttribute(){
        if($this->expires_at && $this->expires_at < \Carbon\Carbon::now()){
            return true;
        }
        return false;
    }

    public function assetable(){
        return $this->morphTo('assetable');
    }

    public function supportVendor(){
        return $this->belongsTo(\App\SupportVendor::class,'support_vendor_id');
    }

    public function contacts(){
        return $this->belongsToMany(\App\Contact::class, 'asset_contacts');
    }

    public function getPurchaseAtInputAttribute(){
        return $this->purchase_at->format('m/d/Y');
    }

    public function getInstalledAtInputAttribute(){
        return $this->installed_at->format('m/d/Y');
    }

    public function getWarrantyStartAtInputAttribute(){
        return $this->warranty_start_at->format('m/d/Y');
    }

    public function getWarrantyEndAtInputAttribute(){
        return $this->warranty_end_at->format('m/d/Y');
    }

    public function getExpiresAtInputAttribute(){
        return $this->expires_at->format('m/d/Y');
    }

    public function getCustomerIdAttribute(){
        if($this->assetable){
            if($this->assetable->facilityable){
                return $this->assetable->facilityable->id;
            }
        }
        return null;
    }

    public function collectionItems(){
        return $this->morphMany(\App\CollectionItem::class,'collectable');
    }

    public function getCollectionsAttribute(){
        $collections = [];
        foreach($this->collectionItems as $collectionItem){
            $collections[] = $collectionItem->collection;
        }
        return collect($collections);
    }

    public function getAssetsAttribute(){
        $assets = [];
        foreach($this->collections as $collection){
            foreach($collection->items as $collectionItem){
                if($collectionItem->id != $this->id && get_class($this) == $collectionItem->collectable_type){
                    $assets[] = $collectionItem->collectable;
                }
            }
        }
        return collect($assets);
    }

    public function hasLinkedAsset($assetId){
        foreach($this->assets as $asset){
            if($asset->id == $assetId){
                return true;
            }
        }
        return false;
    }

    public function linkAsset($assetId){
        if(!$this->hasLinkedAsset($assetId)){
            $asset = \App\Asset::findOrFail($assetId);
            $collection = \App\Collection::create();
            \App\CollectionItem::create([
                'collection_id' => $collection->id,
                'collectable_id' => $asset->id,
                'collectable_type' => get_class($asset),
            ]);
            \App\CollectionItem::create([
                'collection_id' => $collection->id,
                'collectable_id' => $this->id,
                'collectable_type' => get_class($this),
            ]);
        }
    }

    public function unLinkAsset($assetId){
        $asset = \App\Asset::findOrFail($assetId);
        foreach($this->collections as $collection){
            foreach($collection->items as $collectionItem){
                if($collectionItem->id == $assetId && $collectionItem->collectable_type == get_class($asset)){
                    $collection->delete();
                    return null;
                }
            }
        }
    }

    public function scopeArchived($query,$archive){
        if(!empty($archive)){
            if($archive == 'archived'){
                $query = $query->where('expires_at','<=',\Carbon\Carbon::now());
                //dd($query->get());
                return $query;//$query->where('expires_at','<=',\Carbon\Carbon::now());
            }else{
                $query = $query->where('expires_at','>',\Carbon\Carbon::now());
                //dd($query->get());
                return $query;//$query->where('expires_at','>',\Carbon\Carbon::now());
            }
        }
        return $query;
    }

}
