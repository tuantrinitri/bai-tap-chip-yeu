<?php

namespace Modules\Widget\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Modules\Widget\Repositories\Interfaces\WidgetInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Modules\Widget\Http\Requests\WidgetRequest;

class WidgetController extends BaseController
{
    /**
     * WidgetController Constructor
     *
     * @param WidgetInterface $widgetRepository
     */
    function __construct(
        WidgetInterface $widgetRepository
    ) {
        $this->widgetRepository = $widgetRepository;
    }

    public function index()
    {
        page_title()->setTitle(trans('widget::admin.list_widget'));
        $data = $this->widgetRepository->listWidget();
        return view('widget::admin.widget.list', $data);
    }

    public function ajaxLoadWidgetToGroup()
    {
        try {
            $htmlGroup = $this->widgetRepository->ajaxLoad();
            Artisan::call('cache:clear');
            return response()->json(['status' => true, 'html' => $htmlGroup]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Đã xảy ra lỗi, vui lòng tải lại trang.']);
        }
    }
    public function ajaxLoadAddWidget(Request $request)
    {
        try {
            $data = $this->widgetRepository->addWidget($request);
            Artisan::call('cache:clear');
            return response()->json(['status' => true, 'html' => view('widget::admin.widget.formAddWidget', $data)->render()]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Đã xảy ra lỗi, vui lòng thử lại.']);
        }
    }

    public function ajaxSubmitAddWidget(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'module' => 'required',
            'name' => 'required',
            'group' => 'required',
        ], [
            'title.required' => 'Chưa nhập tiêu đề',
            'module.required' => 'Chưa nhập module',
            'name.required' => 'Chưa nhập tên',
            'group.required' => 'Chưa nhập vị trí',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin']);
        }
        try {
            $maxOrder = $this->widgetRepository->where('group', $request->group)->max('order');
            $this->widgetRepository->create([
                'module' => ucfirst($request->module),
                'name' => $request->name,
                'title' => $request->title,
                'group' => $request->group,
                'config' => $request->has('config') ? json_encode($request->config) : json_encode([]),
                'status' => 1,
                'order' => $maxOrder ? $maxOrder + 1 : 1
            ]);
            Artisan::call('cache:clear');
            return response()->json(['status' => true, 'message' => 'Thêm widget thành công']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Đã xảy ra lỗi, vui lòng thử lại.']);
        }
    }

    public function ajaxSubmitUpdateWidget(WidgetRequest $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
        ], [
            'title.required' => 'Chưa nhập tiêu đề',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin']);
        }

        try {
            $this->widgetRepository->where('id', $request->id)->update([
                'title' => $request->title,
                'config' => $request->has('config') ? json_encode($request->config) : json_encode([]),
            ]);
            Artisan::call('cache:clear');
            return response()->json(['status' => true, 'message' => 'Cập nhật widget thành công']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Đã xảy ra lỗi, vui lòng thử lại.']);
        }
    }

    public function ajaxSubmitDeleteWidget(Request $request)
    {
        try {
            $this->widgetRepository->where('id', $request->id)->delete();
            Artisan::call('cache:clear');
            return response()->json(['status' => true, 'message' => 'Xóa widget thành công']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Đã xảy ra lỗi, vui lòng thử lại.']);
        }
    }
    public function ajaxUpdatePositionWidget(Request $request)
    {
        try {
            $from_group = $request->from_group;
            $to_group = $request->to_group;
            $widget_id = $request->widget_id;
            $arr_source = $request->arr_source;
            $arr_target = $request->arr_target;
            if ($from_group != $to_group) {
                $this->widgetRepository->where('id', $widget_id)->update(['group' => $to_group]);
                if ($arr_source) {
                    $order = 1;
                    foreach ($arr_source as $idW) {
                        $this->widgetRepository->where('id', $idW)->update(['order' => $order]);
                        $order++;
                    }
                }
                if ($arr_target) {
                    $order = 1;
                    foreach ($arr_target as $idW) {
                        $this->widgetRepository->where('id', $idW)->update(['order' => $order]);
                        $order++;
                    }
                }
            } else {
                if ($arr_target) {
                    $order = 1;
                    foreach ($arr_target as $idW) {
                        $this->widgetRepository->where('id', $idW)->update(['order' => $order]);
                        $order++;
                    }
                }
            }
            Artisan::call('cache:clear');
            return response()->json(['status' => true, 'message' => 'Đã cập nhật vị trí widget']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Đã xảy ra lỗi, vui lòng thử lại.']);
        }
    }
}
