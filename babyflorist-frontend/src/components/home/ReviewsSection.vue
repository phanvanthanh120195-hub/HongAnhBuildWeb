<template>
  <div class="container student-reviews" id="showcase-5">
    <h4 class="text-center sub-title">STUDENTS SAY</h4>
    <h1 class="text-center main-title">Satisfaction is always present</h1>

    <!-- Loading state -->
    <div v-if="loading" class="text-center">
      <i class="fas fa-spinner fa-spin fa-2x"></i>
      <p>Đang tải đánh giá...</p>
    </div>

    <!-- Error state -->
    <div v-else-if="error" class="text-center text-danger">
      <p>{{ error }}</p>
    </div>

    <!-- Swiper -->
    <div v-else class="swiper mySwiper" ref="swiperRef">
      <div class="swiper-wrapper">
        <div v-for="review in reviews" :key="review.id" class="swiper-slide">
          <div class="review-card">
            <div class="card-header-review">
              <img :src="review.avatar" alt="Student" class="student-img">
              <div class="student-info">
                <h3>{{ review.name }}</h3>
                <span>Student</span>
              </div>
            </div>
            <div class="card-body-review">
              <p>{{ review.comment }}</p>
            </div>
            <div class="card-footer-review">
              <div class="star-rating">
                <i v-for="n in 5" :key="n" :class="n <= review.rating ? 'fas fa-star' : 'far fa-star'"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { reviewService } from '@/services/api'

const swiperRef = ref(null)
const reviews = ref([])
const loading = ref(true)
const error = ref(null)

const defaultAvatar = 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&h=100&fit=crop'

const initSwiper = () => {
  const tryInit = () => {
    if (window.Swiper && swiperRef.value) {
      new window.Swiper(swiperRef.value, {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: reviews.value.length > 3,
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        },
        breakpoints: {
          320: {
              slidesPerView: 1,
              spaceBetween: 20,
          },
          768: {
              slidesPerView: 2,
              spaceBetween: 30,
          },
          1024: {
              slidesPerView: 3,
              spaceBetween: 30,
          },
        }
      })
    } else {
      // Retry after 100ms if Swiper not loaded yet
      setTimeout(tryInit, 100)
    }
  }
  tryInit()
}

const fetchReviews = async () => {
  try {
    loading.value = true
    error.value = null
    const response = await reviewService.getAll({ limit: 6 })
    if (response.data.success) {
      reviews.value = response.data.data.map(review => ({
        ...review,
        avatar: review.avatar || defaultAvatar
      }))
      // Initialize swiper after data loads and DOM updates
      await nextTick()
      initSwiper()
    }
  } catch (err) {
    console.error('Error fetching reviews:', err)
    error.value = 'Không thể tải đánh giá. Vui lòng thử lại sau.'
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchReviews()
})
</script>

