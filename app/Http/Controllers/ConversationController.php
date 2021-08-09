<?php

namespace App\Http\Controllers;

use App\Models\Conversations;
use App\Models\User;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $all_users = User::where('id', '!=', $user->id)->get();
        return view('conversation.index', [
            'sender' => $user->id,
            'all_users' => $all_users,
        ]);
    }

    public function show($receiver)
    {
        $sender = auth()->user()->id;
        $array = [$sender, $receiver];
        sort($array);
        $salt = base64_encode(implode(',', $array));
        $conversation = Conversations::where('conversation_salt', $salt)->first();
        if (!$conversation) {
            $conversation = Conversations::create([
                'sender_id' => $sender,
                'receiver_id' => $receiver,
                'conversation_salt'=> $salt
            ]);
        }
        $messages = auth()->user()->all_messages($conversation->id);
        $all_users = User::where('id', '!=', $sender)->get();
        $receiver_obj = User::find($receiver);

        return view('conversation.show', [
            'conversation' => $conversation,
            'messages' => $messages,
            'receiver' => $receiver,
            'all_users' => $all_users,
            'sender' => $sender,
            'receiver_obj' => $receiver_obj
        ]);
    }

    public function store(Request $request)
    {
        $receiver = $request->receiver_id;
        $sender = $request->sender_id;
        $array = [$sender, $receiver];
        sort($array);
        $salt = base64_encode(implode(',', $array));
        $conversation = Conversations::create([
            'sender_id' => $sender,
            'receiver' => $receiver,
            'conversation_salt' => $salt
        ]);
        return redirect()->route('con_show', $conversation);
    }

//    private function redirect_and_create($request, $sender) {
//        $data = [
//            'sender_id' => $sender->id,
//            'receiver_id' => $request->receiver_id ??
//
//        ];
//        return redirect()->route('con_store')->with($data);
//
//    }
}
