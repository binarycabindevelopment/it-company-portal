<?php

namespace App\Support\Markers;

class Marker{

    public $icon;
    public $style;

    public function __construct($icon=null,$style=null)
    {
        $this->icon = $icon;
        $this->style = $style;
    }

}