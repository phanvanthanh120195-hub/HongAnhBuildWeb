<template>
  <header class="navbar-fixed-top pos-header" id="header-v1">
    <nav class="hidden-xs">
      <div class="container">
        <ul class="nav navbar-nav navbar-right language">
          <li><img style="width: 12px;margin-right: 5px;" src="/images/Phone-Number.png" alt="phone">800 123 654 78</li>
          <li><img style="width: 12px;margin-right: 5px;" src="/images/Email-Address.png" alt="email">phanvanthanh@gmail.com</li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="navbar-header mobile-menu">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <i class="fas fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse col-lg-6 col-md-6 col-sm-12 col-xs-12" id="myNavbar">
          <form class="hidden-lg hidden-md form-group form-search-mobile">
            <input type="text" name="search" placeholder="Search here..." class="form-control">
            <button type="submit"><img src="https://landing.engotheme.com/html/jenstore/demo/img/Search.png" alt="search" class="img-responsive"></button>
          </form>
          <ul class="nav navbar-nav menu-main">
            <li>
              <figure id="btn-close-menu" class="hidden-lg hidden-md"><i class="far fa-times-circle"></i></figure>
            </li>
            <li class="dropdown menu-home">
              <router-link to="/" id="home-menu">Trang chủ</router-link>
            </li>
            <li class="shop-menu dropdown">
              <router-link to="/products">Sản phẩm</router-link>
              <figure id="shop-1" class="hidden-sm hidden-xs"></figure>
            </li>
            <li class="wedding-menu">
              <router-link to="/courses">Khóa học</router-link>
              <figure id="wedding-1" class="hidden-sm hidden-xs"></figure>
            </li>
            <li class="blog-menu dropdown">
              <router-link to="/blog">Blog</router-link>
              <figure id="blog-1" class="hidden-sm hidden-md hidden-xs"></figure>
            </li>
            <li class="wedding-menu">
              <router-link to="/about">Về chúng tôi</router-link>
              <figure id="wedding-1" class="hidden-sm hidden-xs"></figure>
            </li>
            <li class="hidden-lg hidden-md"><router-link to="/profile"><i class="far fa-user"></i> Tài khoản</router-link></li>
            <li class="hidden-lg hidden-md hidden-sm phone-mobile"><strong>P:</strong>800 123 654 78</li>
            <li class="hidden-lg hidden-md hidden-sm phone-mobile"><strong>E:</strong>contact@babyflorist.com</li>
          </ul>
        </div>
        <ul class="logo col-lg-1 col-md-1 col-sm-7 col-xs-7">
          <li><router-link to="/"><img src="https://landing.engotheme.com/html/jenstore/demo/img/logo.png" class="img-responsive" alt="BabyFlorist"></router-link></li>
        </ul>
        <ul class="nav navbar-nav navbar-right icon-menu col-lg-4 col-md-4 col-sm-5 col-xs-5">
          <li class="icon-user hidden-sm hidden-xs"><router-link to="/profile"><i class="far fa-user"></i></router-link></li>
          <li class="dropdown cart-menu">
            <router-link to="/cart">
              <img src="https://landing.engotheme.com/html/jenstore/demo/img/cart.png" id="img-cart" alt="cart">
              <span v-if="cartCount > 0" class="cart-badge">{{ cartCount }}</span>
            </router-link>
          </li>
          <li id="input-search" class="hidden-sm hidden-xs">
            <a href="#" @click.prevent="toggleSearch"><img src="https://landing.engotheme.com/html/jenstore/demo/img/Search.png" alt="search"></a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Search Overlay -->
    <div class="content-search" v-show="showSearch">
      <div class="container container-100">
        <i class="far fa-times-circle" id="close-search" @click="toggleSearch"></i>
        <h3 class="text-center">what are your looking for ?</h3>
        <form method="get" action="/search" role="search" style="position: relative;">
          <input type="text" class="form-control control-search" v-model="searchQuery" autocomplete="off" placeholder="Enter Search ..." aria-label="SEARCH" name="q">
          <button class="button_search" type="submit">search</button>
        </form>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useCartStore } from '@/stores/cart'

const cartStore = useCartStore()
const cartCount = computed(() => cartStore.itemCount)
const showSearch = ref(false)
const searchQuery = ref('')

function toggleSearch() {
  showSearch.value = !showSearch.value
}
</script>
