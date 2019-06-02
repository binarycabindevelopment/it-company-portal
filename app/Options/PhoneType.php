<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class PhoneType extends BaseOption {

	public function getArray(){
        return [
            'phone' => 'Phone',
            'office' => 'Office',
            'cell' => 'Cell',
            'fax' => 'Fax'
        ];
    }

}