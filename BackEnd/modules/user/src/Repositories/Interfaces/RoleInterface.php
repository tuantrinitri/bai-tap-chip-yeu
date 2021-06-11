<?php

namespace Modules\User\Repositories\Interfaces;

use Core\Supports\Repositories\Interfaces\BaseInterface;
use Illuminate\Support\Collection;

interface RoleInterface extends BaseInterface
{
    /**
     * Check if exists a role in DB
     *
     * @param string $name
     * @return boolean
     */
    public function exists(string $name): bool;

    /**
     * Get list roles not superadmin
     *
     * @param boolean $withPermission
     * @return Collection
     */
    public function allNotSuperadmin($withPermission = false): Collection;

    /**
     * Update order role
     *
     * @param integer $id
     * @param integer $order
     * @return void
     */
    public function updateOrder(int $id, int $order): void;
}