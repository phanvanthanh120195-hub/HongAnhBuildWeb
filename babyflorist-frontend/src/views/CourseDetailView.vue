<template>
  <div class="course-detail-page">
    <div class="course-header">
      <div class="container">
        <ul class="breadcrumb">
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/courses">Courses</router-link></li>
          <li>{{ course?.title }}</li>
        </ul>
        <div class="row header-content">
          <div class="col-md-8">
             <span class="badge-category">{{ course?.badge }} {{ course?.level }}</span>
             <h1>{{ course?.title }}</h1>
             <p class="subtitle">{{ course?.subtitle }}</p>
             <div class="course-meta">
                <div class="meta-item">
                   <i class="far fa-user"></i>
                   <span>Instructor: <strong>{{ course?.instructor }}</strong></span>
                </div>
                <div class="meta-item">
                   <i class="fas fa-star text-warning"></i>
                   <span>{{ course?.rating }} ({{ course?.ratingCount }} ratings)</span>
                </div>
                <div class="meta-item">
                   <i class="fas fa-user-graduate"></i>
                   <span>{{ course?.students }} students</span>
                </div>
                <div class="meta-item">
                   <i class="far fa-clock"></i>
                   <span>Last updated {{ course?.updatedDate }}</span>
                </div>
             </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container course-body">
      <div class="row">
        <!-- Main Content (Left) -->
        <div class="col-lg-8 col-md-8">
           <div class="course-image">
              <img :src="course?.image" alt="Course Image" class="img-responsive">
           </div>
           
           <div class="section-block">
              <h2>What you'll learn</h2>
              <div class="learning-objectives">
                 <ul>
                    <li v-for="(item, index) in course?.objectives" :key="index"><i class="fas fa-check"></i> {{ item }}</li>
                 </ul>
              </div>
           </div>

           <div class="section-block">
              <h2>Course Content</h2>
               <div class="curriculum-list">
                  <div class="curriculum-item" v-for="(section, idx) in course?.curriculum" :key="idx">
                     <div class="section-header" @click="section.expanded = !section.expanded">
                        <h4>
                           <i :class="section.expanded ? 'fas fa-angle-up' : 'fas fa-angle-down'"></i>
                           {{ section.title }}
                        </h4>
                        <span>{{ section.lectures.length }} lectures</span>
                     </div>
                     <ul class="lectures-list" v-show="section.expanded">
                        <li v-for="(lecture, lIdx) in section.lectures" :key="lIdx">
                           <i class="far fa-play-circle"></i> {{ lecture }}
                        </li>
                     </ul>
                  </div>
               </div>
           </div>

           <div class="section-block">
               <h2>Instructor</h2>
               <div class="instructor-box">
                  <div class="instructor-img">
                     <img src="/images/avatar.jpg" alt="Instructor">
                  </div>
                  <div class="instructor-bio">
                     <h3>{{ course?.instructor }}</h3>
                     <p class="bio-text">Expert in Floral Design and Botany with over 10 years of experience.</p>
                  </div>
               </div>
           </div>
        </div>

        <!-- Sidebar (Right) -->
        <div class="col-lg-4 col-md-4">
           <div class="course-sidebar-card">
              <div class="video-preview" v-if="course?.videoPreview">
                 <img :src="course?.image" alt="Preview">
                 <div class="play-overlay"><i class="fas fa-play"></i></div>
              </div>
              <div class="sidebar-content">
                 <div class="price-box">
                    <span class="current-price">${{ course?.price }}</span>
                    <span class="original-price">${{ course?.originalPrice }}</span>
                    <span class="discount-off">15% off</span>
                 </div>
                 <template v-if="isRegistrationOpen">
                    <button @click="goToRegister" class="btn-enroll-now text-center d-block w-100">ĐĂNG KÝ NGAY</button>
                 </template>
                 <template v-else>
                    <router-link class="btn-enroll-disabled text-center d-block text-decoration-none">CHƯA MỞ ĐĂNG KÝ</router-link>
                 </template>
                 <p class="guarantee-text">30-Day Money-Back Guarantee</p>
                 <div class="includes-box">
                    <h4>This course includes:</h4>
                    <ul>
                       <li><i class="fas fa-video"></i> {{ course?.duration }} hours on-demand video</li>
                       <li><i class="fas fa-file-download"></i> {{ course?.resources }} downloadable resources</li>
                       <li><i class="fas fa-mobile-alt"></i> Access on mobile and TV</li>
                       <li><i class="fas fa-certificate"></i> Certificate of completion</li>
                    </ul>
                 </div>
              </div>
           </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'
import { useToast } from 'vue-toastification'
import { useAuthStore } from '@/stores/auth'
import { useAuthModalStore } from '@/stores/authModal'

