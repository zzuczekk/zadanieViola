<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumsController extends Controller
{
    public function index()
    {
        $albums=Album::latest()->get();
        return view('albums.index',compact('albums'));
    }

    public function show(int $id)
    {
        $album=Album::findOrFail($id);
        return view('albums.show',compact('album'));

    }
}
