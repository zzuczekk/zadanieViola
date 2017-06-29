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
        $albums=Album::latest()->paginate(2);
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
        $album=new Album($request->all());
        $album->save();
        $categoryIds=$request->input('CategoryList');
        $album->categories()->attach($categoryIds);
        Session::flash('video_created','Twój film album dodany');
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
        $categoryIds=$request->input('CategoryList');
        $album->categories()->sync($categoryIds);
        return redirect('albums/'.$id);
    }

    public function destroy(int $id)
    {
        Album::findOrFail($id)->delete();
        return redirect('albums');
    }
}
