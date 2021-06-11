<?php

namespace Core\Listeners;

use Alexusmai\LaravelFileManager\Events\Rename;
use Core\Services\RenameThumbnailService;

class FilesRename
{
    public function handle(Rename $event)
    {
        /**
         * $event->disk(),$event->newName(),$event->oldName(),
         * ["upload","test/hinh-anh.jpg","test/b15e8e1ca67f5d21046e.jpg"]
         */
        $old_path = trim($event->disk(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . trim($event->oldName(), DIRECTORY_SEPARATOR);
        $new_path = trim($event->disk(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . trim($event->newName(), DIRECTORY_SEPARATOR);
        $renameThumbnailService = new RenameThumbnailService;
        $renameThumbnailService->execute($old_path, $new_path);
    }
}