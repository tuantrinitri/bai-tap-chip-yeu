<?php

Breadcrumbs::for('widget.admin.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('widget::admin.widget_management'), route('widget.admin.list'));
});
