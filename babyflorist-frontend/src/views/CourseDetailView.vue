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
                 <button class="btn-enroll-now">ENROLL NOW</button>
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
import { ref, onMounted, watch } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const course = ref(null)

const allCourses = [
  {
    id: 1,
    title: 'Master Your Mindset: Unleashing the Power Within',
    subtitle: 'Learn how to unlock your full potential and achieve success in all areas of life.',
    image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=450&fit=crop',
    badge: 'Best Seller',
    level: 'All Levels',
    instructor: 'Hồng Anh Phan',
    rating: 4.8,
    ratingCount: 1240,
    students: 5432,
    updatedDate: '01/2024',
    price: 2001,
    originalPrice: 2530,
    duration: 12.5,
    resources: 45,
    objectives: [
       'Understand the core principles of cognitive psychology',
       'Develop a growth mindset for personal and professional life',
       'Master techniques for stress management and focus',
       'Build lasting habits that drive success'
    ],
    curriculum: [
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
    ]
  },
   {
    id: 5,
    title: 'Floral Design Basics',
    subtitle: 'Step-by-step guide to creating stunning floral arrangements at home.',
    image: 'https://images.unsplash.com/photo-1507290439931-a861b5a38200?w=800&h=450&fit=crop',
    badge: 'New',
    level: 'Beginner',
    instructor: 'Hồng Anh Phan',
    rating: 4.9,
    ratingCount: 320,
    students: 1200,
    updatedDate: '12/2023',
    price: 2500,
    originalPrice: 3000,
    duration: 8,
    resources: 10,
    objectives: [
       'Learn tool safety and preparation',
       'Understand color theory in floristry',
       'Create 5 different types of arrangements',
       'Care tips for longer lasting flowers'
    ],
    curriculum: [
       { title: 'Getting Started', expanded: true, lectures: ['Tools of the trade', 'Selecting fresh flowers'] },
       { title: 'Design Principles', expanded: false, lectures: ['Balance and Harmony', 'Color schemes', 'Texture and Form'] },
       { title: 'The Arrangements', expanded: false, lectures: ['Hand-tied bouquet', 'Vase arrangement', 'Centerpiece'] }
    ]
  }
]

function loadCourse() {
   const id = route.params.id || 1 // simplified mock logic
   // In real app we use slug or id properly
   course.value = allCourses[0] 
   if(route.params.slug && route.params.slug.includes('floral')) { 
       course.value = allCourses[1]
   }
}

watch(() => route.params.slug, loadCourse)

onMounted(() => {
   loadCourse()
})
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
