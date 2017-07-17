<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');
    }

    public function index()
    {
        $users=User::all();
        return view('users.index',compact('users'));
    }

    public function changeStatus(Request $request)
    {
        $user=User::findOrFail($request->get('user_id'));
        if($request->get('status')==="true")
        {
            $user->status=1;
        }elseif($request->get('status')==="false")
        {
            $user->status=0;
        }
        return json_encode($user->save());

    }
}
