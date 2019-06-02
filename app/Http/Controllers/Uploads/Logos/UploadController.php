<?php

namespace App\Http\Controllers\Uploads\Logos;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Uploads\BaseUploadController;
use Storage;

class UploadController extends BaseUploadController
{

    protected $storagePrefix;

    public function show($fileName){
        $logo = \App\Logo::where('file_name',$fileName)->first();
        if(!$logo){
            abort(404);
        }
        return $logo->imageResponse();
    }

}