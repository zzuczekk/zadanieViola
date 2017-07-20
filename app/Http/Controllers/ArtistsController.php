<?php

namespace App\Http\Controllers;

use App\Artist;
use Illuminate\Http\Request;
use Validator;

class ArtistsController extends Controller
{
    public function __construct()
    {
        //$this->middleware(\App\Http\Middleware\IsAdmin::class);
    }

    public function index()
    {
        return json_encode(Artist::get());
    }

    public function destroy(int $id)
    {
        return Artist::destroy($id);
    }
    public function show(int $id)
    {
        return json_encode(Artist::find($id));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|unique:artists',
        ],
            [
                'name.required'=>'Nazwa jest wymagana!!',
                'name.min'=>'Nazwa musi składać się przynajmniej z 3 znaków',
            ]);

        if ($validator->fails()) {
            return response()->json(($validator->errors()), 500);
        }
        else
        return json_encode(Artist::create($request->all()));
    }
}
