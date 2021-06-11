<?php

namespace Modules\User\Models;

use Core\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, Filterable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $connection = 'mysql';

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'email_verified_at',
        'forgotpasskey',
        'password',
        'display_name',
        'remember_token',
        'status'
    ];

    public function info()
    {
        return $this->hasOne(UserInfo::class, 'user_id');
    }

    public function social()
    {
        return $this->hasMany(UserSocial::class, 'user_id');
    }

    public function filterEmail($query, $value)
    {
        if ($value) {
            return $query->where('email', 'like', '%' . $value . '%');
        }
    }

    public function filterRole($query, $value)
    {
        if ($value) {
            return $query->whereHas('roles', function (Builder $query) use ($value) {
                $query->where('name', $value);
            });
        }
    }

    public function filterStatus($query, $value)
    {
        if ($value != -1) {
            return $query->where('status', $value);
        }
    }
}