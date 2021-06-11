<?php

namespace Modules\Widget\Repositories\Interfaces;

use Core\Supports\Repositories\Interfaces\BaseInterface;
use Modules\Widget\Http\Requests\WidgetRequest;

interface WidgetInterface extends BaseInterface
{
    public function listWidget();
    public function ajaxLoad();
    public function addWidget($request);
}
