<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Http\Requests\AlbumRequest;
use App\Album;
use App\Category;
use Session;

class AlbumsController extends Controller
{
    public function index()
    {
        $albums=Album::latest()->paginate(3);
        return view('albums.index',compact('albums'));
    }

    public function show(int $id)
    {
        $album=Album::findOrFail($id);
        return view('albums.show',compact('album'));

    }

    public function create()
    {
        $categories=Category::pluck('name','id');
        $artists=Artist::pluck('name','id');
        return view('albums.create',compact('categories','artists'));
    }

    public function store(AlbumRequest $request)
    {
        Album::create($request->all())->categories()->attach($request->input('CategoryList'));
        Session::flash('album_created','Nowy album został dodany');
        return redirect('albums');
    }
    public function edit(int $id)
    {
        $categories=Category::pluck('name','id');
        $artists=Artist::pluck('name','id');
        $album=Album::findOrFail($id);
        return view('albums.edit',compact('album','categories', 'artists'));
    }

    public function update(int $id,AlbumRequest $request)
    {
        $album=Album::findOrFail($id);
        $album->update($request->all());
        $album->categories()->sync($request->input('CategoryList'));
        return redirect('albums/'.$id);
    }

    public function destroy(int $id)
    {
        Album::destroy($id);
        return redirect('albums');
    }
}
