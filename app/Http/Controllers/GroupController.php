<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMessage;
use App\Events\GroupMessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return view('group.index', compact('groups'));
    }

    public function chat($id)
    {
        $group = Group::findOrFail($id);

        $messages = GroupMessage::where('group_id', $id)->get();

        return view('group.room', compact('group', 'messages'));
    }

    public function send(Request $request)
    {
        $message = GroupMessage::create([
            'group_id' => $request->group_id,
            'user_id' => Auth::id(),
            'message' => $request->message
        ]);

        broadcast(new GroupMessageSent($message))->toOthers();

        return back();
    }
}