<template>
  <div class="container my-5">
    <h2 class="text-center mb-4">Checkout</h2>

    <div class="row">
      <!-- Product Image -->
      <div class="col-md-6" v-if="product.image">
        <img
          :src="getImage(product.image)"
          class="img-fluid"
          :alt="product.name"
        />
      </div>

      <!-- Product Information -->
      <div class="col-md-6">
        <h4>Name: {{ product.name }}</h4>
        <p>Color: {{ product.color }}</p>
        <p>Storage: {{ product.storage }}</p>

        <!-- Checkout Form -->
        <form @submit.prevent="submitOrder">
          <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input
              type="text"
              id="firstname"
              v-model="firstname"
              class="form-control"
              required
            />
          </div>

          <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input
              type="text"
              id="lastname"
              v-model="lastname"
              class="form-control"
              required
            />
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              id="email"
              v-model="email"
              class="form-control"
              required
            />
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input
              type="tel"
              id="phone"
              v-model="phone"
              class="form-control"
              required
            />
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea
              id="address"
              v-model="address"
              class="form-control"
              required
            ></textarea>
          </div>

          <h4>Price: ${{ product.price }}</h4>

          <button type="submit" class="btn btn-warning">
            <i class="fas fa-shopping-cart"></i> Place Order</button
          >&nbsp;
          <router-link to="/" class="btn btn-secondary"
            ><i class="fas fa-arrow-left"></i> Back to Home</router-link
          >
        </form>

        <!-- Success Message -->
        <div v-if="orderSuccess" class="alert alert-success mt-4">
          <strong>Order placed successfully!</strong>
        </div>

        <!-- Error Message -->
        <div v-if="orderError" class="alert alert-danger mt-4">
          <strong>{{ orderError }}</strong>
        </div>
      </div>
    </div>
  </div>
  <br /><br />
</template>

<script>
import products from "../assets/products.json"; // Load products data

export default {
  data() {
    return {
      product: {}, // The product selected by the user
      firstname: "",
      lastname: "",
      email: "",
      phone: "", // New phone number field
      address: "",
      orderSuccess: false,
      orderError: "",
    };
  },
  methods: {
    getImage(imagePath) {
      if (!imagePath) return require("../assets/logo.png"); // Default image if no image path is provided

      if (imagePath.startsWith("http") || imagePath.startsWith("https")) {
        return imagePath;
      }

      try {
        return require(`../assets/${imagePath}`);
      } catch (error) {
        return require("../assets/logo.png"); // Default image in case of error
      }
    },

    // Handles the order submission to the backend (PHP)
    submitOrder() {
      const orderData = {
        product: this.product,
        firstname: this.firstname,
        lastname: this.lastname,
        email: this.email,
        phone: this.phone, // Include phone number in order data
        address: this.address,
      };

      console.log("Sending order data:", orderData);

      // Send the order data via a POST request to checkout.php
      fetch("http://localhost/custom-web-application/backend/checkout.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(orderData),
      })
        .then((response) => response.json()) // Parse the response as JSON
        .then((data) => {
          console.log("Response from server:", data);
          if (data.status === "success") {
            this.orderSuccess = true;
          } else {
            this.orderError = data.message;
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          this.orderError = "An error occurred while placing the order.";
        });
    },
  },

  created() {
    // Retrieve the product ID from query parameters
    const { id } = this.$route.query;

    if (id) {
      // Find the product by ID in the products JSON
      const product = products.find((p) => p.id === parseInt(id));

      if (product) {
        this.product = product;
      } else {
        console.error("Product not found!");
        this.orderError = "Product not found.";
      }
    } else {
      console.error("No product ID found in the query parameters!");
      this.orderError = "Product ID missing.";
    }
  },
};
</script>

<style scoped>
.img-fluid {
  max-width: 80%;
  height: auto;
}

.form-label {
  font-weight: bold;
}

.btn {
  font-size: 16px;
  padding: 10px 20px;
}

.alert {
  font-size: 18px;
  font-weight: bold;
}
</style>
