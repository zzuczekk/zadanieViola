@extends('master')
@section('content')
@endsection
<div id="root">
    <div class="col-md-12">
        {!! Form::open(['astion'=>'TestController@store','class'=>'form-horizontal']) !!}
        <div class="form-group">
            <div class="col-md-4 control-label">
                {!! Form::label('name','Nazwa') !!}
            </div>
            <div class="col-md-6">
                {!! Form::text('name',null,['class'=>'form-control','v-model'=>'form.name']) !!}
                <span class="help is-danger" v-text="form.errors.get('name')"></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4 control-label">
                {!! Form::label('text','Tekst') !!}
            </div>
            <div class="col-md-6">
                {!! Form::text('text',null,['class'=>'form-control','v-model'=>'form.text']) !!}
                <span class="help is-danger" v-text="form.errors.get('text')"></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4 control-label">
                {!! Form::label('number','Numer') !!}
            </div>
            <div class="col-md-6">
                {!! Form::text('number',null,['class'=>'form-control','v-model'=>'form.number']) !!}
                <span class="help is-danger" v-text="form.errors.get('number')"></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                {!! Form::submit('Zapisz',['class'=>'btn btn-primary','v-on:click.prevent'=>'save']) !!}
            </div>
        </div>
        <a v-on:click="save" class="btn btn-primary">Zapisz</a>
        {!! Form::close() !!}
    </div>
</div>
@section('scripts')
    <script>

        new Vue(
            {
                el:"#root",
                data:{
                    form : new Form(['name','text','number']),
                },
                mounted: function ()
                {

                },
                methods:{
                    save:function(){
                        this.form.post('/api/test');
                    }
                }


            });
    </script>
@endsection