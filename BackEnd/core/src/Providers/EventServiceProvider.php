<?php

namespace Core\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Alexusmai\LaravelFileManager\Events\FilesUploaded' => [
            'Core\Listeners\FilesUploaded',
        ],
        'Alexusmai\LaravelFileManager\Events\Deleted' => [
            'Core\Listeners\FilesDeleted',
        ],
        'Alexusmai\LaravelFileManager\Events\Rename' => [
            'Core\Listeners\FilesRename',
        ],
        'Alexusmai\LaravelFileManager\Events\Paste' => [
            'Core\Listeners\FilesPaste',
        ],
    ];
}