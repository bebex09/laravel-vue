import { createStore } from 'vuex';

const store = createStore({
  state: {
    user: null,
    token: null
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
      // Save user to local storage
      localStorage.setItem('user', JSON.stringify(user));
    },
    setToken(state, token) {
      state.token = token;
      // Save token to local storage
      localStorage.setItem('token', token);
    }
  },
  actions: {
    logout({ commit }) {
      localStorage.removeItem('token');
      commit('setUser', null); // Commit the mutation directly
    },
    user({ commit }) {
      //Initialize state from local storage when Vuex store is created
      const user = JSON.parse(localStorage.getItem('user'));
      const token = localStorage.getItem('token');
      commit('setUser', user); // Commit the setUser mutation directly
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

// Initialize state from local storage when Vuex store is created
const user = JSON.parse(localStorage.getItem('user'));
const token = localStorage.getItem('token');

if (user) {
  store.commit('setUser', user); // Commit the setUser mutation directly
}

if (token) {
  store.commit('setToken', token);
}

export default store;
