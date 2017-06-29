@extends('master')
@section('content')
    <h2>Albumy</h2>
    <table class="table">
        <tr>
            <th>Nazwa</th>
            <th>Artysta</th>
            <th>Premiera</th>
            <th>Edycja</th>
            <th>Usuń</th>
        </tr>
        @foreach($albums as $album)
            <tr>
                <td><a href="{{url('albums',$album->id)}}">{{$album->name}}</td>
                <td>{{$album->artist->name}}</td>
                <td>{{$album->release_date}}</td>,
                <td><a class="btn btn-success">Edycja</a></td>
                <td><a class="btn btn-danger">usuń</a></td>
            </tr>
        @endforeach
    </table>
@endsection