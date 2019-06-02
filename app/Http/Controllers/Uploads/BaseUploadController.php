<?php

namespace App\Http\Controllers\Uploads;

use App\Http\Controllers\Controller;
use Storage;

abstract class BaseUploadController extends Controller
{

    protected $storagePrefix;

    public function show($fileName){
        $filePath = $this->storagePrefix.$fileName;
        if(!Storage::exists($filePath)){
            abort(404);
        }
        $fileContents = Storage::get($filePath);
        $mimeType = Storage::mimeType($filePath);
        return response($fileContents)->header('Content-Type', $mimeType);
    }
}