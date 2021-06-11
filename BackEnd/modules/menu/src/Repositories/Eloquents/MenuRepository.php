<?php

namespace Modules\Menu\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\Menu\Models\Menu;
use Modules\Menu\Models\Menuitem;
use Modules\Menu\Repositories\Interfaces\MenuInterface;

class MenuRepository extends BaseRepository implements MenuInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Menu::class;
    }

    public function index()
    {
        $menus = $this->all();
        foreach ($menus as $k => $menu) {
            $menus[$k]['items'] = Menuitem::where('menu_id', $menu['id'])->get();
        }
        return $menus;
    }

    public function store($request)
    {
        try {
            $this->create(['title' => $request->title]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateMenu($request, $id)
    {
        try {
            $this->update(['title' => $request->title], $id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function item($request, $id)
    {
        try {

            $data['menu'] = $this->find($id);
            if ($data['menu']) {
                $parent_id = $request->query('parent_id', 0);
                $data['minOrder'] = Menuitem::where([['menu_id', '=', $id], ['parent_id', '=', $parent_id]])->min('order');
                $data['maxOrder'] = Menuitem::where([['menu_id', '=', $id], ['parent_id', '=', $parent_id]])->max('order');
                $data['items'] = Menuitem::where([['menu_id', '=', $id], ['parent_id', '=', $parent_id]])->orderBy('order')->get();
                if (count($data['items']) > 0) {
                    foreach ($data['items'] as $k => $item) {
                        $data['items'][$k]['numsubmenu'] = Menuitem::where([['menu_id', '=', $id], ['parent_id', '=', $item['id']]])->count();
                    }
                }
            }
            return $data;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
