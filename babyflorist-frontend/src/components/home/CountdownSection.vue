<template>
  <div class="counter">
    <div class="gallery clearfix">
      <figure style="position: relative; opacity: 1; top: 0px; left: 0px;">
        <div class="img-counter"><img src="/images/counter3.png" alt="img-counter"></div>
        <div class="container counter-content">
          <div class="row">
            <!-- Left Column: Course Card OR Default Image -->
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6" :class="{ 'product-counter': featuredCourse }">
              <CourseCard v-if="featuredCourse" :course="featuredCourse" style="width: 400px; max-width: 100%;" />
              
              <div v-else class="default-image-container">
                <img src="/images/anhhoa1.png" alt="Flowers" style="width: 100%; height: auto;">
              </div>
            </div>

            <!-- Right Column: Countdown -->
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
              <div class="title-count">
                <h1 v-if="featuredCourse">Sale up to {{ featuredCourse.discount }}%</h1>
                <h1 v-else>Sale up to 40%</h1>
                
                <p>It is a long established fact that a reader will be distracted by the<br> readable content of a page when looking at its layout</p>
                <div id="countdown">
                  <div id="tiles">
                    <span class="tile">{{ days }}</span>
                    <span class="tile">{{ hours }}</span>
                    <span class="tile">{{ minutes }}</span>
                    <span class="tile">{{ seconds }}</span>
                  </div>
                  <ul class="labels">
                    <li>Days</li>
                    <li>Hours</li>
                    <li>Mins</li>
                    <li>Secs</li>
                  </ul>
                </div>
                <router-link to="/products" class="shop-now-btn">Shop now</router-link>
              </div>
            </div>
          </div>
        </div>
      </figure>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import axios from 'axios'
import CourseCard from '@/components/CourseCard.vue'

const featuredCourse = ref(null)
const targetDate = ref(new Date())
const now = ref(new Date())
let timer = null

const timeLeft = computed(() => {
  const diff = targetDate.value - now.value
  if (diff <= 0) return { days: 0, hours: 0, minutes: 0, seconds: 0 }
  
  return {
    days: Math.floor(diff / (1000 * 60 * 60 * 24)),
    hours: Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
    minutes: Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)),
    seconds: Math.floor((diff % (1000 * 60)) / 1000)
  }
})

const days = computed(() => String(timeLeft.value.days).padStart(2, '0'))
const hours = computed(() => String(timeLeft.value.hours).padStart(2, '0'))
const minutes = computed(() => String(timeLeft.value.minutes).padStart(2, '0'))
const seconds = computed(() => String(timeLeft.value.seconds).padStart(2, '0'))

const fetchFlashDeal = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/courses/flash-deal')
    if (response.data.success && response.data.data) {
      const course = response.data.data
      featuredCourse.value = {
        id: course.id,
        title: course.name,
        image: 'http://127.0.0.1:8000/storage/' + course.thumbnail,
        badge: '🎓',
        lessons: course.lesson_count || 0,
        price: course.sale_price || course.price,
        originalPrice: course.sale_price ? course.price : null,
        students: course.student_count || 0,
        description: course.description || '',
        level: course.type === 'offline' ? 'Offline' : 'Online',
        discount: course.real_discount_percent ? Math.round(course.real_discount_percent) : 0
      }

      // Set countdown to sale_end
      if (course.sale_end) {
        targetDate.value = new Date(course.sale_end)
      } else {
         // If active deal but no specific end date, maybe set to tomorrow or similar?
         // User didn't specify, but for now let's keep it running for 24h or so if undefined.
         // Or just +30 days as default fallback.
         targetDate.value = new Date()
         targetDate.value.setDate(targetDate.value.getDate() + 30)
      }
    } else {
      // No deal found -> Default behavior
      featuredCourse.value = null
      targetDate.value = new Date()
      targetDate.value.setDate(targetDate.value.getDate() + 30)
    }
  } catch (error) {
    console.error('Error fetching flash deal:', error)
    // Fallback
    featuredCourse.value = null
    targetDate.value = new Date()
    targetDate.value.setDate(targetDate.value.getDate() + 30)
  }
}

onMounted(() => {
  timer = setInterval(() => {
    now.value = new Date()
  }, 1000)
  fetchFlashDeal()
})

onUnmounted(() => {
  if (timer) clearInterval(timer)
})
</script>

<style scoped>
.product-counter {
  display: flex;
  justify-content: flex-end;
}

.title-count {
  text-align: center;
  padding-top: 0;
}

.title-count h1 {
  font-family: 'Abril Fatface', serif;
  font-size: 48px;
  margin-bottom: 15px;
}

.title-count p {
  font-family: 'Inter', sans-serif;
  color: #666;
  margin-bottom: 30px;
}

#tiles {
  display: flex;
  gap: 15px;
  justify-content: center;
  margin-bottom: 10px;
}

.tile {
  background: rgba(255, 255, 255, 0.95);
  width: 80px;
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 32px;
  font-weight: bold;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
  font-family: 'Inter', sans-serif;
}

.labels {
  display: flex;
  justify-content: center;
  gap: 15px;
  list-style: none;
  padding: 0;
  margin: 0 0 30px 0;
}

.labels li {
  font-size: 14px;
  color: #666;
  width: 80px;
  text-align: center;
  font-family: 'Inter', sans-serif;
}

.shop-now-btn {
  display: inline-block;
  background: #1a1a1a;
  color: #fff !important;
  padding: 14px 50px;
  border-radius: 4px;
  text-decoration: none;
  font-weight: 500;
  font-family: 'Inter', sans-serif;
  transition: background 0.3s ease;
}

.shop-now-btn:hover {
  background: #333;
  color: #fff;
  text-decoration: none;
}
</style>
