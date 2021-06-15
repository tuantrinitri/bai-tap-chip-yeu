<?php

namespace Modules\Contact\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Modules\Contact\Repositories\Interfaces\ContactInterface;
use Socialite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    /**
     * ContactController Constructor
     *
     * @param ContactInterface $contactRepository
     */
    protected $contactRepository;
    function __construct(ContactInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getListContact(Request $request)
    {
        page_title()->setTitle(trans('contact::admin.list_contact'));
        $params = $request->all();
        $contacts = $this->contactRepository->filter($params)->orderBy('id', 'desc')->paginate(10)->appends(request()->except('page'));
        $filterdata = $params;
        return view('contact::admin.contact.list', compact('contacts', 'filterdata'));
    }

    public function postBulkAction(Request $request)
    {
        $action = $request->action;
        $ids = $request->ids;

        //
        switch ($action) {
            case 'delMulti':
                if ($ids) {
                    foreach ($ids as $id) {
                        $this->contactRepository->delete($id);
                    }
                    return redirect()->route('contact.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('contact::admin.del_item')]);
                }
                return redirect()->route('contact.admin.list')->with('flash_data', ['type' => 'warning', 'message' => trans('contact::admin.sel_item')]);
                break;

            case 'delAll':
                $this->contactRepository->delAllContact();
                return redirect()->route('contact.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('contact::admin.del_all')]);
                break;

            default:
                # code...
                break;
        }
        return redirect()->route('contact.admin.list')->with('flash_data', ['type' => 'warning', 'message' => trans('contact::admin.sel_item')]);
    }

    public function viewContact(int $id)
    {
        page_title()->setTitle(trans('contact::admin.contact') . " #" . $id);
        $contact = $this->contactRepository->find($id);
        if ($contact) {
            if ($contact->status == 1) {
                $this->contactRepository->update([
                    'reply_by' => auth()->id(),
                    'reply_at' => Carbon::now(),
                    'status' => 2
                ], $id);
            }
            return view('contact::admin.contact.view', compact('contact'));
        }
        return redirect()->route('contact.admin.list')->with('flash_data', ['type' => 'error', 'message' => trans('contact::admin.contact_not_found')]);
    }

    public function postEditContact(Request $request, int $id)
    {
        if ($request->type == 'reply') {
            $request->validate([
                'reply_content' => 'required'
            ], [
                'reply_content.required' => trans('contact::admin.reply_content_required')
            ]);
            $this->contactRepository->update([
                'reply_content' => $request->reply_content,
                'reply_at' => Carbon::now(),
                'reply_by' => auth()->id(),
                'status' => 3
            ], $id);
            $contact = $this->contactRepository->find($id);
            Mail::send('contact::mail.customer_new_reply', array('mail_title' => 'Có phản hồi liên hệ tại EMC', 'mail_content' => $contact["reply_content"]), function ($message) use ($contact) {
                $message->to($contact["sender_email"])->subject('Có phản hồi liên hệ tại EMC');
            });
            Session::flash('flash_message', 'Send message successfully!');
        } elseif ($request->type == 'cancel') {
            $request->validate([
                'cancel_content' => 'required'
            ], [
                'cancel_content.required' => trans('contact::admin.cancel_content_required')
            ]);
            // change status
            $this->contactRepository->update([
                'reply_content' => $request->cancel_content,
                'reply_at' => Carbon::now(),
                'reply_by' => auth()->id(),
                'status' => 4
            ], $id);
        }
        return redirect()->route('contact.admin.view', $id)->with('flash_data', ['type' => 'success', 'message' => trans('contact::admin.action_success')]);
    }

    public function getConfigContact()
    {
        page_title()->setTitle(trans('contact::admin.contact_config'));
        return view('contact::admin.contact.config');
    }

    public function postConfigContact(Request $request)
    {
        setting()->set('description', $request->description);
        return redirect()->route('contact.admin.config')->with('flash_data', ['type' => 'success', 'message' => trans('contact::admin.update_success')]);
    }
}
