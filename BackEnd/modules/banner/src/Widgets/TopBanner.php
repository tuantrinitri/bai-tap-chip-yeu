<?php

namespace Modules\Banner\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Banner\Models\Banner;

class TopBanner extends AbstractWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['partners'] = Banner::where('widget_id', 3)->get();
        $data['name'] = 'CMS';
        return view('banner::widget.partner', $data);
    }
}
