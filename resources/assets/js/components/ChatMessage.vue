<template lang="html">
    <div class="chat-message row">
        <div class="col-md-1">
            <img class="avatar" src="/storage/avatars/default-avatar.png" v-if="message.user.avatar==null"/>
            <img class="avatar" :src="'/storage/'+message.user.avatar" v-else />
        </div>
        <div class="col-md-11">
            <p>{{ message.text }}</p>
            <small>{{ message.user.name }}</small><small class="pull-right">{{momentTime(message.created_at)}}</small>
        </div>
    </div>
</template>

<script>
    var moment = require('moment');
    moment.locale('pl');
    export default {
        props: ['message'],
        methods:{
            momentTime:function(date)
            {
                var a = moment(date, 'YYYY-MM-DD HH:mm:ss').format();
                if(moment().diff(a ,'minutes')<15)
                {
                    return moment(a).startOf('minutes').fromNow();
                }
                else
                {
                    return date;
                }
            }
        }
    }
</script>

<style lang="css">
    .chat-message {
        padding: 1rem;
    }
    .chat-message > p {
        margin-bottom: .5rem;
    }
    .avatar{
        height: 40px;
        vertical-align: middle
    }
</style>