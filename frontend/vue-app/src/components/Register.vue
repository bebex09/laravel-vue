<template>
    <main class="login-form mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-primary text-white">Sign Up</div>
            <div class="card-body">
              <div class="alert alert-danger mt-4" v-if="errors.length">
                    <ul class="mb-0">
                        <li v-for="(error, index) in errors" :key="index">
                            {{error}}
                        </li>
                    </ul>
                </div>
              <form @submit.prevent="handleSubmit" novalidate>
                <div class="form-group">
                  <label for="email_address">First Name</label>
                  <input type="text" v-model="user.first_name" class="form-control" required autofocus placeholder="Enter First Name">
                </div>

                <div class="form-group">
                  <label for="email_address">Last Name</label>
                  <input type="text" v-model="user.last_name" class="form-control" required autofocus placeholder="Enter Last Name">
                </div>

                <div class="form-group">
                  <label for="email_address">E-Mail Address</label>
                  <input type="email" v-model="user.email" class="form-control" required autofocus placeholder="Enter Email">
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" v-model="user.password" class="form-control" placeholder="Enter Password" required>
                </div>

                <div class="form-group">
                  <label for="password">Confirm Password</label>
                  <input type="password" v-model="user.c_password" class="form-control" placeholder="Confirm Password" required>
                </div>
                <button class="btn btn-primary btn-block mt-4">Register</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import axios from 'axios';
/* eslint-disable vue/multi-word-component-names */
export default {
    name: 'Register',
    data(){
        return{
            user: {},
            first_name: '',
            last_name: '',
            email: '',
            password: '',
            c_password: '',
            errors: []
        }
    },
    methods:{
        async handleSubmit(){
            this.errors = [];
            if(!this.errors.length){
              let formData = new FormData();
              formData.append('first_name', this.user.first_name);
              formData.append('last_name', this.user.last_name);
              formData.append('email', this.user.email);
              formData.append('password', this.user.password);
              formData.append('c_password', this.user.c_password);

              let url = 'http://127.0.0.1:8000/api/register';
              await axios.post(url, formData).then((response) => {
                  alert('success');
                  this.$router.push('/login');
                  console.log(response);
              }).catch(error => {
                  
                  this.errors.push(error.response.data.message);
              });
            }

        }
    }
}
</script>