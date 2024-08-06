<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return Message::with('user')->get();
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'body' => 'required|string',
        ]);

        // Get the authenticated user
        $user = $request->user();

        // Define the static or fallback user ID
        $fallbackUserId = 2; // Make sure this user exists in your database

        // If no authenticated user is found, use the fallback user
        if (!$user) {
            $user = User::find($fallbackUserId);

            // Optional: Handle the case where the fallback user does not exist
            if (!$user) {
                return response()->json(['error' => 'Fallback user not found'], 500);
            }
        }

        // Create a new message associated with the user
        $message = $user->messages()->create([
            'body' => $request->input('body'),
        ]);

        // Optionally, broadcast the message event
        broadcast(new MessageSent($message))->toOthers();

        // Return the created message
        return response()->json($message, 201);
    }

    

}
