<template>
  <main class="login-form mt-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
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
                <tbody v-if="user && products.data.length > 0">
                  <!-- Table rows for products -->
                  <tr v-for="(product, index) in products.data" :key="product.id">
                    <td>{{ calculateIndex(index) }}</td>
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
                        <button  @click.prevent="deleteData(product.id)" class="btn btn-sm btn-danger rounded-pill" type="button">Delete</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="7">Total Products: {{ products.total }}</td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="7" class="text-center">No data</td>
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
    },
    async deleteData(id) {
      try {
        const { token, user } = this.getUserData();
        if (!user) {
          console.error('User not logged in');
          return;
        }
        const response = await this.deleteProduct(id, user.id, token);
        return response;
      } catch (error) {
        console.error('Error adding product:', error);
      }
    },
    getUserData() {
      const token = this.$store.getters.token;
      const user = this.$store.getters.user;
      return { token, user };
    },
    async deleteProduct(id, userId, token){
           const response = await axios.post(`http://127.0.0.1:8000/api/delete_product/${id}`, {
            ...this.product,
            user_id: userId,
          }, {
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
          this.fetchProducts();
          return response;
      }
  }
}
</script>
