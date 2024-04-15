<template>
    <Header title="Vue.js+Laravel API" />
    <router-view ></router-view>
</template>

<script>
import axios from 'axios';
import Header from './components/Header.vue'
  export default {
    name: 'App',
    components: {
      Header
    },
    data(){
      return{
          user: null,

      }
    },
    async created() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/user',{
          headers:{
              Authorization: 'Bearer ' + localStorage.getItem('token')
          }
        });
        
        this.store.dispatch('user', response.data);

      } catch (error) {
        console.log(error.response.data.message)
      }
    }
  }
</script>
