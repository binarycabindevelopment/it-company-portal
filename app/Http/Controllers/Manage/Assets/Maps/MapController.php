<?php

namespace App\Http\Controllers\Manage\Assets\Maps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function create($assetId){
        $asset = \App\Asset::findOrFail($assetId);
        return view('manage.asset.map.create',['asset'=>$asset]);
    }

    public function store(Request $request, $assetId){
        $asset = \App\Asset::findOrFail($assetId);
        $mapData = $request->all();
        $mapData['mappable_type'] = get_class($asset);
        $mapData['mappable_id'] = $asset->id;
        $mapLink = \App\LinkedMap::create($mapData);
        return redirect($asset->path())->withSuccess('Saved');
    }

}
