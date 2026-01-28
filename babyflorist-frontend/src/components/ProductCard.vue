<template>
  <div class="product-image-wedding" v-if="type === 'wedding'">
    <figure :class="product.tag">
      <router-link :to="'/products/' + product.slug">
        <img :src="product.image" class="img-responsive" :alt="product.name">
      </router-link>
    </figure>
  </div>
  <div class="product-title-wedding" v-if="type === 'wedding'">
    <h5><router-link :to="'/products/' + product.slug">{{ product.name }}</router-link></h5>
    <div class="prince">
      {{ formatPrice(product.price) }}đ
      <s v-if="product.originalPrice" class="strike">{{ formatPrice(product.originalPrice) }}đ</s>
    </div>
  </div>

  <div class="product-image-holiday" v-if="type === 'holiday'">
    <figure :class="product.tag">
      <router-link :to="'/products/' + product.slug">
        <img :src="product.image" class="img-responsive" :alt="product.name">
      </router-link>
    </figure>
  </div>
  <div class="product-title-holiday" v-if="type === 'holiday'">
    <h5><router-link :to="'/products/' + product.slug">{{ product.name }}</router-link></h5>
    <div class="prince">
      {{ formatPrice(product.price) }}đ
      <s v-if="product.originalPrice" class="strike">{{ formatPrice(product.originalPrice) }}đ</s>
    </div>
  </div>
</template>

<script setup>
import { useCartStore } from '@/stores/cart'

const props = defineProps({
  product: {
    type: Object,
    required: true
  },
  type: {
    type: String,
    default: 'wedding'
  }
})

const formatPrice = (price) => {
  if (!price) return '0'
  return Math.floor(price).toLocaleString('en-US')
}

const cartStore = useCartStore()

function addToCart() {
  cartStore.addItem({
    id: props.product.id,
    name: props.product.name,
    price: props.product.price,
    image: props.product.image,
    quantity: 1
  })
}
</script>

<style scoped>

/* Image styling */
.product-image-wedding img,
.product-image-holiday img {
    height: 390px;
    width: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    display: block; /* Removes bottom space often caused by inline images */
}


</style>
