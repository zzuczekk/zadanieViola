@extends('master')
@section('content')
    <div class="col-md-12">
        <h3>{{Auth::user()->name}}</h3>
        <hr/>
        @include('errors')
        @include('messages',['name'=>'editUserMessage'])
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Zmiana hasła</div>
                        <div class="panel-body">
                            {!! Form::open(['action'=>'UsersController@changePassword','class'=>'form-horizontal']) !!}
                            <div class="form-group">
                                <div class="col-md-4 control-label">
                                    {!! Form::label('oldpassword','Stare hasło',['class'=>'control-label'])!!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::password('oldpassword',['class'=>'form-control','required'=>'required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 control-label">
                                    {!! Form::label('newpassword','Nowe hasło',['class'=>'control-label'])!!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::password('newpassword',['class'=>'form-control','required'=>'required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 control-label">
                                    {!! Form::label('newpassword-confirm','Powtórz hasło',['class'=>'control-label'])!!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::password('newpassword_confirmation',['class'=>'form-control','required'=>'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::submit('Zapisz',['class'=>'btn btn-primary'])!!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection