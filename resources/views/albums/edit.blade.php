@extends('master')
@section('content')
    <div class="col-md-12">
        <h3>Edycja</h3>
        @include('albums.errors')
        {!! Form::model($album, ['method'=>'PATCH','class'=>'form-horizontal', 'action'=>['AlbumsController@update',$album->id]]) !!}
        @include('albums.form',['buttonText'=>'Zapisz zmiany'])
        {!! Form::close()!!}
    </div>
@endsection