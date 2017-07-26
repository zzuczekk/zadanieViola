<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\ChatMessagePosted;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        return view('chat.main');
    }

    public function messages()
    {
        return response()->json(Chat::with('user')->get());
    }
    public function store(Request $request)
    {
        $message=new Chat();
        $message->text=$request->get('text');
        $message->user_id=Auth::user()['id'];
        if($message->save())
        {
            $message->user->name=Auth::user()['name'];
            event(new ChatMessagePosted($message, Auth::user()));
            return response()->json($message);
        }
        else
        {
            return response()->json('error',500);
        }
    }
}
