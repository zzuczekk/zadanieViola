@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>{{$album->name}}</h3>
            <div>Artysta: {{$album->artist->name}}</div>
            <div>
                Kategoria:
                <ul>
                    @foreach($album->categories as $category)
                        <li>{{$category->name}}</li>
                    @endforeach
                </ul>
            </div>
            <div>Dodał: <a href="/users/{{$album->user->id}}">{{$album->user->name}}</a></div>
            <div>Premiera: {{$album->release_date}}</div>
            <p>Opis: {{$album->description}}</p>
        </div>

        <div class="col-md-4">
            <img class="img-responsive" src="/storage/{{$album->cover}}" alt="">

        </div>
    </div>
@endsection