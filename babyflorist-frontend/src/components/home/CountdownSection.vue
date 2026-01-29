<template>
  <div class="counter">
    <div class="gallery clearfix">
      <figure style="position: relative; opacity: 1; top: 0px; left: 0px;">
        <div class="img-counter"><img src="/images/counter3.png" alt="img-counter"></div>
        <div class="container counter-content">
          <div class="row">
            <!-- <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 product-counter">
              <div class="package-card" id="KH-3" style="width: 400px;">
                <div class="default-view">
                  <div class="card-image card-blue">
                    <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?w=400&h=300&fit=crop" alt="Course">
                    <div class="card-badge">🎓</div>
                  </div>
                  <div class="card-content">
                    <div class="courses-count">3 Courses Included</div>
                    <h3 class="card-title">Master Your Mindset: Unleashing the Power Within</h3>
                    <div class="card-pricing">
                      <span class="original-price">$4060</span>
                      <span class="current-price">$2003</span>
                    </div>
                  </div>
                </div>
                <div class="hover-view">
                  <div class="hover-header">
                    <span class="level-tag">Advanced</span>
                    <span class="hover-price">$45 <small>pw</small></span>
                  </div>
                  <h3 class="hover-title">Master Your Mindset: Unleashing the Power Within</h3>
                  <div class="card-stats">
                    <span class="stat-item"><i class="fas fa-user-graduate"></i> 15 Students</span>
                    <span class="stat-item"><i class="fas fa-file-alt"></i> 12 Lessons</span>
                  </div>
                  <p class="hover-desc">Dive deep into advanced cognitive strategies to unlock your full potential. This course covers...</p>
                  <button class="view-detail-btn">View Detail</button>
                </div>
              </div>
            </div> -->

            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
              <img src="/images/anhhoa1.png" alt="anhhoa">
            </div>

            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
              <div class="title-count">
                <h1>Sale up to 40%</h1>
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

const targetDate = ref(new Date())
targetDate.value.setDate(targetDate.value.getDate() + 30) // 30 days from now

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

onMounted(() => {
  timer = setInterval(() => {
    now.value = new Date()
  }, 1000)
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
  padding: 20px 25px;
  font-size: 32px;
  font-weight: bold;
  border-radius: 8px;
  min-width: 80px;
  text-align: center;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
  font-family: 'Inter', sans-serif;
}

.labels {
  display: flex;
  justify-content: center;
  gap: 50px;
  list-style: none;
  padding: 0;
  margin: 0 0 30px 0;
}

.labels li {
  font-size: 14px;
  color: #666;
  min-width: 80px;
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
