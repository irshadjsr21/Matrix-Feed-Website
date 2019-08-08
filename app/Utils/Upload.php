<?php

namespace App\Utils;

class Upload
{
    private static $folder = 'images';

    public static function addImage($image, $title)
    {
        $name = str_slug($title) . '_' . time() . '.' . $image->getClientOriginalExtension();
        $filePath = '/' . self::$folder . '/' . $name;
        $image->move(public_path(self::$folder), $name);
        return $filePath;
    }

    public static function deleteImage($imageUrl)
    {
        $imageUrlArray = explode('/', $imageUrl);
        $imageName = $imageUrlArray[sizeof($imageUrlArray) - 1];
        $imagePath = public_path(self::$folder . '\\' . $imageName);
        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }
    }
}
