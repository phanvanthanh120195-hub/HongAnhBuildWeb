<template>
  <div class="who" id="showcase">
    <div class="gallery clearfix">
      <figure>
        <img src="https://landing.engotheme.com/html/jenstore/demo/img/who.png" alt="who we are">
        <h1>Who we are?</h1>
        <h1 class="h2">Tôi là ai?</h1>
        
        <div v-if="aboutData.description" v-html="aboutData.description" class="description-container"></div>
        <p v-else>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has<br class="hidden-md hidden-sm hidden-xs">
          been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
          galley of type<br class="hidden-md hidden-sm hidden-xs"> and scrambled it to make a type
          specimen book. It has survived not only five centuries, but also the leap into<br class="hidden-md hidden-sm hidden-xs"> electronic typesetting, remaining essentially
          unchanged. It was popularised in the 1960s with the release of <br class="hidden-md hidden-sm hidden-xs">
          Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing <br class="hidden-md hidden-sm hidden-xs">
          software like Aldus PageMaker including versions of Lorem Ipsum
        </p>

        <div class="media">
          <div class="media-left">
             <img :src="aboutData.image ? getImageUrl(aboutData.image) : '/images/avatar.jpg'" id="avatar" class="media-object" alt="avatar">
          </div>
          <div class="media-body">
            <h3>{{ aboutData.name || 'Hồng Anh' }}</h3><span>Phan</span>
          </div>
        </div>
      </figure>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const aboutData = ref({})

const getImageUrl = (path) => {
    if (!path) return ''
    if (path.startsWith('http')) return path
    return `http://127.0.0.1:8000/storage/${path}`
}

onMounted(async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/about-us')
        if (response.data.status && response.data.data) {
            aboutData.value = response.data.data
        }
    } catch (error) {
        console.error('Failed to fetch About Us data:', error)
    }
})
</script>

<style scoped>
.description-container,
figure > p {
    max-width: 720px;
    margin: 0 auto;
}

/* Base style for fallback P as well if needed, but the user specifically mentioned the description */
:deep(.description-container p) {
    margin-bottom: 10px;
    max-width: 720px;
}
</style>
