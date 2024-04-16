<template>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <router-link class="navbar-brand" to="/">Vue.js+Laravel API</router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
            <router-link class="nav-link" to="/contacts" v-if="user">Contact List
                <span class="visually-hidden">(current)</span>
            </router-link>
            </li>
            <li class="nav-item" v-if="user">
            <router-link class="nav-link" to="add">Add Contact</router-link>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto" v-if="!user">
            <li class="nav-item">
                <router-link to="login" class="nav-link">Log in</router-link>
            </li>
            <li class="nav-item">
                <router-link to="register" class="nav-link">Sign Up</router-link>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto" v-if="user">
            <p class="navbar-text">Hi, {{user.first_name}} {{user.last_name}} </p>
            <li class="nav-item">
                <a href="javascript:void(0)" @click="handleClick" class="nav-link">Log out</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
</template>

<script>
    import {mapGetters} from 'vuex'
    /* eslint-disable vue/multi-word-component-names */
    export default{
        name: 'Header',
        methods:{
            handleClick(){
                localStorage.removeItem('token');
                this.$store.dispatch('user',null);
                this.$router.push('/');
            }
        },
        computed:{
            ...mapGetters(['user'])
        }
    }
</script>