<template>
  <main class="login-form mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-primary text-white">Log In</div>
            <div class="card-body">
              <div class="alert alert-danger mt-4" v-if="errors.length">
                <ul class="mb-0">
                  <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
              </div>
              <form @submit.prevent="handleSubmit">
                <div class="form-group">
                  <label for="email_address">E-Mail Address</label>
                  <input type="email" v-model="email" class="form-control" required autofocus placeholder="Email">
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" v-model="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                  </div>
                </div>

                <button class="btn btn-primary btn-block mt-4">Login</button>
                <div class="text-center mt-3">
                  <a href="#" class="btn btn-link">Forgot Your Password?</a>
                </div>
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

export default {
  name: 'LogIn',
  data() {
    return {
      email: '',
      password: '',
      errors: []
    };
  },
  methods: {
    async handleSubmit() {
    this.errors = [];
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/login', {
        email: this.email,
        password: this.password
      });
      if (response.data && response.data.token) {
        localStorage.setItem('token', response.data.token);
        this.$store.dispatch('user',{user: response.data.user, token: response.data.token}); 
        this.$router.push('/');
      } else {
        throw new Error('Token not found in API response');
      }
    } catch (error) {
      console.error('API Request Error:', error);
      this.errors.push(error.response.data.message || 'An error occurred.');
    }
  }
  }
};
</script>

