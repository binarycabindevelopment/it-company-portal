<?php

namespace App\Support\Branding;

class Branding{

    public static function hasLogo(){
        if(file_exists(base_path('/branding/img/logo.png'))){
            return true;
        }
        return false;
    }

}