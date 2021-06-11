<?php

namespace Modules\Menu\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Modules\Menu\Http\Requests\ItemRequest;
use Modules\Menu\Repositories\Interfaces\ItemInterface;

class ItemController extends BaseController
{
    /**
     * MenuController Constructor
     *
     * @param ItemInterface $menuRepository
     */
    function __construct(
        ItemInterface $itemRepository
    ) {
        $this->itemRepository = $itemRepository;
    }

    public function create($id)
    {
        page_title()->setTitle('Thêm menu phụ');
        try {
            $menu = $this->itemRepository->createItem($id);
            return view('menu::admin.item.create', compact('menu'));
        } catch (\Throwable $th) {
            return redirect()->route('menu.admin.index')->with('flash_data', ['type' => 'warning', 'message' => 'Không tìm thấy khối menu']);
        }
    }

    public function ajaxLoadListItem(Request $request)
    {
        if (File::exists(base_path('modules') . DIRECTORY_SEPARATOR . $request->module . DIRECTORY_SEPARATOR . 'menus' .  DIRECTORY_SEPARATOR . 'menu.php')) {
            $menuitem = [];
            include base_path('modules') . DIRECTORY_SEPARATOR . $request->module . DIRECTORY_SEPARATOR . 'menus' .  DIRECTORY_SEPARATOR . 'menu.php';
        }
        return response()->json($menuitem);
    }

    public function store(ItemRequest $request, $id)
    {
        $this->itemRepository->storeItem($request, $id);
        return redirect()->route('menu.admin.item', $id)->with('flash_data', ['type' => 'success', 'message' => 'Đã thêm dữ liệu']);
    }


    public function edit($id)
    {
        try {
            $data['item'] = $this->itemRepository->find($id);
            if (config($data['item']['module'] . '.menu')) {
                $data['listMItem'] = config($data['item']['module'] . '.menu');
            }
            return view('menu::admin.item.edit', $data);
        } catch (\Throwable $th) {
            return redirect()->route('menu.admin.item', $id)->with('flash_data', ['type' => 'warning', 'message' => 'Không tìm thấy menu']);
        }
    }

    public function update(ItemRequest $request, $id)
    {
        try {
            $item = $this->itemRepository->updateItem($request, $id);
            if ($item->parent_id) {
                return redirect()->route('menu.admin.item', $item['parent_id'])->with('flash_data', ['type' => 'success', 'message' => 'Đã cập nhật dữ liệu']);
            }
            return redirect()->route('menu.admin.item', $item['menu_id'])->with('flash_data', ['type' => 'success', 'message' => 'Đã cập nhật dữ liệu']);
        } catch (\Throwable $th) {
            return redirect()->route('menu.admin.item', $id)->with('flash_data', ['type' => 'error', 'message' => 'Đã xảy ra lỗi']);
        }
    }

    public function delete($id)
    {
        $this->itemRepository->where('parent_id', $id)->orWhere('id', $id)->delete();
        mod_menu_fix_order();
        return redirect()->back()->with('flash_data', ['type' => 'success', 'message' => 'Đã xóa dữ liệu']);
    }

    public function ajaxChangeOderMenuItem(Request $request)
    {
        try {
            $this->itemRepository->ajaxOrderItem($request);
            mod_menu_fix_order_item();
            $request->session()->flash('flash_data', ['type' => 'success', 'message' => 'Cập nhật thành công']);
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thành công'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Đã xảy ra lỗi'
            ]);
        }
    }

    public function ajaxChangeStatus(Request $request)
    {
        try {
            $this->itemRepository->update([
                'status' => $request->status,
            ], $request->id);
            return response()->json([
                'status' => true,
                'msg' => 'Đã cập nhật trạng thái'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Đã có lỗi xảy ra'
            ]);
        }
    }
}
