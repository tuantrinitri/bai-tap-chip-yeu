<?php

namespace Core\Listeners;

use Alexusmai\LaravelFileManager\Events\Deleted;
use Core\Services\DeleteThumbnailService;

class FilesDeleted
{
    public function handle(Deleted $event)
    {
        $disk = $event->disk();
        $items = $event->items();

        foreach ($items as $item) {
            $item_path = $disk . DIRECTORY_SEPARATOR . trim($item['path'], DIRECTORY_SEPARATOR);
            $deleteThumbnailService = new DeleteThumbnailService;
            $deleteThumbnailService->execute($item_path, $item['type']);
        }
    }
}