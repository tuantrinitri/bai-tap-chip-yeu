<?php

namespace Modules\Banner\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\Banner\Models\BannerWidget;
use Modules\Banner\Repositories\Interfaces\WidgetInterface;

class WidgetRepository extends BaseRepository implements WidgetInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return BannerWidget::class;
    }
}
