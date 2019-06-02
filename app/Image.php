<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'imageable_type',
        'imageable_id',
        'weight',
        'file_name',
    ];

    public static function attachAndCreate(array $attributes = [], $storagePath='uploads/image'){
        if(!empty($attributes['file'])){
            $image = \Image::make($attributes['file']);
            if($image->width() > 1200){
                $image->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $extension = \App\Support\Images\ImageFormatGuesser::format($image);
            $file_name = uniqid().'.'.$extension;
            \Storage::put($storagePath.'/'.$file_name,(string) $image->stream());
            $attributes['file_name'] = $file_name;
            return static::create($attributes);
        }
        return null;
    }

    public function updateAttachment($file){
        $image = \Image::make($file);
        if($image->width() > 500){
            $image->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $extension = \App\Support\Images\ImageFormatGuesser::format($image);
        $fileName = uniqid().'.'.$extension;
        \Storage::put('uploads/image/'.$fileName,(string) $image->stream());
        $this->file_name = $fileName;
        $this->save();
    }

    public static function create(array $attributes = [])
    {
        $model = static::query()->create($attributes);
        return $model;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $updateResponse = parent::update($attributes, $options);
        return $updateResponse;
    }

    public function imageable(){
        return $this->morphTo('imageable');
    }

    public function fileUrl(){
        $uri = 'uploads/image/'.$this->file_name;
        return url($uri);
    }

    private function filePath(){
        $path = 'app/uploads/image/'.$this->file_name;
        return $path;
    }

    private function storagePath(){
        $path = storage_path($this->filePath());
        return $path;
    }

    public function imageResponse(){
        $image = \Image::make($this->storagePath());
        return $image->response();
    }

    public function getWidthAttribute(){
        $image = \Image::make($this->storagePath());
        if(!$image){
            return null;
        }
        return $image->width();
    }

    public function getHeightAttribute(){
        $image = \Image::make($this->storagePath());
        if(!$image){
            return null;
        }
        return $image->height();
    }
}
