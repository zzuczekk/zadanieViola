@extends('master')
@section('content')
    <div id='root'>
        <h3>Artyści</h3>
        <br/>
        <errors-list :errors="bledy"></errors-list>
        <div class="form-inline">
            <div class="form-group">
                <input v-on:keyup.enter="addArtist(name)" name="artis" id="artist" type="text" class="form-control" v-model="name" placeholder="Nazwa" style="width: 500px">
                <a class="btn btn-primary" v-on:click="addArtist(name)">Dodaj</a>
            </div>
        </div>
        <hr/>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Data dodania</th>
                <th>Usuń</th>
            </tr>
            <tr v-for="artist in artists">
                <td>@{{artist.id }}</td>
                <td>@{{artist.name }}</td>
                <td>@{{artist.created_at }}</td>
                <td><a class="btn btn-danger" v-on:click="deleteArtist(artist)">Usuń</a></td>
            </tr>
        </table>
    </div>

@endsection
@section('scripts')
    <script>
        new Vue({
            el: '#root',
            data:{
                artists:[],
                name:null,
                bledy:null,
            },
            methods:{
                cos: function(event){
                    alert(event);
                },
                deleteArtist: function(artist)
                {
                    if(confirm('Na pewno chcesz usunąć?'))
                    {
                        this.$http.delete('/api/artists/'+artist.id).then(response=>{
                                let idx = this.artists.indexOf(artist);
                                this.artists.splice(idx,1);

                            },response=>{
                                // error callback
                            }
                        );
                    }
                },
                addArtist: function(name)
                {
                    this.$http.post('/api/artists',{'name':name}).then(response=>{
                        this.bledy=null;
                        this.artists.push(response.body)
                        this.name=null;

                    },response=>{
                        this.bledy=response.body;
                    });
                }
            },
            mounted: function ()
            {
                this.$http.get('/api/artists').then(response=>{
                    this.artists = response.body;

                },response=>{
                    // error callback
                });
            }

        });
    </script>
@endsection