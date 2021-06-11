<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_infos';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'department_id',
        'fullname',
        'phone',
        'photo',
        'birthday',
        'gender',
        'province_id',
        'district_id',
        'ward_id',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}