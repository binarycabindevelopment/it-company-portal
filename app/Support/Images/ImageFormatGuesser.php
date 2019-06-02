<?php

namespace App\Support\Images;

class ImageFormatGuesser
{

    public static function format($image)
    {
        $mime = $image->mime();
        if ($mime == 'image/jpeg')
            $extension = 'jpg';
        elseif ($mime == 'image/png')
            $extension = 'png';
        elseif ($mime == 'image/gif')
            $extension = 'gif';
        else
            $extension = '';
        return $extension;
    }

}