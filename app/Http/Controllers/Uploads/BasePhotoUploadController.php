<?php

namespace App\Http\Controllers\Uploads;

use App\Http\Controllers\Controller;
use Storage;

abstract class BasePhotoUploadController extends BaseUploadController
{

    protected $storagePrefix;

    public function show($fileName){
        $photo = \App\Photo::where('file_name',$fileName)->first();
        if(!$photo){
            abort(404);
        }
        return $photo->imageResponse();
    }

}