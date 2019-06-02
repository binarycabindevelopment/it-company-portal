<?php

namespace App\Http\Controllers\Manage\Assets\Assets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function create($assetId){
        $asset = \App\Asset::findOrFail($assetId);
        return view('manage.asset.asset.create',['asset'=>$asset]);
    }

    public function store(Request $request, $assetId){
        $asset = \App\Asset::findOrFail($assetId);
        $asset->linkAsset($request->asset_id);
        return redirect($asset->path())->withSuccess('Saved');
    }

}
