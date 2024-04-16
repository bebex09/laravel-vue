import { createStore } from 'vuex';

const store = createStore({
  state: {
    user: null,
    token: localStorage.getItem('token') || null
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
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
    console.log(user)
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
