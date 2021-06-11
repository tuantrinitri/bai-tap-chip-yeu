<?php

use Core\Models\Layout;

if (!function_exists('cms_layout_view')) {
    function cms_layout_view($view, $mod)
    {
        $layout = Layout::where('module', $mod)->where('view', $view)->first();

        return  $layout ? $layout['layout'] : 'main';
    }
}
if (!function_exists('logo_src')) {
    function logo_src($img_path = '')
    {
        if (empty($img_path)) return asset('assets/web/images/LOGO-VINATUNA.png');
        if (File::exists(public_path($img_path))) return asset($img_path);
        return asset('assets/web/images/LOGO-VINATUNA.png');
    }
}
