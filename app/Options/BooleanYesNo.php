<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class BooleanYesNo extends BaseOption {

	public function getArray(){
        return [
            '1' => 'Yes',
            '0' => 'No',
        ];
    }

}