const route = useRoute()
const router = useRouter()
const toast = useToast()
const authStore = useAuthStore()
const authModalStore = useAuthModalStore()
const course = ref(null)
const loading = ref(false)

// Function to format price
const formatPrice = (value) => {
    if (!value) return '0'
    return new Intl.NumberFormat('en-US').format(value)
}

const formatDate = (dateStr) => {
    if (!dateStr) return ''
    return new Date(dateStr).toLocaleDateString('vi-VN')
}

// Check if registration is open based on sale_start and sale_end
const isRegistrationOpen = computed(() => {
    if (!course.value) return false
    
    const now = new Date()
    const start = course.value.sale_start ? new Date(course.value.sale_start) : null
    const end = course.value.sale_end ? new Date(course.value.sale_end) : null
    
    // If no dates set, registration is CLOSED (require dates to be set)
    if (!start && !end) return false
    
    // If only end date is set, check if still valid
    if (!start && end) return now <= end
    
    // Check start date
    if (start && now < start) return false
    
    // Check end date
    if (end && now > end) return false
    
    return true
})

const loadCourse = async () => {
    loading.value = true
    try {
        // Assume frontend has base URL setup for axios or use relative path
        // Using relative path /api assuming proxy or same domain, typical in setup. 
        // If vite is proxying to backend, /api works.
        // Actually, backend is at 127.0.0.1:8000, frontend at 5173. 
        // Need to check if axios global base URL is set. 
        // If not, I should use full URL or import configured axios.
        // I'll assume global axios defaults or implicit relative if proxy is set.
        // For safety, I will check if there is a global axios config, but here I'll try standard.
        // Since I don't see axios config file open, I will assume simple usage.
        
        let slug = route.params.slug
        // If accessed via ID (legacy), handle it or redirect? Route definition seems to imply slug or id.
        // User's previous code checked params.slug.
        
        if (!slug) {
            // Fallback or error
            console.error("No slug provided")
            return
        }

        const response = await axios.get(`http://127.0.0.1:8000/api/courses/${slug}`)
        
        if (response.data && response.data.success) {
            const data = response.data.data
            
            // Map backend data to frontend model
            // Fill missing data with placeholders as requested by user
            course.value = {
                id: data.id,
                title: data.name,
                subtitle: data.description || 'Learn how to unlock your full potential and achieve success in all areas of life.',
                image: data.thumbnail ? `http://127.0.0.1:8000/storage/${data.thumbnail}` : 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=450&fit=crop',
                badge: data.type === 'hot' ? 'Best Seller' : 'New', // Logic can be improved
                level: 'All Levels', // Placeholder
                instructor: data.instructor || 'Hồng Anh Phan',
                rating: 4.8, // Placeholder
                ratingCount: 1240, // Placeholder
                students: data.student_count || 0,
                updatedDate: new Date(data.updated_at).toLocaleDateString(),
                price: formatPrice(data.sale_price || data.price),
                originalPrice: formatPrice(data.price),
                duration: 12.5, // Placeholder
                resources: 45, // Placeholder
                objectives: [ // Placeholder
                    'Understand the core principles of cognitive psychology',
                    'Develop a growth mindset for personal and professional life',
                    'Master techniques for stress management and focus',
                    'Build lasting habits that drive success'
                ],
                curriculum: [ // Placeholder
                    {
                        title: 'Introduction to Mindset',
                        expanded: true,
                        lectures: ['Welcome to the course', 'What is Mindset?', 'Fixed vs Growth Mindset']
                    },
                    {
                        title: 'Rewiring Your Brain',
                        expanded: false,
                        lectures: ['Neuroplasticity explained', 'Cognitive biases', 'Memory improvement techniques']
                    },
                    {
                        title: 'Emotional Intelligence',
                        expanded: false,
                        lectures: ['Understanding emotions', 'Empathy and social skills', 'Self-regulation strategies']
                    }
                ],
                // Store raw dates for validity check
                sale_start: data.sale_start,
                sale_end: data.sale_end
            }
        }
    } catch (error) {
        console.error("Error loading course:", error)
        toast.error("KhÃ´ng thá»ƒ táº£i thÃ´ng tin khÃ³a há»c")
    } finally {
        loading.value = false
    }
}

watch(() => route.params.slug, loadCourse)

onMounted(() => {
    loadCourse()
})

function goToRegister() {
    const checkoutUrl = '/checkout/course/' + (route.params.slug || course.value?.id)
    if (!authStore.token) {
        toast.warning('Vui lòng đăng nhập để đăng ký khóa học')
        authModalStore.openLogin(checkoutUrl)
        return
    }
    router.push(checkoutUrl)
}
</script>

