<template>
  <div class="container">
    <div v-if="user" class="alert alert-secondary mt-4" bis_skin_checked="1">
      <h4 class="alert-heading">Hello!</h4>
      <p class="mb-0">You are now Logged In.</p>
      
    </div>
    <div v-if="!user" class="alert alert-danger mt-4" bis_skin_checked="1">
        You are not logged in
    </div>
  </div>
</template>

<script>
/* eslint-disable vue/multi-word-component-names */
import {mapGetters} from 'vuex'
export default {
  name: 'Dashboard',
  
  computed:{
      ...mapGetters(['user']) 
  }

  
}
</script>
