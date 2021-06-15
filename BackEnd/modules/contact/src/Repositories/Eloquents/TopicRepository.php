<?php

namespace Modules\Contact\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\Contact\Http\Requests\TopicRequest;
use Modules\Contact\Models\ContactTopic;
use Modules\Contact\Repositories\Interfaces\TopicInterface;

class TopicRepository extends BaseRepository implements TopicInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return ContactTopic::class;
    }

    public function topicCreate(TopicRequest $request)
    {
        return $this->create([
            'name' => $request->name,
            'status' => $request->status,
            'note' => $request->note,
            'mail_status' => $request->mail_status,
            'mail_title' => $request->mail_title,
            'mail_content' => $request->mail_content,
        ]);
    }

    public function topicEdit(TopicRequest $request, int $id)
    {
        return $this->update([
            'name' => $request->name,
            'status' => $request->status,
            'note' => $request->note,
            'mail_status' => $request->mail_status,
            'mail_title' => $request->mail_title,
            'mail_content' => $request->mail_content,
        ], $id);
    }
}
