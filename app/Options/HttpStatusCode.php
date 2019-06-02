<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class HttpStatusCode extends BaseOption {

	public function getArray(){
        return $this->keysAsValues([200]);
    }

}