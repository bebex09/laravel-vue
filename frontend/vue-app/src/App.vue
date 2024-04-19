<template>
    <Header/>
    <router-view ></router-view>
</template>

<script>
import Header from './components/Header.vue'
import axios from 'axios';
  export default {
    name: 'App',
    components: {
      Header
    },
    async created() {
      const token = localStorage.getItem('token');
      if (!token) {
          console.log("Token not found in localStorage. User is not authenticated.");
          return;
      }
      try {
          const response = await axios.get('http://127.0.0.1:8000/api/user', {
              headers: {
                  Authorization: 'Bearer ' + token
              }
          });
          this.$store.dispatch('user', response.data);
      } catch (error) {
          if (error.response && error.response.status !== 401) {
              console.error("Error fetching user data:", error.message);
          }
      }
    }
  }
</script>
