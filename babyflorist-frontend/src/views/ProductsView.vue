<template>
  <div class="products-view container">
    <h1 class="text-center">Tất cả Sản phẩm</h1>
    <div class="row">
      <!-- Sidebar / Filter could go here -->
      <div class="col-lg-12">
        <div class="row">
           <div v-for="product in products" :key="product.id" class="col-lg-3 col-md-3 col-sm-4 col-xs-6 product-wedding">
              <ProductCard :product="product" type="wedding" />
           </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import ProductCard from '@/components/ProductCard.vue'

// Mock data blending wedding + holiday items + extra
const products = ref([
  {
    id: 1,
    name: 'Queen Rose - Pink',
    slug: 'queen-rose-pink',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/wedding-1.jpg',
    price: 300.2,
    originalPrice: 250.9,
    rating: 5,
    tag: 'sale'
  },
  {
    id: 2,
    name: 'Bouquet Lavender',
    slug: 'bouquet-lavender',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/wedding-2.jpg',
    price: 160.8,
    originalPrice: null,
    rating: 4,
    tag: ''
  },
  {
    id: 3,
    name: 'Tulipa Floriade - Yellow',
    slug: 'tulipa-yellow',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/wedding-3.jpg',
    price: 200.7,
    originalPrice: null,
    rating: 3,
    tag: 'hot'
  },
  {
    id: 4,
    name: 'Bouquet Rose',
    slug: 'bouquet-rose',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/wedding-4.jpg',
    price: 350.4,
    originalPrice: null,
    rating: 4,
    tag: ''
  },
  {
    id: 5,
    name: 'Fun & Flirty By BloomNation',
    slug: 'fun-flirty',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/holiday-1.jpg',
    price: 200.2,
    originalPrice: null,
    rating: 4,
    tag: 'hot'
  },
  {
    id: 6,
    name: 'Winter White Bouquet',
    slug: 'winter-white',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/holiday-2.jpg',
    price: 240.2,
    originalPrice: null,
    rating: 5,
    tag: ''
  },
  {
    id: 9,
    name: 'Red Roses Deluxe',
    slug: 'red-roses-deluxe',
    image: 'https://images.unsplash.com/photo-1518709766631-a6a7f45921c3?w=400&h=400&fit=crop',
    price: 120.00,
    originalPrice: 150.00,
    rating: 5,
    tag: 'sale'
  },
  {
    id: 10,
    name: 'Sunflower Surprise',
    slug: 'sunflower-surprise',
    image: 'https://images.unsplash.com/photo-1470509037663-253afd7f0f51?w=400&h=400&fit=crop',
    price: 85.00,
    originalPrice: null,
    rating: 4,
    tag: 'new'
  }
])
</script>

<style scoped>
.products-view {
  padding-top: 150px;
  padding-bottom: 50px;
}
</style>
