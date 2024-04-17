import { createStore } from 'vuex';

const store = createStore({
  state: {
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('token') || null
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
      localStorage.setItem('user', JSON.stringify(user)); // Store user data in local storage
    },
    setToken(state, token) {
      state.token = token;
      localStorage.setItem('token', token);
    }
  },
  actions: {
     // Define the 'user' action here if needed
    user(context, user) {
    context.commit('setUser', user);
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

export default store;
