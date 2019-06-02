<?php

namespace App\Http\Controllers\Manage\Customers\Facilities\Maps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{

    public function create($customerId, $facilityId){
        $facility = \App\Facility::findOrFail($facilityId);
        return view('manage.customer.facility.map.create',[
            'facility'=>$facility,
            'customer'=>$facility->facilityable,
        ]);
    }

    public function store(Request $request, $customerId, $facilityId){
        $facility = \App\Facility::findOrFail($facilityId);
        $mapData = $request->all();
        $mapData['mappable_type'] = get_class($facility);
        $mapData['mappable_id'] = $facility->id;
        $map = \App\Map::create($mapData);
        return redirect($map->path())->withSuccess('Saved');
    }

}
