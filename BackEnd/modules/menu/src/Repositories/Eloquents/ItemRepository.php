<?php

namespace Modules\Menu\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Menu\Models\ItemTranstion;
use Modules\Menu\Models\MenuItem;
use Modules\Menu\Models\MenuItemTranslation;
use Modules\Menu\Repositories\Interfaces\ItemInterface;
use Modules\Menu\Repositories\Interfaces\MenuInterface;

class ItemRepository extends BaseRepository implements ItemInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return MenuItem::class;
    }

    public function createItem($id)
    {
        try {
            return app(MenuInterface::class)->find($id);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function storeItem($request, $id)
    {
        try {
            $data = $request->all();
            $data['menu'] = app(MenuInterface::class)->find($id);
            $maxOrder = $this->where([['menu_id', '=', $id], ['parent_id', '=', $request->parent_id]])->max('order');
            DB::transaction(function () use ($data, $maxOrder, $id) {
                $id_menu_item = $this->create([
                    'link' => $data['link'],
                    'parent_id' => $data['parent_id'],
                    'target' => $data['target'],
                    'menu_id' => $id,
                    'module' => (!empty($data['module']) && !empty($data['item'])) ? $data['module'] : null,
                    'order' => $maxOrder ? $maxOrder + 1 : 1,
                ])->id;
                if ($id_menu_item) {
                    if ($data['title_en']) {
                        MenuItemTranslation::create([
                            'title' => $data['title_en'],
                            'locale' => 'en',
                            'menu_item_id' => $id_menu_item,
                        ]);
                    }
                    if ($data['title_vi']) {
                        MenuItemTranslation::create([
                            'title' => $data['title_vi'],
                            'locale' => 'vi',
                            'menu_item_id' => $id_menu_item,
                        ]);
                    }
                }
            });
            return true;
        } catch (Throwable $th) {
            return $th;
        }
    }

    public function updateItem($request, $id)
    {
        try {
            $this->update([
                'title' => $request->title,
                'link' => $request->link,
                'parent_id' => $request->parent_id,
                'module' => (!empty($request->module) && !empty($request->item)) ? $request->module : null,
                'target' => $request->target,
                'long_title' => $request->long_title,
                'content' => $request->content
            ], $id);
            $item = Menuitem::find($id);
            return $item;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function ajaxOrderItem($request)
    {
        try {
            $id = $request->id;
            $order = $request->order;
            $listMenuItem = $this->where([['id', '!=', $id]])->orderBy('order', 'asc')->get();
            $weight = 0;
            foreach ($listMenuItem as $iMenuItem) {
                ++$weight;
                if ($weight == $order) {
                    ++$weight;
                }
                $this->where('id', $iMenuItem['id'])->update(['order' => $weight]);
            }
            $this->where('id', $id)->update(['order' => $order]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
