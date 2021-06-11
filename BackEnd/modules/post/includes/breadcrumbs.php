<?php

Breadcrumbs::for('category.admin.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('post::category.name'), route('category.admin.index'));
});
Breadcrumbs::for('category.admin.create', function ($trail) {
    $trail->parent('category.admin.index');
    $trail->push(trans('post::category.create'), route('category.admin.create'));
});

Breadcrumbs::for('category.admin.edit', function ($trail, $id) {
    $trail->parent('category.admin.index');
    $trail->push('#' . $id, route('category.admin.edit', $id));
});
Breadcrumbs::for('post.admin.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('post::post.posts'), route('post.admin.index'));
});
Breadcrumbs::for('post.admin.create', function ($trail) {
    $trail->parent('post.admin.index');
    $trail->push(trans('post::post.add_post'), route('post.admin.create'));
});

Breadcrumbs::for('post.admin.edit', function ($trail, $id) {
    $trail->parent('post.admin.index');
    $trail->push('#' . $id, route('post.admin.edit', $id));
});
