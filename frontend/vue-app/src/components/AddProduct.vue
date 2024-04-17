<template>
   <main class="login-form mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-primary text-white">Add Product</div>
            <div class="card-body">
              <form @submit.prevent="submitData">
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input type="text" v-model="formData.name" class="form-control" required autofocus placeholder="Enter Product Name">
                </div>
                <div class="form-group">
                  <label for="qty">Quantity</label>
                  <input type="number" v-model="formData.qty" class="form-control" required autofocus placeholder="Enter Quantity">
                </div>
                <div class="form-group">
                  <label for="product_name">Price</label>
                  <input type="number" v-model="formData.price" class="form-control" required autofocus placeholder="Enter Price">
                </div>
                <div class="form-group">
                  <label for="product_name">Description</label>
                  <textarea cols="30" rows="10" v-model="formData.description" class="form-control" placeholder="Enter Description"></textarea>
                </div>
                <button class="btn btn-primary btn-block mt-4">Add</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
 /* eslint-disable */ 
import axios from 'axios';

export default {
  name: 'AddProduct',
  data() {
    return {
      formData: {
        name: '',
        qty: '',
        price: 0,
        description: ''
      }
    };
  },
  methods: {
    async submitData() {
      try {
        const { token, user } = this.getUserData();
        if (!user) {
          console.error('User not logged in');
          return;
        }

        const response = await this.postProduct(user.id, token);
        console.log('Product added:', response.data);
      
        // Handle successful response
      } catch (error) {
        console.error('Error adding product:', error);
        // Handle error
      }
    },
    getUserData() {
      const token = this.$store.getters.token;
      const user = this.$store.getters.user;
      return { token, user };
    },
    async postProduct(userId, token) {
      const response = await axios.post('http://127.0.0.1:8000/api/store', {
        ...this.formData,
        user_id: userId
      }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      return response;
    }
  }
}



</script>
