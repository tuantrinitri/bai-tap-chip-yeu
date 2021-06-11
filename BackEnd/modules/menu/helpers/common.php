<?php

use Core\Repositories\Interfaces\ModuleInterface;
use Modules\Menu\Repositories\Interfaces\ItemInterface;
use Modules\Menu\Repositories\Interfaces\MenuInterface;

if (!function_exists('mod_menu_get_tree_menu')) {
   /**
    * Function get tree menu
    *
    * @param [type] $menu_id
    * @return void
    */
   function mod_menu_get_tree_menu($menu_id)
   {
      $listItem = app(ItemInterface::class)
         ->where([['menu_id', '=', $menu_id], ['parent_id', '=', 0]])
         ->orderBy('order', 'asc')->get();
      if (count($listItem) > 0) {
         foreach ($listItem as $k => $item) {
            $listItem[$k]['submenu'] = app(ItemInterface::class)
               ->where([['menu_id', '=', $menu_id], ['parent_id', '=', $item['id']]])
               ->orderBy('order', 'asc')->get();
         }
         return $listItem;
      }
      return [];
   }
}

if (!function_exists('mod_menu_fix_order')) {
   /**
    * Function fix oder list Menu
    *
    * @param integer $parentid
    * @param integer $order
    * @return void
    */
   function mod_menu_fix_order($parentid = 0, $order = 0)
   {
      $listMenu = app(MenuInterface::class)->all();
      foreach ($listMenu as $menu) {
         mod_menu_fix_order_item($parentid, $order, $menu['id']);
      }
   }
}

if (!function_exists('mod_menu_fix_order_item')) {
   /**
    * Function fix oder Menu Item
    *
    * @param integer $parentid
    * @param integer $order
    * @param integer $menu
    * @return void
    */
   function mod_menu_fix_order_item($parentid = 0, $order = 0, $menu = 0)
   {
      $listItem = app(ItemInterface::class)->select('id')->where([['parent_id', '=', $parentid], ['menu_id', '=', $menu]])->orderBy('order', 'asc')->get();
      $weight = 0;
      foreach ($listItem as $item) {
         ++$order;
         ++$weight;
         app(ItemInterface::class)->where('id', $item['id'])->update([
            'order' => $weight
         ]);
         $order = mod_menu_fix_order_item($item['id'], $order, $menu);
      }
      return $order;
   }
}

if (!function_exists('get_list_module_has_menu')) {
   /**
    * Get list Module has Menu 
    *
    * @return void
    */
   function get_list_module_has_menu()
   {
      $modules = cms_actived_modules();
      $result = [];
      foreach ($modules as $d => $mod) {
         if (File::exists(base_path('modules') . DIRECTORY_SEPARATOR . $mod . DIRECTORY_SEPARATOR . 'menus' .  DIRECTORY_SEPARATOR . 'menu.php')) {
            $menuitem = [];
            include base_path('modules') . DIRECTORY_SEPARATOR . $mod . DIRECTORY_SEPARATOR . 'menus'  .  DIRECTORY_SEPARATOR . 'menu.php';
            if (count($menuitem) > 0) {
               $mod = app(ModuleInterface::class)->where('name', $mod)->first();
               $result[] = [
                  'name' => $mod['name'],
                  'title' => $mod['title']
               ];
            }
         }
      }
      // dd($result);
      return $result;
   }
}
