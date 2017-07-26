<template lang="html">
    <div class="chat-log">
        <chat-message v-for="message in messages" :key="message.id" :message="message"></chat-message>
        <div class="empty" v-if="messages.length===0">
            Brak wiadomości!!
        </div>
    </div>
</template>

<script>
    export default {
        props:['messages']
    }
</script>

<style lang="css">
    .chat-log .chat-message:nth-child(even)
    {
        background-color: #cccccc;
    }
    .empty{
        padding:1rem;
        text-align: center;
    }
</style>