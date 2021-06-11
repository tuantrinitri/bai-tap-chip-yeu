<?php

namespace Modules\Post\Repositories\Interfaces;

use Core\Supports\Repositories\Interfaces\BaseInterface;
use Illuminate\Http\Request;
use Modules\Post\Http\Requests\PostRequest;

interface PostInterface extends BaseInterface
{
   public function index($request);
   public function store($request);
   public function updatePost($request,  $id);
}
