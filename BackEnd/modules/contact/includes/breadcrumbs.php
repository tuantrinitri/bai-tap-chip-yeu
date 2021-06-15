<?php

Breadcrumbs::for('contact.admin.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('contact::admin.list_contact'), route('contact.admin.list'));
});

Breadcrumbs::for('contact.topic.admin.list', function ($trail) {
    $trail->parent('contact.admin.list');
    $trail->push(trans('contact::admin.topic_list'), route('contact.topic.admin.list'));
});

Breadcrumbs::for('contact.admin.view', function ($trail, $id) {
    $trail->parent('contact.admin.list');
    $trail->push(trans('contact::admin.contact') . " #" . $id, route('contact.admin.view', $id));
});

Breadcrumbs::for('contact.admin.config', function ($trail) {
    $trail->parent('contact.admin.list');
    $trail->push(trans('contact::admin.contact_config'), route('contact.admin.config'));
});

Breadcrumbs::for('contact.topic.admin.create', function ($trail) {
    $trail->parent('contact.topic.admin.list');
    $trail->push(trans('contact::admin.topic_create'), route('contact.topic.admin.create'));
});

Breadcrumbs::for('contact.topic.admin.edit', function ($trail, $id) {
    $trail->parent('contact.topic.admin.list');
    $trail->push(trans('contact::admin.topic_edit') . " #" . $id, route('contact.topic.admin.edit', $id));
});
