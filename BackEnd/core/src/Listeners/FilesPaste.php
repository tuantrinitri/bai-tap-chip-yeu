<?php

namespace Core\Listeners;

use Alexusmai\LaravelFileManager\Events\Paste;

class FilesPaste
{
    public function handle(Paste $event)
    {
        // \Log::info('Paste:', [
        //     $event->disk(),
        //     $event->path(),
        //     $event->clipboard(),
        // ]);
        /**
         * ["upload","test",{"type":"cut","disk":"upload","directories":[],"files":["hinh-anh5.jpg"]}]
         * ["upload","test2",{"type":"copy","disk":"upload","directories":[],"files":["test/hinh-anh5.jpg"]}]
         */
        // $old_path = trim($event->disk(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . trim($event->oldName(), DIRECTORY_SEPARATOR);
        // $new_path = trim($event->disk(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . trim($event->newName(), DIRECTORY_SEPARATOR);
        // $renameThumbnailService = new RenameThumbnailService;
        // $renameThumbnailService->execute($old_path, $new_path);
    }
}