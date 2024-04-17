import { createApp } from 'vue';
import App from './App.vue';
import routes from './routes/routes';
import store from './vuex';

const app = createApp(App)

app.use(store)
app.use(routes)



app.mount('#app')