<template>
  <div class="container my-5">
    <h2 class="text-center mb-4">Our Products</h2>

    <!-- Search Bar -->
    <div class="mb-4">
      <input
        type="text"
        v-model="searchQuery"
        class="form-control"
        placeholder="Search for a product..."
      />
    </div>

    <!-- Product Cards -->
    <div class="row">
      <div
        class="col-md-3 mb-4"
        v-for="product in paginatedProducts"
        :key="product.id"
      >
        <div class="card text-center">
          <img
            :src="getImage(product.image)"
            class="card-img-top"
            :alt="product.name"
          />
          <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <p class="card-text">Price: ${{ product.price }}</p>
            <router-link
              :to="{ name: 'ProductDetails', params: { id: product.id } }"
              class="btn btn-info"
              >See details <i class="fas fa-info-circle"></i
            ></router-link>
          </div>
        </div>
      </div>
    </div>

    <!-- No Products Found -->
    <div v-if="filteredProducts.length === 0" class="text-center">
      <p>No products found.</p>
    </div>

    <!-- Pagination -->
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
</template>

<script>
import Paginate from "vuejs-paginate-next";

export default {
  components: { Paginate },
  data() {
    return {
      products: [], 
      searchQuery: "",
      currentPage: 1,
      perPage: 4,
      categoryFilter: "", 
    };
  },
  computed: {
    filteredProducts() {
      let filtered = this.products;

      if (this.categoryFilter) {
        filtered = filtered.filter(
          (product) =>
            product.category.toLowerCase() === this.categoryFilter.toLowerCase()
        );
      }

      // Search by query
      if (this.searchQuery) {
        filtered = filtered.filter((product) =>
          product.name.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }

      return filtered;
    },
    pageCount() {
      return Math.ceil(this.filteredProducts.length / this.perPage);
    },
    paginatedProducts() {
      const start = (this.currentPage - 1) * this.perPage;
      return this.filteredProducts.slice(start, start + this.perPage);
    },
  },
  methods: {
    handlePageClick(page) {
      this.currentPage = page;
    },
    getImage(imagePath) {
      if (imagePath.startsWith("http") || imagePath.startsWith("https")) {
        return imagePath;
      }
      try {
        return require(`@/assets/${imagePath}`);
      } catch (error) {
        return require("@/assets/logo.png");
      }
    },
    async loadProducts() {
      try {
        const response = await import("@/assets/products.json");
        this.products = response.default || response;
      } catch (error) {
        console.error("Error loading products", error);
      }
    },
  },
  watch: {
    "$route.params.category": function (newCategory) {
      this.categoryFilter = newCategory || "";
    },
  },
  created() {
    const categoryParam = this.$route.params.category;
    if (categoryParam) {
      this.categoryFilter = categoryParam;
    }
    this.loadProducts();
  },
};
</script>

<style scoped>
.card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: transform 0.5s, box-shadow 0.3s;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  border-bottom: 4px solid #007bff;
}

.pagination {
  margin-top: 20px;
}
</style>
