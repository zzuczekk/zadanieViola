<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Validator;

class TestController extends Controller
{
    public function index()
    {
        $s=new Test();
        $s->name='dssed';
        $s->text='edededf';
        $s->number=4;
        $s->save();
        return view('test.index');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'text'=>'required',
            'number'=>'required|numeric',

        ]);

        if ($validator->fails()) {
            return response()->json(($validator->errors()), 500);
        }
        else
        {
            $test=Test::create($request->all());
            return response()->json($test);
        }

    }
}
