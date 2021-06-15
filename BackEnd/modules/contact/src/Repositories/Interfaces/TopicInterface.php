<?php

namespace Modules\Contact\Repositories\Interfaces;

use Core\Supports\Repositories\Interfaces\BaseInterface;
use Modules\Contact\Http\Requests\TopicRequest;

interface TopicInterface extends BaseInterface
{
    public function topicCreate(TopicRequest $request);
    public function topicEdit(TopicRequest $request, int $id);
}
