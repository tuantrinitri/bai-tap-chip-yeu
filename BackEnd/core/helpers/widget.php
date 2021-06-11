<?php

use Modules\Widget\Models\Widget;
use Widget as AWidget;

if (!function_exists('get_list_widget_admin')) {
   /**
    * Get list widgets for admin spaces
    *
    * @return array
    */
   function get_list_widget_admin()
   {
      global $active_modules;
      $result = [];
      /**
       * List widgets of Admin
       */
      $result['Admin'] = config('Admin::widget.admin');

      /**
       * List widgets of Modules
       */
      if ($active_modules) {
         foreach ($active_modules as $mod) {
            $result[$mod] = config($mod . '::widget.admin');
         }
      }
      return $result;
   }
}

function cms_load_widget()
{
   $listWidget = Cache::remember('list_widgets', 30, function () {
      return Widget::where('status', 1)->get();
   });
   if ($listWidget) {
      foreach ($listWidget as $widget) {
         // dd(ucfirst($widget['module']) . '::' . $widget['name'], $widget);
         $widget = $widget->toArray();
         $widget['config'] = json_decode($widget['config'], true);
         AWidget::group($widget['group'])->position($widget['order'])->addWidget(ucfirst($widget['module']) . '::' . $widget['name'], $widget);
      }
   }
}
