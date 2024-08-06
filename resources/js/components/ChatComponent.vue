<template>
  <div class="chat-container">
    <ul class="list-group">
      <li class="list-group-item" v-for="message in messages" :key="message.id">
        <strong>{{ message.username }}</strong>: {{ message.message }}
      </li>
    </ul>
    <input v-model="newMessage" @keyup.enter="sendMessage" class="form-control" placeholder="Type a message...">
  </div>
</template>

<script>
export default {
  name: 'ChatComponent',
  data() {
    return {
      messages: [],
      newMessage: ''
    }
  },
  mounted() {
    this.fetchMessages();
    Echo.channel('chat')
      .listen('MessageSent', (e) => {
        this.messages.push(e.message);
      });
  },
  methods: {
    fetchMessages() {
      axios.get('/messages').then(response => {
        this.messages = response.data;
      });
    },
    sendMessage() {
      axios.post('/messages', {
        username: 'User',
        message: this.newMessage
      }).then(response => {
        this.newMessage = '';
      });
    }
  }
}
</script>

<style scoped>
.chat-container {
  max-width: 600px;
  margin: 0 auto;
  margin-top: 50px;
}
</style>
