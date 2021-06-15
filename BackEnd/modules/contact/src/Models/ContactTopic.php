<?php

namespace Modules\Contact\Models;

use Illuminate\Database\Eloquent\Model;

class ContactTopic extends Model
{
    protected $table = 'contact_topics';

    protected $fillable = [
        'name',
        'status',
        'note',
        'mail_title',
        'mail_content',
        'mail_status'
    ];
}
