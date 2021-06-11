<?php

/**
 * Manager Block Menu
 */

use Modules\Menu\Models\Menuitem;

Breadcrumbs::for('menu.admin.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('menu::admin.menu_management'), route('menu.admin.index'));
});
Breadcrumbs::for('menu.admin.create', function ($trail) {
    $trail->parent('menu.admin.index');
    $trail->push(trans('menu::admin.menu_create'), route('menu.admin.create'));
});
Breadcrumbs::for('menu.admin.edit', function ($trail, $id) {
    $trail->parent('menu.admin.index');
    $trail->push(trans('menu::admin.menu_edit'), route('menu.admin.edit', $id));
});
/**
 * Manager Menu Item
 */
Breadcrumbs::for('menu.admin.item', function ($trail, $id) {
    $trail->parent('menu.admin.index');
    $trail->push('Khối #' . $id, route('menu.admin.item', $id));
});

Breadcrumbs::for('item.admin.create', function ($trail, $id) {
    $trail->parent('menu.admin.item', $id);
    $trail->push('Thêm menu', route('item.admin.create', $id));
});

Breadcrumbs::for('item.admin.edit', function ($trail, $id) {
    $menu_item = Menuitem::find($id);
    $trail->parent('menu.admin.item', $menu_item->menu_id);
    $trail->push('Sửa menu #' . $id, route('item.admin.edit', $id));
});
