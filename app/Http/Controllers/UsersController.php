<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Validator;
use function MongoDB\BSON\toJSON;

class UsersController extends Controller
{
    public function __construct()
    {
        //$this->middleware('isadmin')->except('show','edit','changePassword','changeAvatar');
        //$this->middleware('auth')->only('edit','edit','changePassword','changeAvatar');
    }

    public function index()
    {
        $users=User::all();
        return view('users.index',compact('users'));
    }
    public function userList()
    {
        return User::all();
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

    public function update(Request $request)
    {   $user=User::find($request->get('id'));
        $user->status=$request->get('status');
        return response()->json($user->save());
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
    public function changeAvatar(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'avatar' => 'required|mimes:jpeg,bmp,png'
            ],
            [
                'avatar.required'=>'Nie wybrałes zdjęcia',
                'avatar.mimes'=>'Zdęcie może być tylko typu jpeg, bmp lub png'

            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }
        else {
            if ($request->hasFile('avatar')) {
                $user = Auth::user();
                $oldAvatar = $user->avatar;
                $user->avatar = Storage::putFile('avatars', $request->file('avatar'));
                if ($user->save()) {
                    Storage::delete($oldAvatar);
                    Session::flash('editUserMessage', 'Avatar został zmieniony!');
                    return redirect('users/edit');
                } else {
                    Storage::delete($user->avatar);
                    Session::flash('editUserMessage', 'Coś poszło nie tak :(');
                    return redirect('users/edit');
                }
            }
        }

    }
}
