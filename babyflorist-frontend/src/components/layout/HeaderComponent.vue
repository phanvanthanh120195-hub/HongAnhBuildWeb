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
            <li class="hidden-lg hidden-md"><a href="#" @click.prevent="handleUserClick"><i class="far fa-user"></i> Tài khoản</a></li>
            <li class="hidden-lg hidden-md hidden-sm phone-mobile"><strong>P:</strong>800 123 654 78</li>
            <li class="hidden-lg hidden-md hidden-sm phone-mobile"><strong>E:</strong>contact@babyflorist.com</li>
          </ul>
        </div>
        <ul class="logo col-lg-1 col-md-1 col-sm-7 col-xs-7">
          <li><router-link to="/"><img src="https://landing.engotheme.com/html/jenstore/demo/img/logo.png" class="img-responsive" alt="BabyFlorist"></router-link></li>
        </ul>
        <ul class="nav navbar-nav navbar-right icon-menu col-lg-4 col-md-4 col-sm-5 col-xs-5">
          <li class="icon-user hidden-sm hidden-xs" style="position: relative;">
              <a href="#" @click.prevent="handleUserClick"><i class="far fa-user"></i></a>
              <div v-if="isUserMenuOpen && authStore.isAuthenticated" class="user-dropdown">
                  <div class="user-info-header">
                      <strong>{{ authStore.user?.name || 'Customer' }}</strong>
                  </div>
                  <router-link to="/profile" class="user-dropdown-item" @click="isUserMenuOpen = false">
                      <i class="far fa-user"></i> Thông tin cá nhân
                  </router-link>
                  <a href="#" class="user-dropdown-item" @click.prevent="handleLogout">
                      <i class="fas fa-sign-out-alt"></i> Đăng xuất
                  </a>
              </div>
          </li>
          <li class="dropdown cart-menu">
            <a href="#" @click.prevent="toggleCartDrawer">
              <img src="https://landing.engotheme.com/html/jenstore/demo/img/cart.png" id="img-cart" alt="cart">
              <span v-if="cartCount > 0" class="cart-badge">{{ cartCount }}</span>
            </a>
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

  <AuthModal 
    :is-open="authModalStore.isOpen" 
    :initial-mode="authModalStore.mode"
    @close="handleAuthModalClose"
  />

  <CartDrawer 
    :is-open="isCartDrawerOpen"
    @close="isCartDrawerOpen = false"
  />
</template>

<style scoped>
.user-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    width: 220px;
    background: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-radius: 6px;
    padding: 8px 0;
    z-index: 9999;
    border: 1px solid #eee;
}

.user-info-header {
    padding: 10px 15px;
    border-bottom: 1px solid #eee;
    margin-bottom: 5px;
    color: #333;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-dropdown-item {
    display: block;
    padding: 10px 15px;
    color: #555;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.2s;
    text-align: left;
}

.user-dropdown-item:hover {
    background: #f9f9f9;
    color: #ff4d4d;
    text-decoration: none;
}

.user-dropdown-item:hover i {
    color: #ff4d4d;
}

.user-dropdown-item i {
    width: 20px;
    text-align: center;
    margin-right: 8px;
    font-size: 16px;
    padding-right: 0;
}
</style>

<script setup>
import { ref, computed, watch } from 'vue'
import { useCartStore } from '@/stores/cart'
import { useAuthStore } from '@/stores/auth'
import { useAuthModalStore } from '@/stores/authModal'
import AuthModal from '@/components/auth/AuthModal.vue'
import CartDrawer from '@/components/cart/CartDrawer.vue'
import { useRouter } from 'vue-router'

const cartStore = useCartStore()
const authStore = useAuthStore()
const authModalStore = useAuthModalStore()
const router = useRouter()

const cartCount = computed(() => cartStore.itemCount)
const showSearch = ref(false)
const searchQuery = ref('')

// Auth State
const isUserMenuOpen = ref(false)
const isCartDrawerOpen = ref(false)

// Watch for successful login and redirect
watch(() => authStore.isAuthenticated, (isAuth) => {
    if (isAuth && authModalStore.redirectAfterLogin) {
        const redirect = authModalStore.redirectAfterLogin
        authModalStore.close()
        router.push(redirect)
    }
})

function toggleCartDrawer() {
  isCartDrawerOpen.value = !isCartDrawerOpen.value
}

function toggleSearch() {
  showSearch.value = !showSearch.value
}

function handleUserClick() {
  if (authStore.isAuthenticated) {
    isUserMenuOpen.value = !isUserMenuOpen.value
  } else {
    authModalStore.openLogin()
  }
}

function handleAuthModalClose() {
  authModalStore.close()
}

function handleLogout() {
  authStore.logout()
  isUserMenuOpen.value = false
  router.push('/')
}
</script>
