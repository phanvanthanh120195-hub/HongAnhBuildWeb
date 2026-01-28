<template>
  <div class="container student-reviews" id="showcase-5">
    <h4 class="text-center sub-title">STUDENTS SAY</h4>
    <h1 class="text-center main-title">Satisfaction is always present</h1>

    <!-- Swiper -->
    <div class="swiper mySwiper" ref="swiperRef">
      <div class="swiper-wrapper">
        <div v-for="review in reviews" :key="review.id" class="swiper-slide">
          <div class="review-card">
            <div class="card-header-review">
              <img :src="review.avatar" alt="Student" class="student-img">
              <div class="student-info">
                <h3>{{ review.name }}</h3>
                <span>{{ review.studentCount }} Student</span>
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
import { ref, onMounted } from 'vue'

const swiperRef = ref(null)

const reviews = ref([
  {
    id: 1,
    name: 'Pensive-Tesla',
    avatar: 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&h=100&fit=crop',
    studentCount: '1.2k',
    rating: 5,
    comment: 'Very interesting course. I loved the calmness over it all. I learned a lot about the use of colors. Green is never just green and white is never just white. Thank you!'
  },
  {
    id: 2,
    name: 'Pensive-Tesla',
    avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop',
    studentCount: '1.2k',
    rating: 5,
    comment: '"I recommend Futurelearn to anyone looking to learn and upskill...If you are in the job market, you might want to add a new skill or forge a new path."'
  },
  {
    id: 3,
    name: 'Pensive-Tesla',
    avatar: 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop',
    studentCount: '1.2k',
    rating: 5,
    comment: '"FutureLearn courses are always interesting and informative. They bring the classroom right to you and send you on a journey to explore new ideas and offer interesting topics."'
  },
  {
    id: 4,
    name: 'Pensive-Tesla',
    avatar: 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&h=100&fit=crop',
    studentCount: '1.2k',
    rating: 5,
    comment: 'Very interesting course. I loved the calmness over it all. I learned a lot about the use of colors. Green is never just green and white is never just white. Thank you!'
  },
  {
    id: 5,
    name: 'Pensive-Tesla',
    avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop',
    studentCount: '1.2k',
    rating: 5,
    comment: '"I recommend Futurelearn to anyone looking to learn and upskill...If you are in the job market, you might want to add a new skill or forge a new path."'
  },
  {
    id: 6,
    name: 'Pensive-Tesla',
    avatar: 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop',
    studentCount: '1.2k',
    rating: 5,
    comment: '"FutureLearn courses are always interesting and informative. They bring the classroom right to you and send you on a journey to explore new ideas and offer interesting topics."'
  }
])

onMounted(() => {
  // Initialize Swiper if available
  if (window.Swiper && swiperRef.value) {
    new window.Swiper('.mySwiper', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false
      },
      breakpoints: {
        640: {
          slidesPerView: 2
        },
        992: {
          slidesPerView: 3
        }
      }
    })
  }
})
</script>