<style scoped>
.course-detail-page {
   padding-top: 150px;
   padding-bottom: 50px;
}

.course-header {
   background-color: #1c1d1f;
   color: white;
   padding: 30px 0;
   margin-bottom: 40px;
}

.header-content h1 {
   color: white;
   font-family: 'Abril Fatface';
   font-size: 36px;
   margin-bottom: 15px;
}

.subtitle {
   font-size: 18px;
   margin-bottom: 20px;
}

.breadcrumb > li > a, .breadcrumb > li {
   color: #ccc;
}
.breadcrumb { background: transparent; padding-left: 0; }

.badge-category {
   background: #eceb98;
   color: #3d3c0a;
   padding: 5px 10px;
   font-weight: bold;
   font-size: 12px;
   text-transform: uppercase;
   margin-bottom: 10px;
   display: inline-block;
}

.btn-enroll-disabled {
   background: #ccc;
   color: #666;
   padding: 15px 30px;
   border: none;
   border-radius: 6px;
   cursor: not-allowed;
}

.course-meta {
   display: flex;
   gap: 20px;
   flex-wrap: wrap;
   font-size: 14px;
}

.meta-item i {
   margin-right: 5px;
   color: #f3ca8c;
}

.course-body {
   position: relative;
}

.course-image img {
   width: 100%;
   border-radius: 8px;
   margin-bottom: 30px;
}

.section-block {
   margin-bottom: 40px;
}

.section-block h2 {
   font-size: 24px;
   font-weight: bold;
   margin-bottom: 20px;
   color: #333;
}

.learning-objectives {
   border: 1px solid #d1d7dc;
   padding: 20px;
   background: #fff;
}

.learning-objectives ul {
   list-style: none;
   padding: 0;
   display: grid;
   grid-template-columns: 1fr 1fr;
   gap: 15px;
}

.learning-objectives li i {
   color: #3b82f6;
   margin-right: 10px;
}

/* Sidebar Card */
.course-sidebar-card {
   background: white;
   box-shadow: 0 4px 12px rgba(0,0,0,0.1);
   position: sticky;
   top: 100px;
   border: 1px solid #fff;
}

.video-preview {
   position: relative;
   cursor: pointer;
}
.video-preview img { width: 100%; }
.play-overlay {
   position: absolute;
   top: 50%; left: 50%;
   transform: translate(-50%, -50%);
   background: rgba(255,255,255,0.8);
   width: 60px; height: 60px;
   border-radius: 50%;
   display: flex; align-items: center; justify-content: center;
   font-size: 24px;
   color: black;
}

.sidebar-content {
   padding: 20px;
}

.price-box { margin-bottom: 20px; }
.current-price { font-size: 32px; font-weight: bold; margin-right: 15px; color: #333; }
.original-price { text-decoration: line-through; color: #666; font-size: 16px; }

.btn-enroll-now {
   display: block;
   width: 100%;
   background: #a435f0;
   color: white;
   border: none;
   padding: 15px;
   font-weight: bold;
   font-size: 16px;
   margin-bottom: 15px;
   cursor: pointer;
}
.btn-enroll-now:hover { background: #8710d8; }

.btn-enroll-disabled {
   display: block;
   width: 100%;
   background: #ccc;
   color: #666;
   border: none;
   padding: 15px;
   font-weight: bold;
   font-size: 16px;
   margin-bottom: 15px;
   cursor: not-allowed;
   text-decoration: none;
}

.guarantee-text { text-align: center; font-size: 12px; color: #666; margin-bottom: 20px; }

.includes-box h4 { font-size: 16px; font-weight: bold; margin-bottom: 10px; }
.includes-box ul { list-style: none; padding: 0; }
.includes-box li { margin-bottom: 8px; font-size: 14px; }
.includes-box li i { width: 20px; text-align: center; margin-right: 10px; }

/* Instructor */
.instructor-box { display: flex; gap: 20px; align-items: start; }
.instructor-img img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; }
.instructor-bio h3 { margin-top: 0; font-size: 18px; font-weight: bold; text-decoration: underline; color: #a435f0; }

/* Curriculum */
.curriculum-item { border: 1px solid #d1d7dc; margin-bottom: -1px; }
.section-header { background: #f7f9fa; padding: 15px; cursor: pointer; display: flex; justify-content: space-between; align-items: center; }
.section-header h4 { margin: 0; font-size: 16px; }
.lectures-list { list-style: none; padding: 0; margin: 0; }
.lectures-list li { padding: 10px 20px; border-top: 1px solid #eee; font-size: 14px; }
.lectures-list li i { margin-right: 10px; color: #666; }
</style>

