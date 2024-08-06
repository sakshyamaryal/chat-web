import { createApp } from 'vue';
import App from './App.vue'; // Main App component
import ChatComponent from './components/ChatComponent.vue'; // Chat component
import Echo from 'laravel-echo';
import { io } from 'socket.io-client';

window.io = io;

const app = createApp(App);

// Register the ChatComponent globally
app.component('chat-component', ChatComponent);

app.mount('#app');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: `${window.location.hostname}:6001`, // Adjust the host as necessary
});
