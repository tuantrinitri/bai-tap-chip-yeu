<?php

namespace Modules\Contact\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Modules\Contact\Http\Requests\ContactRequest;
use Modules\Contact\Repositories\Interfaces\ContactInterface;
use Illuminate\Http\Request;
use Modules\Contact\Jobs\SendMailNewContact;
use Modules\Contact\Repositories\Interfaces\TopicInterface;

class WebController extends BaseController
{
    protected $contactRepository, $topicRepository;
    public function __construct(ContactInterface $contactRepository, TopicInterface $topicRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->topicRepository = $topicRepository;
    }

    public function getTestSendmail()
    {
        $topics = $this->topicRepository->findWhereIn('status', [1]);
        return view('contact::web.test', compact('topics'));
    }

    public function postTestSendmail(Request $request)
    {
        $contact = $this->contactRepository->create([
            'topic' => $request->topic,
            'title' => $request->title,
            'sender_name' => $request->sender_name,
            'sender_email' => $request->sender_email,
            'sender_content' => $request->sender_content,
            'sender_phone' => $request->sender_phone
        ]);
        $contacTopic = mod_contact_get_content_mail($request->topic);
        if ($contacTopic->mail_status == 1) {
            dispatch(new SendMailNewContact($contact));
        }
        return redirect()->route('contact.test_sendmail');
    }
}
