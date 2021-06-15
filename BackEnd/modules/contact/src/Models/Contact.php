<?php

namespace Modules\Contact\Models;

use Core\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use Filterable;
    protected $table = 'contacts';

    protected $fillable = [
        'topic',
        'title',
        'sender_name',
        'sender_phone',
        'sender_email',
        'sender_address',
        'sender_ip',
        'sender_content',
        'reply_by',
        'reply_at',
        'reply_content',
        'reply_attachments',
        'status',
    ];
    protected $filterable = [
        'topic',
        'title',
        'sender_name',
        'status',
    ];
    public function filterTopic($query, $value)
    {
        if ($value) {
            return $query->where('topic', 'like', '%' . $value . '%');
        }
    }
    public function filterTitle($query, $value)
    {
        if ($value) {
            return $query->where('title', 'like', '%' . $value . '%');
        }
    }
    public function filterSenderName($query, $value)
    {
        if ($value) {
            return $query->where('sender_name', 'like', '%' . $value . '%');
        }
    }
    public function filterStatus($query, $value)
    {
        if ($value != -1) {
            return $query->where('status', $value);
        }
    }
}
