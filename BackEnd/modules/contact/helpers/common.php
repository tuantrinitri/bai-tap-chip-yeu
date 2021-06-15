<?php

use Modules\Contact\Models\ContactTopic;

function mod_contact_get_html_status($status)
{
    if ($status == 1) {
        return '<span class="badge badge-success">' . trans('contact::admin.status_new') . '</span>';
    } elseif ($status == 2) {
        return '<span class="badge badge-warning">' . trans('contact::admin.status_received') . '</span>';
    } elseif ($status == 3) {
        return '<span class="badge badge-primary">' . trans('contact::admin.status_reply') . '</span>';
    } elseif ($status == 4) {
        return '<span class="badge badge-danger">' . trans('contact::admin.status_cancel') . '</span>';
    }
    return '';
}

function mod_contact_get_content_mail($name)
{
    $contactTopic = new ContactTopic();
    return $contactTopic->where('name', $name)->first();
}
