<?php

namespace App\Listeners;

use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotification
{

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        //
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $contact_message = $event->message;
        $user = $contact_message->user()->first();
        $teacher = User::where('id', '=', $contact_message->teacher_id)->first();

       $this->mailer->send('email.message-notification', ['contact_message' => $contact_message, 'user' => $user], function($message) use ($contact_message, $teacher){
            $message->from('jefferyboringpig@gmail.com', '系統郵件請勿回覆');
            $message->to($teacher->email, $teacher->name);
            $message->subject('有新的訊息來自：' . $contact_message->email);
        });
    }
}
