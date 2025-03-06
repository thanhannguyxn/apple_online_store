<template>
  <div class="container my-5">
    <h2 class="text-center mb-4" v-if="product.name">{{ product.name }}</h2>

    <div v-else class="text-center">
      <h3>No product found</h3>
      <router-link to="/product" class="btn btn-secondary"
        ><i class="fas fa-arrow-left"></i> Back</router-link
      >
    </div>

    <!-- Product Details Section -->
    <div v-if="product.name" class="row">
      <!-- Product Image -->
      <div class="col-md-6">
        <img
          :src="getImage(product.image)"
          class="img-fluid"
          :alt="product.name"
        />
      </div>

      <!-- Product Information -->
      <div class="col-md-6">
        <h4>Price: ${{ product.price }}</h4>
        <p>{{ product.details }}</p>

        <!-- Technical Details Table -->
        <table class="table table-bordered mt-4" v-if="technicalDetails">
          <thead class="table-light">
            <tr>
              <th>Specification</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(value, key) in technicalDetails" :key="key">
              <td>{{ formatKey(key) }}</td>
              <td>{{ value }}</td>
            </tr>
          </tbody>
        </table>

        <!-- Action Buttons -->
        <div class="mt-4">
          <router-link
            :to="{ name: 'CheckOut', query: { id: product.id } }"
            class="btn btn-warning me-2"
            ><i class="fas fa-shopping-cart"></i> Order Now</router-link
          >
          <router-link to="/product" class="btn btn-secondary"
            ><i class="fas fa-arrow-left"></i> Back</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import products from "../assets/products.json"; 

export default {
  data() {
    return {
      product: {},
      technicalDetails: {},
    };
  },
  methods: {
    formatKey(key) {
      const keyMappings = {
        display: "Display",
        chip: "Chip",
        camera: "Camera",
        faceid: "Face ID",
        color: "Color",
        storage: "Storage",
        battery: "Battery Life",
        os: "Operating System",
        weight: "Weight",
      };
      return keyMappings[key] || key.charAt(0).toUpperCase() + key.slice(1);
    },
    getImage(imagePath) {
      if (imagePath.startsWith("http") || imagePath.startsWith("https")) {
        return imagePath;
      }
      try {
        return require(`../assets/${imagePath}`);
      } catch (error) {
        return require("../assets/logo.png"); 
      }
    },
  },
  created() {
    const productId = parseInt(this.$route.params.id);

    if (isNaN(productId)) {
      console.error("Invalid product ID");
      return;
    }
    const product = products.find((p) => p.id === productId);

    if (product) {
      this.product = product;

      const excludedKeys = [
        "id",
        "name",
        "price",
        "image",
        "category",
        "details",
      ];
      this.technicalDetails = Object.fromEntries(
        Object.entries(product).filter(([key]) => !excludedKeys.includes(key))
      );
    } else {
      this.product = {}; 
    }
  },
};
</script>

<style scoped>
.img-fluid {
  max-width: 80%;
  height: auto;
}

.table {
  margin-top: 20px;
}

.btn {
  font-size: 16px;
  padding: 10px 20px;
}
</style>
