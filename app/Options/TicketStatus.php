<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class TicketStatus extends BaseOption {

	public function getArray(){
        return [
            'Open' => 'Open',
            'Closed' => 'Closed',
        ];
    }

}