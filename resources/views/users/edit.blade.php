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
                                    <br/>
                                    <user-details name="Nazwa:" value="{{Auth::user()->name}}"></user-details>

                                    <user-details name="Nazwa użytkownika:" value="{{Auth::user()->username}}"></user-details>

                                    <user-details name="E-mail:" value="{{Auth::user()->email}}"></user-details>

                                    <user-details name="Data utworzenia konta:" value="{{Auth::user()->created_at}}"></user-details>

                                </tab>

                                <tab name="Avatar">
                                    <div>
                                        <img id="myAvatar" name="myAvatar" src="{{Auth::user()->myavatar()}}" class="img-responsive center-block" style="padding-bottom: 10px; height: 200px"/>
                                        {!! Form::open(['action'=>'UsersController@changeAvatar','files'=>'true']) !!}
                                        <div class="text-center">
                                            {!! Form::label('avatar','Zmień avatar',['class'=>'btn btn-primary','for'=>'avatar'])!!}
                                            {!! Form::file('avatar',['id'=>'avatar','accept'=>'image/*','style'=>'display:none', 'enctype'=>'multipart/form-data', 'v-on:change'=>'onFileChange'])!!}
                                            {!! Form::submit('Zapisz',['class'=>'btn btn-primary', 'v-on:click.prevent'=>'saveAvatar'])!!}
                                        </div>
                                        <span class="help is-danger" v-text="formAvatar.errors.get('avatar')"></span>
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
                                            {!! Form::password('oldpassword',['class'=>'form-control','required'=>'required',':v-model'=>'formPassword.oldpassword']) !!}
                                            <span class="help is-danger" v-text="formPassword.errors.get('oldpassword')"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-4 control-label">
                                            {!! Form::label('newpassword','Nowe hasło',['class'=>'control-label'])!!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::password('newpassword',['class'=>'form-control','required'=>'required',':v-model'=>'formPassword.newpassword']) !!}
                                            <span class="help is-danger" v-text="formPassword.errors.get('newpassword')"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-4 control-label">
                                            {!! Form::label('newpassword-confirm','Powtórz hasło',['class'=>'control-label'])!!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::password('newpassword_confirmation',['class'=>'form-control','required'=>'required',':v-model'=>'formPassword.newpassword_confirmation']) !!}
                                            <span class="help is-danger" v-text="formPassword.errors.get('newpassword_confirmation')"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            {!! Form::submit('Zapisz',['class'=>'btn btn-primary','v-on:click.prevent'=>'changePassword'])!!}
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
            el: '#root',
            data:{
                formAvatar: new Form(['avatar']),
                formPassword: new Form(['oldpassword','newpassword','newpassword_confirmation']),

            },
            methods:
                {
                    saveAvatar:function () {

                        //formData.append('av', this.$els.fileinput.files[0]);
                        //console.log(this.formAvatar.avatar.files[0]);
                        //this.formAvatar.avatar=this.$els.avatar.files[0];
                        console.log(this.formAvatar.avatar);
                        this.formAvatar.post('/users/changeavatar');
                    },
                    changePassword: function () {
                        console.log('change');
                        this.formPassword.post('/users/changepassword')
                            .then(response => {
                                this.formPassword.onSuccess(response.data);
                                alert('Hasło zostało zmienione');
                                this.formPassword.reset();
                            }).catch(error=>{
                                this.formPassword.onFail(error);
                                this.formPassword.reset();
                                alert('dupa');
                        });

                    },
                    onFileChange(e) {
                        var files = e.target.files || e.dataTransfer.files;
                        if (!files.length)
                            return;
                        this.formAvatar.avatar=files[0];
                        //this.createImage(files[0]);
                    },
                    createImage(file) {
                        var image = new Image();
                        var reader = new FileReader();
                        var vm = this;

                        reader.onload = (e) => {
                            vm.image = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    },
                    removeImage: function (e) {
                        this.image = '';
                    }
                }
        });

    </script>
@endsection