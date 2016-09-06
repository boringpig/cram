<?php

namespace App\Listeners;

use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendNotification
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
        $teacher = User::where('id', '=', $contact_message->teacher_id)->first();

        Mail::send('email.message-notification', ['contact_message' => $contact_message, 'user' => $user], function($message) use ($contact_message, $teacher){
            $message->to($teacher->email, $teacher->name);
            $message->subject('有新的訊息來自：' . $contact_message->email);
        });
    }
}
