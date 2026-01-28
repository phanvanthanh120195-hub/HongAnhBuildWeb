<template>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li v-for="(slide, index) in slides" :key="index" 
          :class="{ active: currentSlide === index }"
          @click="goToSlide(index)"></li>
    </ol>

    <!-- Slides -->
    <div class="carousel-inner">
      <div v-for="(slide, index) in slides" :key="index" 
           :class="['item', slide.class, { active: currentSlide === index }]">
        <img :src="slide.image" alt="slide">
        <div class="carousel-caption">
          <h3>{{ slide.subtitle }}</h3>
          <h1>{{ slide.title }}</h1>
          <div v-if="slide.hasLine" class="line"></div>
          <p>{{ slide.description }}</p>
          <img v-if="slide.hasPattern" src="https://landing.engotheme.com/html/jenstore/demo/img/Pattern.png" alt="pattern"><br v-if="slide.hasPattern">
          <router-link :to="slide.link">{{ slide.buttonText }}</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const slides = ref([
  {
    class: 'slide-1',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/slider-1.png',
    subtitle: 'EXPLORE THE',
    title: 'New Arrivals',
    description: 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout',
    hasPattern: true,
    hasLine: false,
    buttonText: 'Khóa học',
    link: '/courses'
  },
  {
    class: 'slide-2',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/slider-2.png',
    subtitle: 'A Perfect',
    title: 'Bouquet',
    description: 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout',
    hasPattern: false,
    hasLine: true,
    buttonText: 'Shop now',
    link: '/products'
  }
])

const currentSlide = ref(0)
let slideInterval = null

function nextSlide() {
  currentSlide.value = (currentSlide.value + 1) % slides.value.length
}

function goToSlide(index) {
  currentSlide.value = index
}

onMounted(() => {
  slideInterval = setInterval(nextSlide, 5000)
})

onUnmounted(() => {
  if (slideInterval) clearInterval(slideInterval)
})
</script>

<style scoped>
.carousel-inner > .item {
  display: none;
}
.carousel-inner > .item.active {
  display: block;
}
</style>
