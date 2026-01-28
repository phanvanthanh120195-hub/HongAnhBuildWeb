<template>
  <div class="container collection" id="showcase-2">
    <h1>Khóa học</h1>
    <h2>- Tất cả khóa học -</h2>
    <div class="gallery clearfix">
      <figure>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 banner-collec">
            <img src="https://landing.engotheme.com/html/jenstore/demo/img/collection.png" class="img-responsive" alt="banner">
            <h3>Xin chào</h3>
            <h1>Sale 10%</h1>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="packages-grid">
              <CourseCard v-for="course in courses" :key="course.id" :course="course" />
            </div>
            <div v-if="courses.length >= 4" class="view-all-container">
              <router-link to="/courses" class="view-all-btn">Xem tất cả</router-link>
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
import CourseCard from '@/components/CourseCard.vue'

const courses = ref([])

onMounted(async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/courses')
    if (response.data.success) {
      courses.value = response.data.data.slice(0, 4).map(course => ({
        id: course.id,
        title: course.name,
        image: course.thumbnail ? `http://127.0.0.1:8000/storage/${course.thumbnail}` : 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=400&h=300&fit=crop',
        badge: '🎓', // Static badge as requested
        cardClass: 'card-blue', // Placeholder class, could be dynamic based on id or random
        coursesCount: course.lesson_count, // Mapping lesson count to courses count as placeholder logic
        originalPrice: course.sale_price ? course.price : null, // Only set if there is a sale
        price: course.sale_price || course.price, // Sale price or regular price
        level: 'Offline', // Static for now
        weeklyPrice: 30, // Static for now
        students: course.student_count,
        lessons: course.lesson_count,
        description: course.description || 'Không có mô tả'
      }))
    }
  } catch (error) {
    console.error('Failed to fetch courses:', error)
  }
})
</script>
