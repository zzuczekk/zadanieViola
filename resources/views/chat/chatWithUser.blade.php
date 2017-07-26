@extends('master')
@section('content')
    <div id="root">
        @{{ user.name }}
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
                    usersInRoom:[],
                    conversation:null,
                    user:{{$user->id}},
                },
                methods:{
                    addMessage:function(message)
                    {
                        axios.post('/messages',{message:message,conversation:this.conversation}).then(response=>
                        {

                        }).catch(error=>{
                            console.log(error.response.data);
                        })
                    }
                },
                mounted:function(){
                    axios.post('/messages/getuser',{user:this.user}).then(response=>
                    {
                        this.user=response.data.user;
                        this.messages=response.data.conversation.messages;
                        this.conversation=response.data.conversation;
                        Echo.private(`messages.${this.conversation.id}`)
                            .listen('MessagePosted',(e)=> {
                                this.messages.push({
                                    text:e.message.text,
                                    user:e.user
                                });
                            });
                    }).catch(error=>{
                        console.log(error.respone);
                    });


                }
            });
    </script>
@endsection