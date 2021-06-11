<?php

Breadcrumbs::for('banner.admin.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('banner::admin.banner_management'), route('banner.admin.index'));
});
Breadcrumbs::for('banner.admin.create', function ($trail) {
    $trail->parent('banner.admin.index');
    $trail->push(trans('banner::admin.banner_management'), route('banner.admin.create'));
});
Breadcrumbs::for('banner.admin.edit', function ($trail, $id) {
    $trail->parent('banner.admin.index');
    $trail->push(trans('banner::admin.banner_management'), route('banner.admin.edit', $id));
});
Breadcrumbs::for('banner.admin.widget', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('banner::admin.banner_management'), route('banner.admin.widget'));
});
