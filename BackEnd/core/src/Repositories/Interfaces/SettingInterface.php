<?php

namespace Core\Repositories\Interfaces;

use Core\Supports\Repositories\Interfaces\BaseInterface;

interface SettingInterface extends BaseInterface
{
    /**
     * Get Setting by name
     *
     * @param string $name
     * @return string
     */
    public function getByName(string $name): string;
}