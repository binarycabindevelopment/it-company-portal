<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class CustomerContactType extends BaseOption {

	public function getArray(){
        return [
            'Administrator' => 'Administrator',
            'Billing' => 'Billing',
            'Shipping' => 'Shipping',
        ];
    }

}