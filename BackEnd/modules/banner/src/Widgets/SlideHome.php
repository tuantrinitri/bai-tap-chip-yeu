<?php

namespace Modules\Banner\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Banner\Models\Banner;

class SlideHome extends AbstractWidget
{
   /**
    * Treat this method as a controller action.
    * Return view() or other content to display.
    */
   public function run()
   {
      $data['name'] = 'CMS';
      $data['slide'] = Banner::where('widget_id', 1)->get();
      return view('banner::widget.slide', $data);
   }
}
