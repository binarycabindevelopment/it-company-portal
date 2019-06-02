<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class AssetCategory extends BaseOption {

	public function getArray(){
	    $items = [];
	    $categoryNames = \App\Support\Assets\Categories\Repositories\CategoryRepository::all();
	    foreach($categoryNames as $categoryName){
            $category = new $categoryName;
            $items[$categoryName] = $category->getLabel();
        }
        return $items;
    }

}