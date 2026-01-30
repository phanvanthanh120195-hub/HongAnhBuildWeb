<template>
  <div class="product-detail-page">
    <div class="container">
      <ul class="breadcrumb">
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/products">Products</router-link></li>
        <li><a href="#">{{ product?.name }}</a></li>
      </ul>

      <div class="row product-detail-main">
        <!-- Image Gallery -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="product-image-gallery">
            <div class="main-image">
              <img :src="product?.image" :alt="product?.name" class="img-responsive">
            </div>
          </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="product-info-detail">
            <h1>{{ product?.name }}</h1>
            <div class="rating-review">
              <div class="star">
                <i v-for="n in 5" :key="n" :class="n <= (product?.rating || 0) ? 'fas fa-star' : 'far fa-star'"></i>
              </div>
              <span>(5 Customer Reviews)</span>
            </div>
            
            <div class="price-detail">
              <span class="current-price">${{ product?.price }}</span>
              <span v-if="product?.originalPrice" class="original-price">${{ product?.originalPrice }}</span>
            </div>

            <p class="description">{{ product?.description }}</p>

            <div class="product-actions">
              <div class="quantity-control">
                <button @click="decreaseQty">-</button>
                <input type="text" v-model="quantity" readonly>
                <button @click="increaseQty">+</button>
              </div>
              <button class="btn-add-cart" @click="addToCart">ADD TO CART</button>
            </div>

            <div class="product-meta">
              <p><strong>SKU:</strong> {{ product?.sku || 'N/A' }}</p>
              <p><strong>Category:</strong> <router-link to="/categories/wedding">{{ product?.category || 'Wedding' }}</router-link></p>
              <p><strong>Tags:</strong> Flower, Beauty, Gift</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Product Tabs -->
      <div class="row product-tabs-section">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li :class="{ active: activeTab === 'description' }">
              <a href="#" @click.prevent="activeTab = 'description'">Description</a>
            </li>
            <li :class="{ active: activeTab === 'reviews' }">
              <a href="#" @click.prevent="activeTab = 'reviews'">Reviews (5)</a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane" :class="{ active: activeTab === 'description' }">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum.</p>
              <p>Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
            </div>
            <div class="tab-pane" :class="{ active: activeTab === 'reviews' }">
              <div class="review-list">
                 <div class="review-item">
                    <h5>Admin</h5>
                    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p>Great product!</p>
                 </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Related Products -->
      <div class="row related-products">
        <div class="col-xs-12">
           <h2 class="section-title text-center">Related Products</h2>
           <div class="row">
              <div v-for="item in relatedProducts" :key="item.id" class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                 <ProductCard :product="item" type="wedding" />
              </div>
           </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useCartStore } from '@/stores/cart'
import ProductCard from '@/components/ProductCard.vue'

const route = useRoute()
const cartStore = useCartStore()

const quantity = ref(1)
const activeTab = ref('description')

// Mock Database
const allProducts = [
  {
    id: 1,
    name: 'Queen Rose - Pink',
    slug: 'queen-rose-pink',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/wedding-1.jpg',
    price: 300.2,
    originalPrice: 250.9,
    rating: 5,
    tag: 'sale',
    description: 'Beautiful pink queen roses for your special day.',
    sku: 'WD-001',
    category: 'Wedding'
  },
  {
    id: 2,
    name: 'Bouquet Lavender',
    slug: 'bouquet-lavender',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/wedding-2.jpg',
    price: 160.8,
    originalPrice: null,
    rating: 4,
    tag: '',
    sku: 'WD-002',
    category: 'Wedding',
    description: 'Fresh lavender bouquet.'
  },
  {
     id: 5,
    name: 'Fun & Flirty By BloomNation',
    slug: 'fun-flirty',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/holiday-1.jpg',
    price: 200.2,
    originalPrice: null,
    rating: 4,
    tag: 'hot',
    sku: 'HD-001',
    category: 'Holiday',
    description: 'Fun and flirty arrangement for holidays.'
  }
]

const product = ref(null)
const relatedProducts = ref([])

function loadProduct() {
  const slug = route.params.slug
  // Find product by slug
  product.value = allProducts.find(p => p.slug === slug) || allProducts[0]
  
  // Mock related products
  relatedProducts.value = allProducts.filter(p => p.id !== product.value.id).slice(0, 4)
  if (relatedProducts.value.length < 4) {
      // fill with duplicates if not enough mock data
      relatedProducts.value = [...relatedProducts.value, ...allProducts].slice(0,4)
  }
}

watch(() => route.params.slug, loadProduct)

onMounted(() => {
  loadProduct()
})

function decreaseQty() {
  if (quantity.value > 1) quantity.value--
}

function increaseQty() {
  quantity.value++
}

function addToCart() {
  if (product.value) {
    cartStore.addItem({
      id: product.value.id,
      name: product.value.name,
      price: product.value.price,
      image: product.value.image,
      quantity: quantity.value
    })
    alert('Added to cart!')
  }
}
</script>

<style scoped>
.product-detail-page {
  padding-top: 150px;
  padding-bottom: 50px;
}

.product-image-gallery img {
  width: 100%;
  border: 1px solid #eee;
}

.product-info-detail h1 {
  font-family: 'Abril Fatface', cursive;
  font-size: 36px;
  margin-top: 0;
}

.rating-review {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
}

.rating-review .star {
  color: #e18787;
}

.price-detail {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.current-price {
  color: #000;
}

.original-price {
  color: #999;
  text-decoration: line-through;
  font-size: 18px;
  margin-left: 10px;
}

.description {
  color: #666;
  line-height: 1.6;
  margin-bottom: 30px;
}

.product-actions {
  display: flex;
  gap: 20px;
  margin-bottom: 30px;
}

.quantity-control {
  border: 1px solid #ddd;
  display: flex;
}

.quantity-control button {
  width: 40px;
  height: 45px;
  border: none;
  background: white;
  font-size: 18px;
}

.quantity-control input {
  width: 50px;
  height: 45px;
  border: none;
  text-align: center;
  font-weight: bold;
}

.btn-add-cart {
  background: black;
  color: white;
  border: 1px solid black;
  padding: 0 40px;
  height: 45px;
  font-weight: bold;
  letter-spacing: 1px;
  transition: all 0.3s;
}

.btn-add-cart:hover {
  background: white;
  color: black;
}

.product-meta p {
  margin-bottom: 5px;
  color: #666;
}

.product-tabs-section {
  margin-top: 60px;
  margin-bottom: 60px;
}

.nav-tabs > li > a {
  color: #666;
  font-size: 16px;
  font-weight: bold;
}

.nav-tabs > li.active > a {
  color: black;
  border-bottom: 2px solid black;
}

.tab-content {
  padding: 30px 0;
}

.related-products .section-title {
  font-family: 'Abril Fatface';
  margin-bottom: 40px;
}
</style>
