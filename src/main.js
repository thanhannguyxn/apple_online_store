import { createApp } from "vue";
import App from "./App.vue";

import router from "./router"; // Import router
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

createApp(App)
  .use(router)  // Đảm bảo Vue Router được sử dụng trong ứng dụng
  .mount('#app');
