<template>
   <main class="login-form mt-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
              <span>Edit Product</span>
              <router-link to="/products" class="btn-close"></router-link>
            </div>
            <div class="card-body"  >
              <form @submit.prevent="submitData" novalidate v-if="this.user">
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input type="text" v-model="product.name" class="form-control" required autofocus placeholder="Enter Product Name">
                </div>
                <div class="form-group">
                  <label for="qty">Quantity</label>
                  <input type="number" v-model="product.qty" class="form-control" required autofocus placeholder="Enter Quantity">
                </div>
                <div class="form-group">
                  <label for="product_name">Price</label>
                  <input type="number" v-model="product.price" class="form-control" required autofocus placeholder="Enter Price">
                </div>
                <div class="form-group">
                  <label for="product_name">Description</label>
                  <textarea cols="30" rows="5" v-model="product.description" class="form-control" placeholder="Enter Description"></textarea>
                </div>
                <button class="btn btn-primary btn-block mt-4">Add</button>
              </form>
              <div class="form-group" v-else>
                <label for="no data">no data</label>
              </div>
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
  name: 'EditProduct',
  data() {
    return {
      product: {
        data: [],
      },
      name: '',
      qty: '',
      price: 0,
      description: '',
      user: null,
      loading: true
    };
  },
  created(){
    this.getContentById();
  },
  methods: {
   async getContentById() {
      let url = `http://127.0.0.1:8000/api/getProduct/${this.$route.params.id}`;
      try {
        const response = await axios.get(url);
        this.product = response.data;
        this.user = this.$store.getters.user;
        console.log(this.user);

      } catch (error) {
        console.error('Error fetching product data:', error);
      } finally {
        this.loading = false; 
      }
    },
    async submitData() {
      try {
        const { token, user } = this.getUserData();
        if (!user) {
          console.error('User not logged in');
          return;
        }
        const response = await this.updateProduct(user.id, token);
        alert('Product updated!');
        this.$router.push('/products');
      } catch (error) {
        console.error('Error adding product:', error);
      }
    },
    getUserData() {
      const token = this.$store.getters.token;
      const user = this.$store.getters.user;
      return { token, user };
    },
    async updateProduct(userId, token){
      const response = await axios.post(`http://127.0.0.1:8000/api/update_product/${this.$route.params.id}`, {
        ...this.product,
        user_id: userId,
      }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      return response;
    }
  },
  mounted: function(){
      console.log('Edit Component Loaded...');
  },
}
</script>
