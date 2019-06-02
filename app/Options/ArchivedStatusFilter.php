<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class ArchivedStatusFilter extends BaseOption {

	public function getArray(){
        return [
            '' => 'Show All',
            'archived' => 'Archived',
            'unarchived' => 'UnArchived',
        ];
    }

}