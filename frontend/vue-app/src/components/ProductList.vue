<template>
  <main class="login-form mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card" v-if="user && products.data.length > 0">
            <div class="card-header bg-primary text-white">Products</div>
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th class="col-3" colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(product, index) in products.data" :key="product.id">
                    <td>{{ calculateIndex(index) }}</td> <!-- Incrementing number starting from 1 -->
                    <td>{{ product.name }}</td>
                    <td>{{ product.qty }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.description }}</td>
                    <td>
                      <div class="d-grid">
                        <router-link :to="{ name:'EditProduct', params: { id: product.id} }" class="btn btn-success rounded-pill btn btn-sm">Edit</router-link>
                      </div>
                    </td>
                    <td>  
                      <div class="d-grid">
                        <button class="btn btn-sm btn-danger rounded-pill" type="button">Delete</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="7">Total Products: {{ products.total }}</td>
                  </tr>
                </tbody>
              </table>
              <nav aria-label="Page navigation">
                <ul class="pagination">
                  <li class="page-item" :class="{ 'disabled': products.current_page === 1 }">
                    <button class="page-link" @click="prevPage" :disabled="products.current_page === 1">Previous</button>
                  </li>
                  <li class="page-item" :class="{ 'disabled': products.current_page === products.last_page }">
                    <button class="page-link" @click="nextPage" :disabled="products.current_page === products.last_page">Next</button>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div v-else>
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
      products: {
        data: [],
        total: 0,
        current_page: 1,
        last_page: 1
      },
      user: null
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {  
    async fetchProducts(page = 1) {
      try {
        const token = this.$store.getters.token;
        const userId = this.$store.getters.user; 
        if (!token || !userId) {
          console.error('Token or user ID is missing.');
          return;
        }
        const response = await axios.get(`http://127.0.0.1:8000/api/products?page=${page}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.products = response.data;
        this.user = this.$store.getters.user;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    calculateIndex(index) {
      return (this.products.current_page - 1) * this.products.per_page + index + 1;
    },
    nextPage() {
      if (this.products.current_page < this.products.last_page) {
        this.fetchProducts(this.products.current_page + 1);
      }
    },
    prevPage() {
      if (this.products.current_page > 1) {
        this.fetchProducts(this.products.current_page - 1);
      }
    }
  }
}
</script>
