<?php

namespace Core\Services;

use Illuminate\Support\Facades\File;

class DeleteThumbnailService
{
    public function execute(string $path, string $type)
    {
        $arr_path = explode(DIRECTORY_SEPARATOR, $path);
        array_shift($arr_path);

        if ($type === 'file') {
            /**
             * Prepairing path to thumb
             */
            $file_name = array_pop($arr_path);
            $path_to_thumb = config('cms.thumbnail_folder', 'thumb') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $arr_path);
            $thumb_path = public_path(trim($path_to_thumb, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . trim($file_name, DIRECTORY_SEPARATOR));

            /**
             * Execute delete file
             */
            if (File::exists($thumb_path)) {
                File::delete($thumb_path);
            }
        }

        if ($type === 'dir') {
            $path_to_thumb = config('cms.thumbnail_folder', 'thumb') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $arr_path);
            if (File::isDirectory($path_to_thumb)) {
                File::deleteDirectory($path_to_thumb);
            }
        }

        return true;
    }
}