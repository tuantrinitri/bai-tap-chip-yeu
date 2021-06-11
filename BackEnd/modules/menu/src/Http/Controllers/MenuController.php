<?php

namespace Modules\Menu\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Illuminate\Http\Request;
use Modules\Menu\Http\Requests\MenuRequest;
use Modules\Menu\Models\MenuItem;
use Modules\Menu\Repositories\Interfaces\ItemInterface;
use Modules\Menu\Repositories\Interfaces\MenuInterface;

class MenuController extends BaseController
{
    /**
     * MenuController Constructor
     *
     * @param MenuInterface $menuRepository
     */
    function __construct(
        MenuInterface $menuRepository,
        ItemInterface $itemRepository
    ) {
        $this->menuRepository = $menuRepository;
        $this->itemRepository = $itemRepository;
    }

    public function index()
    {
        page_title()->setTitle(trans('menu::admin.list_menu'));
        $menus = $this->menuRepository->index();
        return view('menu::admin.menu.index', compact('menus'));
    }

    public function create()
    {
        page_title()->setTitle('Thêm menu');
        return view('menu::admin.menu.create');
    }

    public function store(MenuRequest $request)
    {
        $this->menuRepository->store($request);
        return redirect()->route('menu.admin.index')->with('flash_data', ['type' => 'success', 'message' => 'Đã thêm dữ liệu']);
    }

    public function edit($id)
    {
        try {
            page_title()->setTitle('Sửa menu');
            $menu = $this->menuRepository->find($id);
            return view('menu::admin.menu.edit', compact('menu'));
        } catch (\Throwable $th) {
            return redirect()->route('menu.admin.index')->with('flash_data', ['type' => 'error', 'message' => 'Không tìm thấy menu']);
        }
    }

    public function update(MenuRequest $request, $id)
    {
        try {
            $this->menuRepository->updateMenu($request, $id);
            return redirect()->route('menu.admin.index')->with('flash_data', ['type' => 'success', 'message' => 'Sửa dữ liệu thành công']);
        } catch (\Throwable $th) {
            return redirect()->route('menu.admin.edit', $id)->with('flash_data', ['type' => 'error', 'message' => 'Đã xảy ra lỗi']);
        }
    }

    public function item($id, Request $request)
    {
        try {
            app()->getLocale();
            $data = $this->menuRepository->item($request, $id);
            // foreach ($data['items'] as $key => $value) {
            //     dd($value->translate('vi', true)->title);
            // }
            // $menu =  MenuItem::first();
            // dd($menu->itemTranstion()->get());

            return view('menu::admin.item.index', $data);
        } catch (\Throwable $th) {
            return $th;
            return redirect()->route('menu.admin.index')->with('flash_data', ['type' => 'warning', 'message' => 'Không tìm thấy khối menu']);
        }
    }


    public function delete($id)
    {
        $this->itemRepository->where('menu_id', $id)->delete();
        $this->menuRepository->where('id', $id)->delete();
        return redirect()->route('menu.admin.index')->with('flash_data', ['type' => 'success', 'message' => 'Đã xóa dữ liệu']);
    }
}
