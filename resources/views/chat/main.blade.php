@extends('master')
@section('content')
    <div id="root">
        Czat ogólny  |  Ilość użytkowników: <span class="badge">@{{ usersInRoom.length }} </span>
        <chat-log :messages="messages"></chat-log>
        <chat-composer v-on:messagesent="addMessage"></chat-composer>
    </div>
@endsection

@section('scripts')
    <script>
        new Vue(
            {   el:'#root',
                mounted:function(){

                },
                data:{
                    messages:[],
                    usersInRoom:[]
                },
                methods:{
                    addMessage:function(message)
                    {
                        axios.post('/chat',message).then(response=>
                        {
                            //this.messages.push(response.data);
                        }).catch(error=>{
                            console.log(error.response.data);
                        })
                    }
                },
                mounted:function(){
                    axios.get('/chat/messages').then(response=>
                    {
                        this.messages=response.data;
                    }).catch(error=>{
                        console.log(error.respone.data);
                    });
                    Echo.join('chatroom')
                        .here((users)=>{
                            this.usersInRoom=users;
                        })
                        .joining((user)=>{
                            this.usersInRoom.push(user)
                        })
                        .leaving((user)=>{
                            this.usersInRoom=this.usersInRoom.filter(u=> u!=user)
                        })
                        .listen('ChatMessagePosted',(e)=> {
                            this.messages.push({
                                text:e.chat.text,
                                created_at:e.chat.created_at,
                                user:e.user
                            });
                        });

                }
            });
    </script>
@endsection