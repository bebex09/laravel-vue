import { createApp } from 'vue'; // Import createApp from 'vue'
import App from './App.vue';
import routes from './routes/routes';
import store from './vuex';

const app = createApp(App); // Create the Vue app instance

// Use Vue Router and Vuex
app.use(routes);
app.use(store);

app.mount('#app');