@extends('master')
@section('content')
    <div id="root">
        {!! Form::open() !!}
        {!! Form::close()!!}
        <ul class="nav nav-tabs">
            <li class="active" v-on:click="allUsers"><a data-toggle="tab">Wszyscy</a></li>
            <li v-on:click="activeUsers"><a data-toggle="tab">Aktywni</a></li>
            <li v-on:click="inActiveUsers"><a data-toggle="tab">Nieaktywni</a></li>
        </ul>

        <div class="tab-content">
            <table class="table">
                <tr>
                    <th>Nazwa użytkownika</th>
                    <th>Nazwa</th>
                    <th>Email</th>
                    <th>Typ</th>
                    <th>Status</th>
                    <th>Data utworzenia</th>
                </tr>
                <tr v-for="user in usersF">
                    <td><a href="users/@{{ user.id }}">@{{user.username}}</a></td>
                    <td>@{{user.name}}</td>
                    <td>@{{user.email}}</td>
                    <td v-if="user.type==1">
                        Użytkownik
                    </td>
                    <td v-else>
                            Administrator
                    </td>
                    <td>
                        <input v-model="user.status" v-on:change="chcangeStatus(user)" type="checkbox">
                    </td>
                    <td>@{{user.created_at}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        new Vue(
        {
            el:"#root",
            data:{
                usersF:null,
                users:null,
            },
            methods:
                {
                    chcangeStatus: function (user) {
                        this.$http.put('/api/users',user).then(response=>{
                            if(!response.body)
                        {
                            user.status=!user.status;
                        }

                    },response=>{
                            user.status=!user.status;
                        });
                    },
                    allUsers: function ()
                    {   this.usersF=this.users;
                    },
                    activeUsers: function ()
                    {
                        this.usersF=this.users.filter(function (user) {
                            if(user.status==1)
                            {
                                return user;
                            }
                        });
                        console.log(this.usersF);
                    },
                    inActiveUsers: function ()
                    {
                        this.usersF=this.users.filter(function (user) {
                            if(user.status==0)
                            {
                                return user;
                            }
                        });
                        console.log(this.usersF);
                    }
                },
            mounted: function ()
            {
                this.$http.get('/api/users/').then(response=>{
                    this.usersF = response.body;
                    this.users= response.body;
                console.log(this.usersF);

            },response=>{
                // error callback
            });
            }


        });
    </script>
@endsection