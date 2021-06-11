<?php

namespace Core\Services;

use Illuminate\Support\Facades\File;

class RenameThumbnailService
{
    public function execute(string $old_path_original, string $new_path_original)
    {
        $arr_old_path_original = explode(DIRECTORY_SEPARATOR, $old_path_original);
        $arr_new_path_original = explode(DIRECTORY_SEPARATOR, $new_path_original);
        array_shift($arr_old_path_original);
        array_shift($arr_new_path_original);

        if (File::isDirectory(public_path($old_path_original))) {
            $old_path_thumb = config('cms.thumbnail_folder', 'thumb') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $arr_old_path_original);
            $new_path_thumb = config('cms.thumbnail_folder', 'thumb') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $arr_new_path_original);
            if (File::isDirectory($old_path_thumb)) {
                File::move($old_path_thumb, $new_path_thumb);
            }
        } elseif (File::exists($old_path_original)) {
            $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp'];
            $contentType = mime_content_type($old_path_original);
            if (in_array($contentType, $allowedMimeTypes)) {
                $old_file_name = array_pop($arr_old_path_original);
                $new_file_name = array_pop($arr_new_path_original);
                $old_path_thumb = public_path(config('cms.thumbnail_folder', 'thumb') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $arr_old_path_original) . DIRECTORY_SEPARATOR . trim($old_file_name, DIRECTORY_SEPARATOR));
                $new_path_thumb = public_path(config('cms.thumbnail_folder', 'thumb') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $arr_new_path_original) . DIRECTORY_SEPARATOR . trim($new_file_name, DIRECTORY_SEPARATOR));
                if (File::exists($old_path_thumb)) {
                    File::move($old_path_thumb, $new_path_thumb);
                } else {
                    $createThumbnailService = new CreateThumbnailService;
                    $createThumbnailService->execute($old_path_original);
                    File::move($old_path_thumb, $new_path_thumb);
                    if (File::exists($old_path_thumb)) {
                        File::delete($old_path_thumb);
                    }
                }
            }
        }

        return true;
    }
}