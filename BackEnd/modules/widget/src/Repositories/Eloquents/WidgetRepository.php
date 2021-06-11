<?php

namespace Modules\Widget\Repositories\Eloquents;

use Core\Models\Module;
use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\Widget\Models\Widget;
use Modules\Widget\Repositories\Interfaces\WidgetInterface;

class WidgetRepository extends BaseRepository implements WidgetInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Widget::class;
    }

    public function listWidget()
    {
        $groups = config('widget.groups');
        $arrWidget = [];
        foreach ($groups as $group) {
            $widgets = $this->where('group', $group['name'])->orderBy('order', 'asc')->get();
            if ($widgets) {
                $minOrder =  $widgets->min('order');
                $maxOrder =  $widgets->max('order');
                foreach ($widgets as $widget) {
                    $widget['minOrder'] = $minOrder;
                    $widget['maxOrder'] = $maxOrder;
                    $arrWidget[$group['name']][] = $widget;
                }
            }
        }
        $data['listWidget'] = $arrWidget;
        $data['groups'] = $groups;
        // get all widget from modules
        $listActiveWidget = [];
        $active_modules = Module::where('status', 1)->get();
        foreach ($active_modules as $mod) {
            $webWidgets = config($mod['name'] . '::widget.web');
            if ($webWidgets) {
                foreach ($webWidgets as $webWidget) {
                    $webWidget['module'] = $mod['name'];
                    $webWidget['module_title'] = $mod['title'];
                    $listActiveWidget[] = $webWidget;
                }
            }
        }
        $data['listActiveWidget'] = $listActiveWidget;
        return $data;
    }

    public function ajaxLoad()
    {
        $groups = config('widget.groups');
        $htmlGroup = [];
        foreach ($groups as $group) {
            $widgets = $this->where('group', $group['name'])->orderBy('order', 'asc')->get();
            $htmlGroup[$group['name']] = view('widget::admin.widget.widget-in-group', compact('widgets'))->render();
        }
        return $htmlGroup;
    }

    public function addWidget($request)
    {
        $widget = config($request->module . '::widget.web.' . $request->widget);
        $data['widget'] = $widget;
        $data['group'] = config('widget.groups.' . $request->group);
        $data['module'] = Module::where('name', $request->module)->first();
        $data['html_config'] = '';
        if (method_exists('modules\\' . $request->module . '\src\Widgets\\' . $request->widget, 'config_view')) {
            $arrConfig = null;
            $data['html_config'] = call_user_func_array(['modules\\' . $request->module . '\src\Widgets\\' . $request->widget, 'config_view'], [$arrConfig]);
        }
        return $data;
    }
}
