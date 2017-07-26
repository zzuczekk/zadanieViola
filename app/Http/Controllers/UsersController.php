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
        return response()->json(User::all());
    }

    public function show(int $id)
    {
        $user=User::findOrFail($id);
        $albums=$user->albums()->latest(5);
        return view('users.show',compact('user','albums'));
    }

    public function update(Request $request)
    {   $user=User::find($request->get('id'));
        $user->status=$request->get('status')===true?1:0;
        $user->save();
        return response()->json($user);
    }
    public function edit()
    {
        return view('users.edit');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'oldpassword'=>'required|chceckpassword',
            'newpassword' => 'required|string|min:6|confirmed',
        ],
            [
                'oldpassword.required'=>'Pole stare hasło jest wymagane',
                'oldpassword.chceckpassword'=>'To nie jest twoje aktualne hasło',
                'newpassword.required'=>'Pole nowe hasło jest wymagane',
                'newpassword.min'=>'Nowe hasło musi mieć minimum 6 znaków',
                'newpassword.confirmed'=>'Hasła nie są takie same'
            ]);

        if ($validator->fails()) {
            return response()->json(($validator->errors()), 500);
        }
        else {
            $user = Auth::user();
            $user->password = bcrypt($request->get('newpassword'));
            $user->save();
            return response()->json(true);
        }
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
            return response()->json(($validator->errors()), 500);
        }
        else {
            if ($request->hasFile('avatar')) {
                $user = Auth::user();
                $oldAvatar = $user->avatar;
                $user->avatar = Storage::putFile('avatars', $request->file('avatar'));
                if ($user->save()) {
                    Storage::delete($oldAvatar);
                    return response()->json(true);
                } else {
                    Storage::delete($user->avatar);
                    return response()->json(false,500);
                }
            }
        }

    }
}
