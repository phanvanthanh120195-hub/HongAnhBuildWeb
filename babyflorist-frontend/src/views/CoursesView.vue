<template>
  <div class="courses-view container">
    <h1 class="text-center">Danh sách Khóa học</h1>
    <div class="packages-grid">
      <CourseCard v-for="course in courses" :key="course.id" :course="course" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import CourseCard from '@/components/CourseCard.vue'

const courses = ref([])
const loading = ref(false)

const fetchCourses = async () => {
  loading.value = true
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/courses')
    if (response.data && response.data.success) {
      courses.value = response.data.data.map((item, index) => {
        // Map backend fields to frontend component props
        return {
          id: item.id,
          title: item.name,
          slug: item.slug,
          // Handle image URL - if it's a relative path, prepend backend URL
          image: item.thumbnail ? (item.thumbnail.startsWith('http') ? item.thumbnail : `http://127.0.0.1:8000/storage/${item.thumbnail}`) : 'https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?w=400&h=300&fit=crop',
          badge: item.type === 'hot' ? '🔥' : '🎓',
          cardClass: index % 2 === 0 ? 'card-blue' : 'card-orange',
          coursesCount: item.lesson_count || 0,
          originalPrice: item.sale_price ? item.price : 0,
          price: item.sale_price || item.price,
          level: 'All levels',
          weeklyPrice: 0, // Not used in backend
          students: item.student_count || 0,
          lessons: item.lesson_count || 0,
          description: item.description || 'No description available',
        }
      })
    }
  } catch (error) {
    console.error("Failed to fetch courses:", error)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchCourses()
})
</script>

<style scoped>
.courses-view {
  padding-top: 150px; /* Offset for fixed header */
  padding-bottom: 50px;
}
</style>
