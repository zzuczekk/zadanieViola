<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Events\MessagePosted;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{
    public function index(int $id)
    {
        $user=User::findOrFail($id);
        return view('chat.chatWithUser',compact('user'));
    }

    public function getUser(Request $request)
    {
        $idRecipent=$request->get('user');
        $idUser=Auth::user()['id'];
        $conversation=Conversation::where([['user1','=',$idRecipent],['user2','=',$idUser ]])
            ->orWhere([['user2','=',$idRecipent],['user1','=',$idUser]] )
            ->with(['user1','user2','Messages','Messages.user'])->first();
        if($conversation===null)
        {
            $conversation=new Conversation();
            $conversation->user1=$idRecipent;
            $conversation->user2=$idUser;
            $conversation->save();
            $conversation->messages=[];

        }
        return  response()->json(['user'=>User::find($idRecipent),'conversation'=>$conversation]);

    }
    public function sendMessage(Request $request)
    {
        $idConversation=$request->get('conversation')['id'];
        $message=new Message();
        $message->conversation_id=$idConversation;
        $message->text=$request->get('message')['text'];
        $message->user_id=Auth::user()['id'];
        if($message->save())
        {
            $message->user=Auth::user();
            event(new MessagePosted($idConversation,$message,Auth::user()));
            return response()->json($message);
        }
        else
        {
            return response()->json('error',500);
        }
    }
}
