import { createStore } from 'vuex';

const store = createStore({
  state: {
    user: null
  },
  getters: {
    user: state => {
      return state.user;
    }
  },
  actions: {
    setUser(context, user) { // Renamed action to 'setUser'
      context.commit('SET_USER', user); // Committing mutation 'SET_USER'
    }
  },
  mutations: {
    SET_USER(state, user) { // Mutation to set the user
      state.user = user;
    }
  }
});

export default store;
