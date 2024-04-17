<template>
  <main class="login-form mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card" v-if="user && products.length > 0">
            <div class="card-header bg-primary text-white">Products</div>
            <div class="card-body">
              <p>{{ user }}</p>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.qty }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.description }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div v-else>
            <!-- Display a loading indicator or message -->
            <p>Loading...</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ProductList',
  data() {
    return {
      products: [],
      user: null
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {  
    async fetchProducts() {
      try {
        const token = this.$store.getters.token;
        const userId = this.$store.getters.user; // Assuming user has an 'id' property
        if (!token || !userId) {
          console.error('Token or user ID is missing.');
          return;
        }
        const response = await axios.get(`http://127.0.0.1:8000/api/products`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.products = response.data;
        this.user = this.$store.getters.user;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    }
  }
}
</script>