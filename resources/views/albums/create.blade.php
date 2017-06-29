@extends('master')
@section('content')
    <div class="col-md-12">
        <h3>Dodawanie</h3>
        @include('albums.errors')
        {!! Form::open(['url'=>'albums', 'class'=>'form-horizontal']) !!}
            @include('albums.form',['buttonText'=>'Dodaj video'])
        {!! Form::close()!!}
    </div>
@endsection