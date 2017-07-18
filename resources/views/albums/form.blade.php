<div class="form-group">
    <div class="col-md-4 control-label">{!! Form::label('artist','Artysta')!!}</div>
    <div class="col-md-6">
        {!! Form::select('artist_id',$artists,null,['class'=>'form-control'])!!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-4 control-label">{!! Form::label('name','Tytuł')!!}</div>
    <div class="col-md-6">
        {!! Form::text('name',null,['class'=>'form-control'])!!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 control-label">{!! Form::label('release_date','Data premiery')!!}</div>
    <div class="col-md-6">
        {!! Form::date('release_date',null,['class'=>'form-control'])!!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 control-label">{!! Form::label('description','Opis')!!}</div>
    <div class="col-md-6">
        {!! Form::textarea('description',null,['class'=>'form-control'])!!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 control-label">{!! Form::label('coverLabel','Okładka')!!}</div>
    <div class="col-md-6">
        {!! Form::label('cover','Wybierz plik',['class'=>'btn btn-primary','for'=>'cover'])!!}
        {!! Form::file('cover',['id'=>'cover','accept'=>'image/*','style'=>'display:none', 'enctype'=>'multipart/form-data'])!!}
        {!! Form::label('fileName','Wybierz plik',['id'=>'fileName'])!!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-4 control-label">{!! Form::label('CategoryList','Kategorie')!!}</div>
    <div class="col-md-6">
        {!! Form::select('CategoryList[]',$categories,null,['class'=>'form-control','multiple'])!!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit($buttonText,['class'=>'btn btn-primary'])!!}
    </div>
</div>

@section('scripts')
    <script>
        $(function() {
            $("input[name='cover").change(function () {
                var file=$(this).val();
                file=file.replace(/^.*[\\\/]/, '');
                $("#fileName").html(file);
            });
        });
    </script>
@endsection