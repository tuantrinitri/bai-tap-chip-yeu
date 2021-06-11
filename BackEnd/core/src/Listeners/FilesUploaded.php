<?php

namespace Core\Listeners;

use Alexusmai\LaravelFileManager\Events\FilesUploaded as EventsFilesUploaded;
use Core\Services\CreateThumbnailService;

class FilesUploaded
{
    public function handle(EventsFilesUploaded $event)
    {
        /**
         * [
         *      "upload", //disk
         *      null, // path
         *      //file
         *      [{  "name":"IMG_20191011_101241.jpg",
         *          "path":"/IMG_20191011_101241.jpg",
         *          "extension":"jpeg"}
         *      ],
         *      false // overwrite
         * ]
         */
        $disk = $event->disk();
        $files = $event->files();
        $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp'];

        foreach ($files as $file) {
            $file_path = $disk . DIRECTORY_SEPARATOR . trim($file['path'], '/');
            $contentType = mime_content_type($file_path);
            if (in_array($contentType, $allowedMimeTypes)) {
                $createThumbnailService = new CreateThumbnailService;
                $createThumbnailService->execute($file_path);
            }
        }
    }
}