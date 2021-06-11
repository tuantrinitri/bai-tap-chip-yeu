<?php
if (!function_exists('cms_load_widget_admin')) {
   /**
    * Auto render all widget admin
    *
    * @return void
    */
   function cms_load_widget_admin()
   {
      // get list widget admin status = 1
      $listWidget = Cache::remember('list_widget_admin', 30, function () {
         return AdminWidget::where('status', 1)->get();
      });

      if ($listWidget) {
         foreach ($listWidget as $widget) {
            $widget['config'] = json_decode($widget['config'] ? $widget['config'] : '[]', true);
            // add widget to group
            Widget::group($widget['group'])->position($widget['order'])->addWidget($widget['module'] . '::' . $widget['name'], $widget);
         }
      }
   }
}

function get_widgets_module($module_name)
{
   /**
    * Load all list widget of module
    */
   $path_to_widget = base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'Widgets');
   $classPaths = cms_scan_folder($path_to_widget);
   $classes = array();
   foreach ($classPaths as $classPath) {
      $segments = explode('/', $classPath);
      $segments = explode('\\', $segments[count($segments) - 1]);
      $rClass = preg_replace('/\\.[^.\\s]{3,4}$/', '', $segments[count($segments) - 1]);
      if (method_exists('Modules\\' . $module_name . '\Widgets\\' . $rClass, 'config_view')) {
         $classes[] = [
            'value' => $rClass,
            'hasConfig' => 1
         ];
      } else {
         $classes[] = [
            'value' => $rClass,
            'hasConfig' => 0
         ];
      }
   }
   return $classes;
}
