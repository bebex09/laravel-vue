import { createApp } from 'vue';
import App from './App.vue';
import routes from './routes/routes';
import store from './vuex';

const app = createApp(App)

app.use(store)
app.use(routes)

const token = localStorage.getItem('token')
if (token) {
  store.commit('setToken', token)
}

const user = JSON.parse(localStorage.getItem('user'));
if (user) {
  store.commit('setUser', user)
}

app.mount('#app')