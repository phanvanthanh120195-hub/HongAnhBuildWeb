<template>
  <div class="info-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <h3>About</h3>
            <ul>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/blog">News & Stories</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/about">History</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/about">Our Studio</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/products">Shop</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Stockists</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <h3>Customer services</h3>
            <ul>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/about">Contact Us</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Trade Services</a></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/login">Login/Register</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Delivery & Returns</a></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">FAQs</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <h3>Store</h3>
            <ul>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/products">Shop</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/category/wedding">Wedding</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/category/birthday">Birthday</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/category/womens-day">Women's day</router-link></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <h3>Shop collection</h3>
            <ul>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/products?filter=new">New Arrivals</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/products?filter=hot">Hot</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/products?filter=sale">Sale</router-link></li>
              <li><i class="fas fa-long-arrow-alt-right"></i><router-link to="/products?filter=deal">Deal of the day</router-link></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 social">
          <p>CONNECT WITH US:</p>
          <a href="#" id="link-insta"></a>
          <a href="#" id="link-fb"></a>
          <a href="#" id="link-tw"></a>
          <a href="#" id="link-sky"></a>
          <h1>Newsletter</h1>
          <h2>Sign up for our mailing list to get latest updates and offers</h2>
          <form class="form-group" @submit.prevent="subscribe">
            <input type="email" v-model="email" placeholder="Your mail here" class="input-lg" required>
            <button type="submit"><img src="https://landing.engotheme.com/html/jenstore/demo/img/Send.png" alt="send"></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const email = ref('')

function subscribe() {
  if (email.value) {
    alert('Thank you for subscribing!')
    email.value = ''
  }
}
</script>
