<template>
    <div class="register-page">
      <div class="register-container">
        <h2 class="text-center mb-4">Register</h2>
  
        <div v-if="errorMessage" class="alert alert-danger">
          {{ errorMessage }}
        </div>
  
        <form @submit.prevent="handleRegister">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input
              type="text"
              id="name"
              v-model="name"
              class="form-control"
              placeholder="Enter your full name"
              required
            />
          </div>
  
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
            Register <i class="fas fa-user-plus"></i>
          </button>
        </form>
  
        <div class="text-center mt-3">
          <p>
            Already have an account?
            <a href="/staff-login" class="text-primary">Login</a>
          </p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: "", 
        email: "", 
        password: "", 
        errorMessage: "", 
      };
    },
    methods: {
      async handleRegister() {
        try {
          const formData = new FormData();
          formData.append("name", this.name);
          formData.append("email", this.email);
          formData.append("password", this.password);
  
          const response = await fetch(
            "http://localhost/custom-web-application/backend/registration.php",
            {
              method: "POST",
              body: formData,
            }
          );
  
          if (!response.ok) {
            this.errorMessage = "Failed to register. Please try again.";
            return;
          }
  
          const result = await response.json();
  
          if (result.success) {
            
            this.$router.push("/staff-login");
          } else {
            
            this.errorMessage = result.message;
          }
        } catch (error) {
          console.error("Error during registration:", error);
          this.errorMessage = "An error occurred while trying to register."; 
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .register-page {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background-color: #f8f9fa;
  }
  
  .register-container {
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
  
  
