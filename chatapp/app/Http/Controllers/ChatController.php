<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::all();
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'username' => $request->username,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
