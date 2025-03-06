<template>
  <div class="staff-page">
    <div class="container">
      <h2 class="text-center mb-4">Manage Products</h2>

      <div class="product-list">
        <h4 class="mb-3">Product List</h4>
        <div v-if="products.length === 0" class="alert alert-warning">
          No products available.
        </div>

        <ul class="list-group">
          <li
            v-for="product in paginatedProducts"
            :key="product.id"
            class="list-group-item"
          >
            <div class="d-flex justify-content-between">
              <div>
                <h5>{{ product.name }}</h5>
                <p>{{ product.category }} - {{ product.price }}$</p>
              </div>
              <div>
                <button
                  @click="editProduct(product)"
                  class="btn btn-warning btn-sm"
                >
                  Edit
                </button>
                <button
                  @click="deleteProduct(product.id)"
                  class="btn btn-danger btn-sm ml-2"
                >
                  Delete
                </button>
              </div>
            </div>
          </li>
        </ul>
        <br />

        <!-- Pagination Controls using vue-paginate-next -->
        <paginate
          v-if="pageCount > 1"
          :page-count="pageCount"
          :page-range="3"
          :margin-pages="1"
          :click-handler="handlePageClick"
          :prev-text="'Prev'"
          :next-text="'Next'"
          :container-class="'pagination justify-content-center'"
          :page-class="'page-item'"
          :page-link-class="'page-link'"
          :prev-class="'page-item'"
          :next-class="'page-item'"
          :prev-link-class="'page-link'"
          :next-link-class="'page-link'"
        />
      </div>

      <div class="text-right mb-4">
        <button @click="logout" class="btn btn-danger">Logout</button>
      </div>

      <div v-if="editingProduct" class="edit-form mt-4">
        <h4>Edit Product: {{ editingProduct.name }}</h4>
        <form @submit.prevent="saveProduct">
          <div class="form-group">
            <label for="productName">Product Name:</label>
            <input
              v-model="editingProduct.name"
              id="productName"
              type="text"
              class="form-control"
              required
            />
          </div>
          <div class="form-group">
            <label for="productCategory">Category:</label>
            <input
              v-model="editingProduct.category"
              id="productCategory"
              type="text"
              class="form-control"
              required
            />
          </div>
          <div class="form-group">
            <label for="productPrice">Price:</label>
            <input
              v-model="editingProduct.price"
              id="productPrice"
              type="number"
              class="form-control"
              required
              min="0"
            />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
            <button
              @click="cancelEdit"
              type="button"
              class="btn btn-secondary ml-2"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <br /><br />
</template>

<script>
import Paginate from "vuejs-paginate-next"; // Import vue-paginate-next
import productsData from "../assets/products.json"; 

export default {
  components: { Paginate },
  data() {
    return {
      products: [], 
      editingProduct: null, 
      currentPage: 1,
      pageSize: 5, // Number of products per page
    };
  },
  computed: {
    pageCount() {
      return Math.ceil(this.products.length / this.pageSize);
    },
    paginatedProducts() {
      const start = (this.currentPage - 1) * this.pageSize;
      return this.products.slice(start, start + this.pageSize);
    },
  },
  methods: {
    handlePageClick(page) {
      this.currentPage = page;
    },
    logout() {
      sessionStorage.removeItem("userLoggedIn");
      sessionStorage.removeItem("userEmail");
      window.location.href = "/staff-login";
    },
    editProduct(product) {
      this.editingProduct = { ...product };
    },
    cancelEdit() {
      this.editingProduct = null;
    },
    saveProduct() {
      const index = this.products.findIndex(
        (product) => product.id === this.editingProduct.id
      );
      if (index !== -1) {
        this.products.splice(index, 1, this.editingProduct);
        this.cancelEdit();
      }
    },
  },
  created() {
    this.products = productsData;

    if (!sessionStorage.getItem("userLoggedIn")) {
      window.location.href = "/staff-login";
    }
  },
};
</script>

<style scoped>
.product-list {
  margin-top: 20px;
}

.product-list .list-group-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.product-list .btn {
  margin-left: 10px;
}

.edit-form {
  margin-top: 20px;
  background-color: #f8f9fa;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.edit-form h4 {
  margin-bottom: 20px;
}

.edit-form .form-group {
  margin-bottom: 15px;
}

.edit-form input {
  margin-top: 5px;
}

.edit-form button {
  margin-right: 10px;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.pagination button {
  padding: 8px 16px;
}

.pagination .page-info {
  font-size: 16px;
  font-weight: bold;
}
</style>
