import { createStore } from 'vuex';

const store = createStore({
  state: {
    user: null,
    token: null
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
      localStorage.setItem('user', JSON.stringify(user));
    },
    setToken(state, token) {
      state.token = token;
      localStorage.setItem('token', token);
    }
  },
  actions: {
    logout({ commit }) {
      localStorage.removeItem('token');
      commit('setUser', null);
    },
    user({ commit }) {
      const user = JSON.parse(localStorage.getItem('user'));
      const token = localStorage.getItem('token');
      commit('setUser', user);
      commit('setToken', token);
    }
  },
  getters: {
    user(state) {
      return state.user;
    },
    token(state) {
      return state.token;
    }
  }
});

const user = JSON.parse(localStorage.getItem('user'));
const token = localStorage.getItem('token');

if (user) {
  store.commit('setUser', user);
}
if (token) {
  store.commit('setToken', token);
}

export default store;
