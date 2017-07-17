@extends('master')
@section('content')
    {!! Form::open() !!}
    {!! Form::close()!!}</td>
    <table class="table">
        <tr>
            <th>Nazwa użytkownika</th>
            <th>Nazwa</th>
            <th>Email</th>
            <th>Typ</th>
            <th>Status</th>
            <th>Data utworzenia</th>
            <th>Edytuj</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if($user->type==1)
                        Użytkownik
                    @elseif($user->type==2)
                        Administrator
                    @endif
                </td>
                <td>
                    {!! Form::checkbox('status',$user->id, $user->status, ['class'=>'statusChB']) !!}
                </td>
                <td>{{$user->created_at}}</td>
                <td><a class="btn btn-danger" href="{{url('users/edit')}}">Edytuj</a></td>
            </tr>
        @endforeach
    </table>
@endsection

@section('scripts')
    <script>

        $(function() {


            $(":checkbox[name='valide']").change(function() {
                var cases = $(":checkbox[name='valide'][value='" + this.value + "']");
                cases.prop('checked', this.checked);
                cases.parents('.panel-heading').toggleClass('border-red');
                cases.hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
                var token = $('input[name="_token"]').val();
                alert('{!! url('uservalid') !!}' + '/' + this.value+ "     "+token);
                $.ajax({
                    url: '{!! url('uservalid') !!}' + '/' + this.value,
                    type: 'PUT',
                    data: "valid=" + this.checked + "&_token=" + token
                })
                    .done(function() {
                        $('.fa-spin').remove();
                        $('input[type="checkbox"]:hidden').show();
                    })
                    .fail(function() {
                        $('.fa-spin').remove();
                        var cases = $('input[type="checkbox"]:hidden');
                        cases.parents('.panel-heading').toggleClass('border-red');
                        cases.show().prop('checked', cases.is(':checked') ? null:'checked');
                        alert('{{ trans('back/comments.fail') }}');
                    });
            });
            $(".statusChB").change(function () {
                var input=this;
                var token = $("input[name='_token']").val();

                var user=$(this).val();
                $.ajax({
                    url: '{!! url('users/changestatus') !!}',
                    type: 'POST',
                    dataType: 'json',
                    data: {status:this.checked,_token:token, user_id:user},
                    //dataType:'json'
                })
                    .done(function (response) {
                        if(response==false)
                        {
                            input.checked=!input.checked;
                            alert('Coś poszło nie tak');
                        }
                    })
                    .fail(function(){
                        input.checked=!input.checked;
                        alert('Coś poszło nie tak');
                    })
            });
        });



    </script>
@endsection