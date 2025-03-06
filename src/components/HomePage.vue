<template>
  <div id="app">
    <div class="bg-light py-5 text-center">
      <div class="container">
        <h1 class="display-4">Welcome to Apple Store Online</h1>
        <p class="lead">Explore our latest Apple products!</p>
        <router-link class="btn btn-primary btn-lg" to="/product"
          >Shop Now</router-link
        >
      </div>
    </div>

    <!-- About Apple Section -->
    <div class="container my-5">
      <div class="row align-items-center">
        <div class="col-md-6 mb-4">
          <img
            src="../assets/apple.jpg"
            alt="About Apple"
            class="img-fluid rounded shadow"
          />
        </div>
        <div class="col-md-6">
          <h2>About Apple Inc.</h2>
          <p>
            Apple Inc. is a technology company that has revolutionized the way
            we live, work, and play. Founded in 1976 by Steve Jobs, Steve
            Wozniak, and Ronald Wayne, Apple is renowned for its cutting-edge
            designs, innovative products, and unparalleled ecosystem.
          </p>
          <p>
            From the iconic iPhone and iPad to the powerful MacBook and
            revolutionary Apple Watch, Apple continues to shape the future of
            technology. Whether you're a creative professional, tech enthusiast,
            or everyday user, Apple products are designed to enhance your life.
          </p>
          <a
            class="btn btn-outline-primary"
            href="https://en.wikipedia.org/wiki/Apple_Inc."
            target="_blank"
            >Learn More</a
          >
        </div>
      </div>
    </div>

    <!-- Product Section -->
    <div class="container my-4">
      <h2 class="text-center mb-4">Our Featured Products</h2>
      <div class="row">
        <div
          class="col-md-4 mb-4"
          v-for="category in categories"
          :key="category.name"
        >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <img
                  :src="category.image"
                  class="card-img-top"
                  :alt="category.name"
                />
                <div class="card-body">
                  <h5 class="card-title text-center">{{ category.name }}</h5>
                  <br />
                  <router-link
                    class="btn btn-outline-primary d-block mx-auto"
                    :to="{
                      name: 'ProductByCategory',
                      params: { category: category.name },
                    }"
                    >See more <i class="fas fa-arrow-right"></i
                  ></router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import iphoneImage from "../assets/iphone.jpg";
import ipadImage from "../assets/ipad.jpg";
import macbookImage from "../assets/macbook.jpeg";
export default {
  data() {
    return {
      categories: [
        { name: "iPhone", image: iphoneImage },
        { name: "iPad", image: ipadImage },
        { name: "MacBook", image: macbookImage },
      ],
    };
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

.card-body {
  text-align: center;
}

.card-img-top {
  width: 100%;
  height: auto;
}

.btn {
  margin: 10px auto;
}
</style>
