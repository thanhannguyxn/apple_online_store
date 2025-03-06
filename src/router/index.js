import { createRouter, createWebHistory } from "vue-router";
import ProductPage from "../components/ProductPage.vue"; 
import HomePage from "../components/HomePage.vue";
import ProductDetailsPage from "../components/ProductDetailsPage.vue";
import CheckOutPage from "../components/CheckOutPage.vue";
import StaffLoginPage from "../components/StaffLoginPage.vue";
import ContactPage from "../components/ContactPage.vue";
import StaffPage from "../components/StaffPage.vue";
import StaffRegistrationPage from "../components/StaffRegistrationPage.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: HomePage,
  },
  {
    path: "/product",
    name: "Product",
    component: ProductPage,
  },
  { path: '/product/:category', name: 'ProductByCategory', component: ProductPage },
  {
    path: "/product/:id", 
    name: "ProductDetails",
    component: ProductDetailsPage, 
    props: true
  },
  { path: '/contact', name: 'Contact', component: ContactPage },
  { path: '/checkout', name: 'CheckOut', component: CheckOutPage },
  { path: '/staff-login', name: 'StaffLogin', component: StaffLoginPage },
  { path: '/staff', name: 'Staff', component: StaffPage },
  { path: '/staff-register', name: 'StaffRegister', component: StaffRegistrationPage },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
