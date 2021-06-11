<?php

namespace Core\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CreateThumbnailService
{
    public function execute(string $path_img)
    {
        /**
         * Prepairing path to thumb
         */
        $arr_path = explode(DIRECTORY_SEPARATOR, $path_img);
        array_shift($arr_path);
        $file_name = array_pop($arr_path);
        $path_to_thumb = config('cms.thumbnail_folder', 'thumb') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $arr_path);

        if (!File::isDirectory(public_path($path_to_thumb))) {
            File::makeDirectory(public_path($path_to_thumb), 0777, true);
        }
        $thumb_path = public_path(trim($path_to_thumb, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . trim($file_name, DIRECTORY_SEPARATOR));

        /**
         * Make original image
         * Get width, height of original image
         */
        $original_image = Image::make($path_img);
        $original_width = $original_image->width();
        $original_height = $original_image->height();

        /**
         * Get setting size, qualitity
         * Check each folder by other setting size
         */
        $setting_width = 300;
        $setting_height = 200;
        $setting_qualitity = 70;

        /**
         * Resize, save thumbnail
         */
        if ($original_height / $original_width > $setting_height / $setting_width) {
            $original_image->heighten($setting_height);
        } else {
            $original_image->widen($setting_width);
        }
        $original_image->save($thumb_path, $setting_qualitity);

        return $thumb_path;
    }
}