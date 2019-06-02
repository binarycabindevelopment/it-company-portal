{!! Former::select('map_id','Map')->options(\App\Options\Map::get('---',[
    'mappable_id' => $asset->assetable->id,
    'mappable_type' => get_class($asset->assetable),
]))->required() !!}