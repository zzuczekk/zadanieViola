@extends('master')
@section('content')
    <h3>{{$user->name}} <a class="btn btn-primary" href="/messages/{{$user->id}}"><span class="glyphicon glyphicon-send"></span> Czat</a></h3>
    <hr/>

    <h3>Dodane albumy</h3>
    <table class="table">
        <tr>
            <th>Nazwa</th>
            <th>Artysta</th>
            <th>Premiera</th>
        </tr>
        @foreach($albums as $album)
            <tr>
                <td><a href="{{url('albums',$album->id)}}">{{$album->name}}</a></td>
                <td>{{$album->artist->name}}</td>
                <td>{{date('d-m-Y', strtotime($album->release_date))}}</td>

            </tr>
        @endforeach
    </table>
    <div class="text-center">
        {{$albums->links()}}
    </div>
@endsection
