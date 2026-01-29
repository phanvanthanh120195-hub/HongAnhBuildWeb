<template>
  <div class="container blog">
    <h1>Bài viết mới nhất</h1>
    <p>- Nơi chia sẻ những vấn đề về hoa -</p>
    
    <!-- Loading state -->
    <div v-if="loading" class="text-center">
      <i class="fas fa-spinner fa-spin fa-2x"></i>
      <p>Đang tải bài viết...</p>
    </div>
    
    <!-- Error state -->
    <div v-else-if="error" class="text-center text-danger">
      <p>{{ error }}</p>
    </div>
    
    <!-- Posts list -->
    <div v-else class="row">
      <div v-for="post in posts" :key="post.id" class="col-lg-4 col-md-4 col-sm-4 col-xs-6 product-blog">
        <router-link :to="'/blog/' + post.slug">
          <img :src="post.thumbnail || defaultImage" class="img-responsive" :title="post.title" :alt="post.title">
        </router-link>
        <div class="time-blog">
          <span class="time"><i class="far fa-calendar-alt"></i><span>{{ post.published_at }}</span></span>
          <span class="time"><i class="far fa-folder"></i><span>{{ post.category || 'Uncategorized' }}</span></span>
        </div>
        <h2><router-link :to="'/blog/' + post.slug">{{ post.title }}</router-link></h2>
        <p>{{ post.excerpt }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.product-blog img{
    max-height: 350px;
}
</style>

<script setup>
import { ref, onMounted } from 'vue'
import { blogService } from '@/services/api'

const posts = ref([])
const loading = ref(true)
const error = ref(null)
const defaultImage = 'https://landing.engotheme.com/html/jenstore/demo/img/blog-1.jpg'

const fetchPosts = async () => {
  try {
    loading.value = true
    error.value = null
    const response = await blogService.getAll({ limit: 3 })
    if (response.data.success) {
      posts.value = response.data.data
    }
  } catch (err) {
    console.error('Error fetching blog posts:', err)
    error.value = 'Không thể tải bài viết. Vui lòng thử lại sau.'
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchPosts()
})
</script>

