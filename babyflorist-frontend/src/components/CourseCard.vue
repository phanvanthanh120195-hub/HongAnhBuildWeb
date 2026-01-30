<template>
  <div class="package-card" :id="'KH-' + course.id">
    <div class="default-view">
      <div class="card-image" :class="course.cardClass">
        <img :src="course.image" :alt="course.title">
        <div class="card-badge">{{ course.badge }}</div>
      </div>
      <div class="card-content">
        <div class="courses-count">{{ course.coursesCount }} bài học</div>
        <h3 class="card-title">{{ course.title }}</h3>
        <div class="card-pricing">
          <span class="original-price" v-if="course.originalPrice">{{ formatPrice(course.originalPrice) }}đ</span>
          <span class="current-price">{{ formatPrice(course.price) }}đ</span>
        </div>
      </div>
    </div>
    <div class="hover-view">
      <div class="hover-header">
        <span class="level-tag">{{ course.level }}</span>
        <span class="hover-price">{{ formatPrice(course.price) }} <small>đ</small></span>
      </div>
      <h3 class="hover-title">{{ course.title }}</h3>
      <div class="card-stats">
        <span class="stat-item"><i class="fas fa-user-graduate"></i> {{ course.students }} Học viên</span>
        <span class="stat-item"><i class="fas fa-file-alt"></i> {{ course.lessons }} Bài học</span>
      </div>
      <p class="hover-desc">{{ course.description }}</p>
      <router-link :to="'/courses/' + (course.slug || course.id)" class="view-detail-btn text-center">Xem chi tiết</router-link>
    </div>
  </div>
</template>

<script setup>
defineProps({
  course: {
    type: Object,
    required: true
  }
})

const formatPrice = (price) => {
  if (!price) return '0'
  return Math.floor(price).toLocaleString('en-US')
}
</script>
