<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class EventRepeat extends BaseOption {

	public function getArray(){
        return [
            '' => 'No Repeat',
            'weekly' => 'Repeat Weekly',
            'monthly' => 'Repeat Monthly',
            'yearly' => 'Repeat Yearly',
        ];
    }

}