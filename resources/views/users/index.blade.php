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
                    <td><a :href="'/users/'+user.id" v-text="user.username"></a></td>
                    <td>@{{user.name}}</td>
                    <td>@{{user.email}}</td>
                    <td v-if="user.type==1">
                        Użytkownik
                    </td>
                    <td v-else>
                        Administrator
                    </td>
                    <td>
                        <input type="checkbox" v-model="user.status" v-on:change="chcangeStatus(user)" />
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
                            axios.put('/api/users',user)
                                .then(response=>{
                                    if(!response.data)
                                    {
                                        user.status=!user.status;
                                    }

                                })
                                .catch(error=>{
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
                        },
                        inActiveUsers: function ()
                        {
                            this.usersF=this.users.filter(function (user) {
                                if(user.status==0)
                                {
                                    return user;
                                }
                            });
                        }
                    },
                mounted: function ()
                {
                    axios.get('/api/users/')
                        .then(response=>{
                            this.users= response.data;
                            this.users.forEach(function(u) {
                                u.status == 1 ? u.status = true : u.status = false;
                            });
                            this.usersF = this.users;


                        })
                        .catch(error=>{
                            // error callback
                        });
                }


            });
    </script>
@endsection