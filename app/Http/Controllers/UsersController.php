<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use function MongoDB\BSON\toJSON;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin')->except('show','edit','changePassword');
        $this->middleware('auth')->only('edit','edit','changePassword');
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
    public function show(int $id)
    {
        $user=User::findOrFail($id);
        $albums=$user->albums()->latest(5);
        return view('users.show',compact('user','albums'));
    }

    public function edit()
    {
        return view('users.edit');
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $user=Auth::user();
        $user->password=bcrypt($request->get('newpassword'));
        $user->save();
        Session::flash('editUserMessage','Hasło zostało zmienione!');
        return redirect('users/edit');
    }
}
