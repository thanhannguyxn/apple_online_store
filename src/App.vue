<template>
  <div id="app">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <!-- Logo -->
        <router-link class="navbar-brand fw-bold" to="/"
          ><i class="fab fa-apple apple-icon"></i
        ></router-link>

        <!-- Toggler Button for Mobile View -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <!-- Centered Nav Items -->
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <router-link
                class="nav-link fw-bold"
                :class="{ active: isActive('/') }"
                to="/"
                >Home</router-link
              >
            </li>
            <li class="nav-item">
              <router-link
                class="nav-link fw-bold"
                :class="{ active: isActiveProductPage() }"
                to="/product"
                >Products</router-link
              >
            </li>
            <li class="nav-item">
              <router-link
                class="nav-link fw-bold"
                :class="{ active: isActive('/contact') }"
                to="/contact"
                >Contact</router-link
              >
            </li>
            <li class="nav-item">
              <router-link
                class="nav-link fw-bold text-danger"
                id="staff-nav"
                :class="{ active: isActive('/staff-login') }"
                to="/staff-login"
                ><i class="fas fa-user-circle me-1"></i> Staff
                Login</router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1">
      <router-view></router-view>
    </main>

    <!-- Footer -->
    <footer class="text-white py-3">
      <div class="container text-center">
        <p>&copy; 2024 Apple Inc. All rights reserved.</p>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: "App",
  methods: {
    isActive(route) {
      return this.$route.path === route;
    },
    isActiveProductPage() {
      return this.$route.path.startsWith("/product");
    },
  },
};
</script>

<style scoped>
/* General Layout */
body,
html {
  margin: 0;
  padding: 0;
  height: 100%;
}

#app {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

main {
  flex-grow: 1;
}

/* Navbar Styling */
.navbar {
  padding: 1rem 2rem;
}

.navbar-brand {
  font-size: 30px;
  color: black;
}

.navbar-nav {
  display: flex;
  align-items: center;
}

.navbar-nav .nav-item {
  margin: 0 10px;
}

.nav-link {
  font-size: 1rem;
  color: #000000;
  transition: all 0.3s;
}

.nav-link.active {
  color: #fff !important;
  background-color: #007bff;
  border-radius: 0.5rem;
  padding: 0.5rem 1rem;
}

.nav-link:hover {
  color: #007bff;
  background-color: #f8f9fa;
  border-radius: 0.5rem;
}

#staff-nav.active {
  color: #ff0000 !important;
  background-color: #f8f9fa;
}

.navbar-nav .text-danger {
  color: #ff5733 !important;
}

.navbar-nav {
  justify-content: right;
}

/* Footer Styling */
footer {
  background-color: #000;
  color: #fff;
  text-align: center;
  padding: 1rem 0;
}
</style>
