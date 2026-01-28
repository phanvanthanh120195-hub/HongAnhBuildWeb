<template>
  <div class="holiday" id="showcase-4">
    <div class="container">
      <h1>Sản phẩm mới</h1>
      <h2>- Mẫu sản phẩm mới nhất hiện nay -</h2>
      <div class="gallery clearfix">
        <figure>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <div v-for="product in products" :key="product.id" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 product-holiday">
                <ProductCard :product="product" type="holiday" />
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 banner-holiday">
              <div class="img-banner-holiday">
                <img src="https://landing.engotheme.com/html/jenstore/demo/img/holiday.png" class="img-responsive" alt="holiday">
              </div>
              <div class="title-holiday">
                <h1>HAPPY MOTHER'S DAY</h1>
                <p>Lorem ipsum is simply dummy text of the printing and typesetting</p>
                <span id="sale30">-30</span><span id="pt">%</span><br><span id="off">OFF</span>
              </div>
            </div>
          </div>
        </figure>
      </div>
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
    const response = await axios.get('http://127.0.0.1:8000/api/products?label_new=1')
    if (response.data.success) {
      products.value = response.data.data.map(product => ({
        id: product.id,
        name: product.name,
        slug: 'slug-product-' + product.id, // Using helper/mock slug for now if not provided
        image: 'http://127.0.0.1:8000/storage/' + product.thumbnail,
        price: product.sale_price || product.price,
        originalPrice: product.sale_price ? product.price : null,
        rating: 5,
        tag: product.label || ''
      }))
    }
  } catch (error) {
    console.error('Error fetching new products:', error)
  }
})
</script>
