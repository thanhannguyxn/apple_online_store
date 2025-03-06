<template>
  <div class="staff-login-page">
    <div class="login-container">
      <h2 class="text-center mb-4">Staff Login</h2>

      <div v-if="errorMessage" class="alert alert-danger">
        {{ errorMessage }}
      </div>

      <form @submit.prevent="handleLogin">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input
            type="email"
            id="email"
            v-model="email"
            class="form-control"
            placeholder="Enter your email"
            required
          />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            id="password"
            v-model="password"
            class="form-control"
            placeholder="Enter your password"
            required
          />
        </div>

        <button type="submit" class="btn btn-primary w-100">
          Login <i class="fas fa-sign-in-alt"></i>
        </button>
      </form>

      <div class="text-center mt-3">
        <p>
          Don't have an account?
          <a href="/staff-register" class="text-primary">Sign Up</a>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "", 
      password: "", 
      errorMessage: "",
    };
  },
  methods: {
    async handleLogin() {
      try {
        const formData = new FormData();
        formData.append("email", this.email);
        formData.append("password", this.password);

        const response = await fetch(
          "http://localhost/custom-web-application/backend/login.php",
          {
            method: "POST",
            body: formData,
          }
        );

        const result = await response.json();

        if (result.success) {
          sessionStorage.setItem("userLoggedIn", "true");
          sessionStorage.setItem("userEmail", this.email);

          window.location.href = "/staff";
        } else {
          this.errorMessage = result.message; 
        }
      } catch (error) {
        console.error("Error:", error);
        this.errorMessage = "An error occurred while trying to log in."; 
      }
    },
  },
};
</script>

<style scoped>
.staff-login-page {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background-color: #f8f9fa;
}

.login-container {
  background: #fff;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
}

.alert {
  margin-bottom: 1rem;
  padding: 0.75rem;
  font-size: 0.875rem;
  background-color: #f8d7da;
  border-color: #f5c6cb;
  color: #721c24;
}

.text-center {
  text-align: center;
}

.text-primary {
  color: #007bff;
  text-decoration: none;
}

.text-primary:hover {
  text-decoration: underline;
}
</style>
