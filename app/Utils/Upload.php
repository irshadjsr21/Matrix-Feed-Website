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

    public static function duplicateImage($preUrl, $newTitle)
    {
        $preImageUrlArray = explode('/', $preUrl);
        $preImageName = $preImageUrlArray[sizeof($preImageUrlArray) - 1];
        $preImagePath = public_path(self::$folder . '\\' . $preImageName);

        $preImageNameArray = explode('.', $preImageName);
        $extension = $preImageNameArray[sizeof($preImageNameArray) - 1];

        if (file_exists($preImagePath)) {
            $name = str_slug($newTitle) . '_' . time() . '.' . $extension;
            $filePath = self::$folder . '\\' . $name;
            copy($preImagePath, public_path($filePath));
            return '/' . self::$folder . '/' . $name;
        }
        return null;
    }
}
