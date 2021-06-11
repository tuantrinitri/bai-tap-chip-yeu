<?php

namespace Modules\Post\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Post\Models\Category;
use Modules\Post\Models\Post;

class ListPost extends AbstractWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['name'] = 'CMS';
        $data['lang'] = app()->getLocale();
        $data['categories'] = Category::get();
        return view('post::widget.list', $data);
    }
}
