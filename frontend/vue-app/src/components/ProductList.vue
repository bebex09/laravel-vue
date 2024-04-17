<template>
  <main class="login-form mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-primary text-white">Products</div>
            <div class="card-body">
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
                    <td>{{ user }}</td>
                    <td>{{ product.qty }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.description }}</td>
                  </tr>
                </tbody>
              </table>
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
  name: 'ProductList',
  data() {
    return {
      products: []
    };
  },
  async mounted() {
    // Fetch products when the component is mounted
    await this.fetchProducts();
  },
  methods: {  
    async fetchProducts() {
      try {
        // Check if token and user data exist
        const token = this.$store.getters.token;
        const userId = this.$store.getters.user.user; // Access user ID properly

        if (!token || !userId) {
          console.error('Token or user ID is missing.');
          return;
        }

        const response = await axios.get('http://127.0.0.1:8000/api/products', {
          headers: {
            Authorization: `Bearer ${token}`
          },
          params: {
            id: userId
          }
        });
        this.products = response.data; 
      } catch (error) {
        console.error('Error fetching products:', error);
        // Handle error
      }
    }
  }
}
</script>

