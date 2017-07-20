@extends('master')
@section('content')
    <h2>Albumy</h2>
    @include('messages',['name'=>'album_created'])
    <table class="table">
        <tr>
            <th>Nazwa</th>
            <th>Artysta</th>
            <th>Premiera</th>
            <th>Edycja</th>
            <th>Usuń</th>
        </tr>
        @if(count($albums)>0)
        @foreach($albums as $album)
            <tr>
                <td><a href="{{url('albums',$album->id)}}">{{$album->name}}</a></td>
                <td>{{$album->artist->name}}</td>
                <td>{{date('d-m-Y', strtotime($album->release_date))}}</td>
                <td><a href="{{action('AlbumsController@edit',$album->id)}}" class="btn btn-success">Edycja</a></td>
                <td>
                    {{ Form::open(['method' => 'DELETE', 'route' => ['albums.destroy', $album->id]]) }}
                        {{ Form::submit('Usuń', ['class' => 'btn btn-danger', 'onclick'=>'return confirm(\'Czy na pewno usunąć?\')']) }}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        @endif
    </table>
    <div class="text-center">
        {{$albums->links()}}
    </div>
@endsection