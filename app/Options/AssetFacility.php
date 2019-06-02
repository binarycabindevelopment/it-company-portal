<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class AssetFacility extends BaseOption {

	public function getArray(){
        $items = [];
        $assets = \App\Asset::where('assetable_type' , '=','App\Facility')->get();

        foreach($assets as $asset) {
            $items[$asset->id] = $asset->name;
        }

	    return $items;
    }

}