import { createApp } from 'vue';
import App from './App.vue';
import routes from './routes/routes';
import store from './vuex';

const app = createApp(App)
app.use(store)
app.use(routes)

// Retrieve token from local storage on application startup
const token = localStorage.getItem('token')
if (token) {
  store.commit('setToken', token)
}
// Retrieve user from local storage on application startup
const user = JSON.parse(localStorage.getItem('user'));
if (user) {
  store.commit('setUser', user)
}

app.mount('#app')