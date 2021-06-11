<?php

namespace Modules\Menu\Repositories\Interfaces;

use Core\Supports\Repositories\Interfaces\BaseInterface;

interface ItemInterface extends BaseInterface
{
   public function storeItem($request, $id);
   public function updateItem($request, $id);
   public function ajaxOrderItem($request);
}
