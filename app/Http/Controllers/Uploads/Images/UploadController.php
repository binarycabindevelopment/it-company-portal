<?php

namespace App\Http\Controllers\Uploads\Images;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Uploads\BaseUploadController;
use Storage;

class UploadController extends BaseUploadController
{

    protected $storagePrefix;

    public function show($fileName){
        $image = \App\Image::where('file_name',$fileName)->first();
        if(!$image){
            abort(404);
        }
        return $image->imageResponse();
    }

}