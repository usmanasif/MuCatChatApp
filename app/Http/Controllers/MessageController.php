<?php

namespace App\Http\Controllers;


use App\Events\NewMessageEvent;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function store(Request $request)
    {
        $data = [
            'conversation_id' => $request->conversation_id,
            'message' => $request->message,
            'receiver' => $request->receiver
        ];
        event(new NewMessageEvent(auth()->user(), $data));
        return null;
    }

}
