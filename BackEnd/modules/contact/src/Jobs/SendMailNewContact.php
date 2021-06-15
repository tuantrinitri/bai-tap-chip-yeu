<?php

namespace Modules\Contact\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendMailNewContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $key_replace = [
            '/{id}/',
            '/{topic}/',
            '/{fullname}/',
            '/{email}/',
            '/{phone}/',
            '/{title}/',
            '/{content}/',
            '/{created_at}/',
            '/{link_callback}/'
        ];
        $value_replace = [
            $this->contact['id'],
            $this->contact['topic'],
            $this->contact['sender_name'],
            $this->contact['sender_email'],
            $this->contact['sender_phone'],
            $this->contact['title'],
            $this->contact['sender_content'],
            date('H:i:s d/m/Y', strtotime($this->contact['created_at'])),
            route('contact.admin.view', $this->contact['id'])
        ];
        $contactTopic = mod_contact_get_content_mail($this->contact['topic']);
        $content = $contactTopic->mail_content;
        $mail_content = preg_replace($key_replace, $value_replace, $content);
        $mail_title = $this->contact['title'];
        $sender_email = $this->contact['sender_email'];
        Mail::send('contact::mail.customer_new_reply', array('mail_title' => $mail_title, 'mail_content' => $mail_content), function ($message) use ($sender_email, $contactTopic) {
            $message->to($sender_email)->subject($contactTopic->mail_title);
        });
    }
}
