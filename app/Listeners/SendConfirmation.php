<?php

namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendConfirmation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        Mail::send('email.message-confirmation', ['contact_message' => $contact_message, 'user' => $user], function($message) use ($contact_message, $user){
            $message->to($contact_message->email, $user->name);
            $message->subject('傳送訊息成功');
        });
    }
}
