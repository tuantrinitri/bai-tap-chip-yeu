<?php

namespace Modules\User\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\User\Models\Role;
use Modules\User\Repositories\Interfaces\RoleInterface;

class RoleRepository extends BaseRepository implements RoleInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Role::class;
    }

    public function exists(string $name): bool
    {
        return $this->findWhere([
            ['name', '=', $name]
        ])->count() !== 0;
    }

    public function allNotSuperadmin($withPermission = false): \Illuminate\Support\Collection
    {
        $roles = $this->orderBy('order', 'asc')->findWhere([
            ['name', '<>', 'superadmin']
        ]);
        if ($withPermission) {
            $rolesWithPermissions = [];
            foreach ($roles as $role) {
                foreach ($role->permissions as $permission) {
                    $rolesWithPermissions[$role['id']][] = $permission['id'];
                }
            }
            return collect($rolesWithPermissions);
        }
        return $roles;
    }

    public function updateOrder(int $id, int $order): void
    {
        $roles = $this->where([
            ['id', '!=', $id]
        ])->orderBy('order', 'asc')->get(['id']);
        $weight = 0;
        foreach ($roles as $role) {
            ++$weight;
            if ($weight == $order) {
                ++$weight;
            }
            $this->where('id', $role['id'])->update(['order' => $weight]);
        }
        $this->where('id', $id)->update(['order' => $order]);
    }
}