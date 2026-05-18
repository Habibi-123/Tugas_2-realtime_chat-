<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
         Auth::user()->update([
            'last_seen' => now()
        ]);

        $users = User::where('id', '!=', Auth::id())->get();

        return view('chat.index', compact('users'));
    }

    public function chat($id)
    {
        $user = User::findOrFail($id);

        $messages = Message::where(function ($query) use ($id) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $id);
        })
        ->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                  ->where('receiver_id', Auth::id());
        })
        ->get();

        return view('chat.room', compact('user', 'messages'));
    }

    public function send(Request $request)
    {
        $message = Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return back();
    }
}