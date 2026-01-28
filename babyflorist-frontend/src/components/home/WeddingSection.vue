<template>
  <div class="wedding" id="showcase-3">
    <h1>Sản phẩm nổi bật</h1>
    <h2>- Mẫu sản phẩm đang hot nhất hiện nay -</h2>
    <div class="gallery clearfix">
      <figure>
        <div class="img-wedding"><img src="https://landing.engotheme.com/html/jenstore/demo/img/wedding.png" alt="wedding"></div>
        <div class="container wedding-content">
          <div class="row">
            <div v-for="product in products" :key="product.id" class="col-lg-3 col-md-3 col-sm-3 col-xs-6 product-wedding">
              <ProductCard :product="product" type="wedding" />
            </div>
          </div>
        </div>
      </figure>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import ProductCard from '@/components/ProductCard.vue'

const products = ref([])

onMounted(async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/products?featured=1')
    if (response.data.success) {
      products.value = response.data.data.map(product => ({
        id: product.id,
        name: product.name,
        slug: product.slug || `product-${product.id}`,
        image: product.thumbnail ? `http://127.0.0.1:8000/storage/${product.thumbnail}` : 'https://landing.engotheme.com/html/jenstore/demo/img/wedding-1.jpg',
        price: product.sale_price || product.price,
        originalPrice: product.sale_price ? product.price : null,
        tag: product.label || ''
      }))
    }
  } catch (error) {
    console.error('Failed to fetch products:', error)
  }
})
</script>
