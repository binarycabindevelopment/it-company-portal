<?php

namespace App\Http\Controllers\Manage\Maps\View\Markers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MarkerController extends Controller
{

    public function create(Request $request, $mapId){
        $map = \App\Map::findOrFail($mapId);
        $formData = $request->all();
        if($request->type == 'asset'){
            $fieldsView = 'manage.asset.partials.fields';
        }
        return view('manage.map.view.marker.create',[
            'map' => $map,
            'formData' => $formData,
            'fieldsView' => $fieldsView,
        ]);
    }

    public function store(Request $request, $mapId){
        $map = \App\Map::findOrFail($mapId);
        if($request->type == 'asset'){
            $asset = \App\Asset::create($request->all());
        }
        return redirect('/manage/map/'.$map->id.'/view');
    }

}
