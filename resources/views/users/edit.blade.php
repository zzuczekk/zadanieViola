@extends('master')
@section('content')
    <div id="root">
        @include('errors')
        @include('messages',['name'=>'editUserMessage'])
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Ustawienia konta</div>
                        <div class="panel-body">
                            <tabs>
                                <tab name="Szczegóły" :selected="true">
                                    <img src="{{Auth::user()->myavatar()}}" class="img-responsive center-block" style="height: 200px"/>
                                    <user-details name="Nazwa:" value="{{Auth::user()->name}}"></user-details>

                                    <user-details name="Nazwa użytkownika:" value="{{Auth::user()->username}}"></user-details>

                                    <user-details name="E-mail:" value="{{Auth::user()->email}}"></user-details>

                                    <user-details name="Data utworzenia konta:" value="{{Auth::user()->created_at}}"></user-details>

                                </tab>

                                <tab name="Avatar">
                                    <div>
                                        <img id="myAvatar" name="myAvatar" src="{{Auth::user()->myavatar()}}" class="img-responsive center-block" style="height: 200px"/>
                                        {!! Form::open(['action'=>'UsersController@changeAvatar','files'=>'true']) !!}
                                        <div class="text-center">
                                            {!! Form::label('avatar','Zmień avatar',['class'=>'btn btn-primary','for'=>'avatar'])!!}
                                            {!! Form::file('avatar',['id'=>'avatar','accept'=>'image/*','style'=>'display:none', 'enctype'=>'multipart/form-data'])!!}
                                            {!! Form::submit('Zapisz',['class'=>'btn btn-primary'])!!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </tab>

                                <tab name="Zmiana hasła">
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
                                </tab>
                            </tabs>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $("input[name='avatar']").change(function () {
                var file=$(this).val();
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#myAvatar').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
        Vue.component('user-details',
            {
                template: `
                    <div class="row">
                        <div class="col-md-3 col-md-offset-4">
                            <strong>@{{name}}</strong>
                        </div>
                        <div class="col-md-5">@{{ value }}</div>
                    </div>
            `,
                props:['name','value']
            });


        new Vue({
            el: '#root'
        });

    </script>
@endsection