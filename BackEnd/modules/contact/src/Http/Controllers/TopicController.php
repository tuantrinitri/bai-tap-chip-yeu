<?php

namespace Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Core\Supports\Controllers\BaseController;
use Modules\Contact\Http\Requests\TopicRequest;
use Modules\Contact\Repositories\Interfaces\TopicInterface;

class TopicController extends BaseController
{
    protected $topicRepository;

    function __construct(TopicInterface $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function getListTopic()
    {
        page_title()->setTitle(trans('contact::admin.topic_list'));
        $listtopics = $this->topicRepository->orderBy('id', 'asc')->all();
        return view('contact::admin.topic.list', compact('listtopics'));
    }

    public function getCreateTopic()
    {
        page_title()->setTitle(trans('contact::admin.topic_create'));
        $variables = config('contact::mail.variables');
        return view('contact::admin.topic.create', compact('variables'));
    }

    public function postCreateTopic(TopicRequest $request)
    {
        if ($request->mail_status == 0) {
            $this->topicRepository->topicCreate($request);
            return redirect()->route('contact.topic.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('contact::admin.create_success')]);
        } else {
            if ($request->mail_title == null && $request->mail_content == null) {
                return redirect()->route('contact.topic.admin.create')->with('flash_data', ['type' => 'error', 'message' => trans('contact::admin.title_and_content_required')])->withInput();
            } elseif ($request->mail_title == null) {
                return redirect()->route('contact.topic.admin.create')->with('flash_data', ['type' => 'error', 'message' => trans('contact::admin.title_require')])->withInput();
            } elseif ($request->mail_content == null) {
                return redirect()->route('contact.topic.admin.create')->with('flash_data', ['type' => 'error', 'message' => trans('contact::admin.content_required')])->withInput();
            } else {
                $this->topicRepository->topicCreate($request);
                return redirect()->route('contact.topic.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('contact::admin.create_success')]);
            }
        }
    }

    public function postAjaxChangeStatus(Request $request)
    {
        try {
            $this->topicRepository->update(['status' => $request->status], $request->id);
            return response()->json(['status' => true, 'msg' => trans('contact::admin.update_success')]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => trans('contact::admin.error')]);
        }
    }

    public function postAjaxChangeStatusAutoSendMail(Request $request)
    {
        try {
            if ($request->status == 0) {
                $this->topicRepository->update(['mail_status' => $request->status], $request->id);
                return response()->json(['status' => true, 'msg' => trans('contact::admin.update_success')]);
            } else {
                $data = $this->topicRepository->find($request->id);
                if ($data->mail_title == null && $data->mail_content == null) {
                    $link =  route('contact.topic.admin.edit',  $request->id);
                    return response()->json(['link' => $link, 'status' => false, 'msg' => trans('contact::admin.title_and_content_required')]);
                } elseif ($data->mail_title == null) {
                    $link =  route('contact.topic.admin.edit',  $request->id);
                    return response()->json(['link' => $link, 'status' => false, 'msg' => trans('contact::admin.title_require')]);
                } elseif ($data->mail_content == null) {
                    $link =  route('contact.topic.admin.edit',  $request->id);
                    return response()->json(['link' => $link, 'status' => false, 'msg' => trans('contact::admin.content_required')]);
                } else {
                    $this->topicRepository->update(['mail_status' => $request->status], $request->id);
                    return response()->json(['status' => true, 'msg' => trans('contact::admin.update_success')]);
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => trans('contact::admin.error')]);
        }
    }

    public function getEditTopic(int $id)
    {
        page_title()->setTitle(trans('contact::admin.topic_edit') . ' #' . $id);
        $variables = config('contact::mail.variables');
        $topic = $this->topicRepository->find($id);
        return view('contact::admin.topic.edit', compact('topic', 'variables'));
    }

    public function postEditTopic(TopicRequest $request, int $id)
    {
        if ($request->mail_status == 0) {
            $this->topicRepository->topicEdit($request, $id);
            return redirect()->route('contact.topic.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('contact::admin.update_success')]);
        } else {
            if ($request->mail_title == null && $request->mail_content == null) {
                return redirect()->route('contact.topic.admin.create')->with('flash_data', ['type' => 'error', 'message' => trans('contact::admin.title_and_content_required')])->withInput();
            } elseif ($request->mail_title == null) {
                return redirect()->route('contact.topic.admin.create')->with('flash_data', ['type' => 'error', 'message' => trans('contact::admin.title_require')])->withInput();
            } elseif ($request->mail_content == null) {
                return redirect()->route('contact.topic.admin.create')->with('flash_data', ['type' => 'error', 'message' => trans('contact::admin.content_required')])->withInput();
            } else {
                $this->topicRepository->topicEdit($request, $id);
                return redirect()->route('contact.topic.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('contact::admin.update_success')]);
            }
        }
    }

    public function getDeleteTopic(int $id)
    {
        $this->topicRepository->delete($id);
        return redirect()->route('contact.topic.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('contact::admin.delete_success')]);
    }
}
