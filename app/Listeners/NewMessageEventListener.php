<?php

namespace App\Listeners;

use App\Events\MessagePushEvent;
use App\Events\NewMessageEvent;
use App\Models\Message;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewMessageEventListener implements ShouldQueue
{
    public $data;
    public $user;

    public function __construct()
    {

    }

    public function handle(NewMessageEvent $event)
    {
        $message = Message::create([
            'conversation_id' => $event->data['conversation_id'],
            'type' => 'plain',
            'message_source' => $event->data['message'],
            'user_id' => $event->user->id
        ]);
        event(new MessagePushEvent($event->user->id, $event->data['receiver'], $message));
    }
}
