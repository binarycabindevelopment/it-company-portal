<?php

namespace App\Http\Controllers\Manage\Maps\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ViewController extends Controller
{

    public function index(Request $request, $mapId){
        $map = \App\Map::findOrFail($mapId);
        return view('manage.map.view.index',[
            'map' => $map,
        ]);
    }

}
