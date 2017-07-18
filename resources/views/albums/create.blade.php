@extends('master')
@section('content')
    <div class="col-md-12">
        <h3>Dodawanie</h3>
        @include('errors')
        {!! Form::open(['url'=>'albums', 'class'=>'form-horizontal','files'=>'true']) !!}
            @include('albums.form',['buttonText'=>'Dodaj album'])
        {!! Form::close()!!}
    </div>
@endsection