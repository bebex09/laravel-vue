<template>
  <div class="container">
    <h1 v-if="user" class="header">
        Hi, {{user.first_name}} {{user.last_name}}
    </h1>
    <h1 v-if="!user">
        You are not logged in
    </h1>
  </div>
</template>

<script>

/* eslint-disable vue/multi-word-component-names */
export default {
  name: 'Dashboard',
  props:['user']
}
</script>
