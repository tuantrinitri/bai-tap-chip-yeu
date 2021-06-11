<?php

namespace Modules\Banner\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Banner\Models\Banner;

class BottomBanner extends AbstractWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['members'] = Banner::where('widget_id', 2)->get();
        $data['name'] = 'CMS';
        return view('banner::widget.member', $data);
    }
}
