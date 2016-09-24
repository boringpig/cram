<?php

namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendConfirmation
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
//        dd($message->email);
        $this->mailer->send('email.message-confirmation', ['contact_message' => $contact_message, 'user' => $user], function($message) use ($contact_message, $user){
            $message->from('jefferyboringpig@gmail.com', '系統郵件請勿回覆');
//            $message->to($contact_message->email, $user->name);
            $message->to('aaa153759g@gmail.com', $user->name);
            $message->subject('傳送訊息成功');
        });
    }
}
