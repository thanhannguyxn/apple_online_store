<template>
  <div class="contact-page">
    <!-- Title -->
    <div class="text-center my-4">
      <h1 class="fw-bold">Contact Apple</h1>
      <p>Get in touch with Apple support or visit our stores for assistance.</p>
    </div>

    <!-- Contact Information -->
    <div class="container">
      <div class="row">
        <!-- Apple Store Information -->
        <div class="col-12 mb-4">
          <div class="contact-card text-center">
            <h3>Apple Store</h3>
            <p>
              Visit your nearest Apple Store to experience the latest Apple
              products in person.
            </p>
            <ul class="list-unstyled">
              <li>
                <strong>Address:</strong> 1 Infinite Loop, Cupertino, CA 95014,
                USA
              </li>
              <li><strong>Phone:</strong> +1 800-676-2775</li>
              <li><strong>Email:</strong> support@apple.com</li>
            </ul>
          </div>
        </div>

        <!-- Customer Support Information -->
        <div class="col-12 mb-4">
          <div class="contact-card text-center">
            <h3>Customer Support</h3>
            <p>
              We are here to help you with any questions or issues you may have.
            </p>
            <ul class="list-unstyled">
              <li>
                <strong>Support Phone:</strong> +1 800-APL-CARE (800-275-2273)
              </li>
              <li>
                <strong>Technical Support Email:</strong> techsupport@apple.com
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Social Media Links -->
    <div class="text-center my-4">
      <h3>Follow Us</h3>
      <p>Stay connected with Apple on our social media platforms.</p>
      <div class="social-links">
        <a
          href="https://www.facebook.com/apple"
          target="_blank"
          class="social-icon me-3"
        >
          <i class="fab fa-facebook-square fa-2x"></i>
        </a>
        <a
          href="https://twitter.com/apple"
          target="_blank"
          class="social-icon me-3"
        >
          <i class="fab fa-twitter fa-2x"></i>
        </a>
        <a
          href="https://www.instagram.com/apple"
          target="_blank"
          class="social-icon me-3"
        >
          <i class="fab fa-instagram fa-2x"></i>
        </a>
        <a
          href="https://www.linkedin.com/company/apple"
          target="_blank"
          class="social-icon me-3"
        >
          <i class="fab fa-linkedin fa-2x"></i>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContactPage",
};
</script>

<style scoped>
.contact-page {
  padding: 3rem 0;
  background-color: #f8f9fa;
}

h1,
h3 {
  color: #333;
}

.contact-card {
  background-color: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.contact-card h3 {
  font-size: 1.8rem;
  margin-bottom: 1rem;
  color: #007bff;
}

.contact-card p {
  font-size: 1.1rem;
  color: #555;
}

.contact-card ul {
  list-style: none;
  padding: 0;
}

.contact-card ul li {
  font-size: 1.1rem;
  margin-bottom: 0.5rem;
  color: #333;
}

.social-links {
  text-align: center;
}

.social-icon {
  color: #333;
  text-decoration: none;
}

.social-icon:hover {
  color: #007bff;
}

.social-links .fab {
  transition: transform 0.3s ease;
}

.social-links .fab:hover {
  transform: scale(1.2);
}

@media (max-width: 768px) {
  .contact-card {
    margin-bottom: 20px;
  }
}
</style>
