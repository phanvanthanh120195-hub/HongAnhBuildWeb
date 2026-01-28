<template>
  <div class="courses-view container">
    <h1 class="text-center">Danh sách Khóa học</h1>
    <div class="packages-grid">
      <CourseCard v-for="course in courses" :key="course.id" :course="course" />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import CourseCard from '@/components/CourseCard.vue'

// Temporary mock data - ideally this would come from an API store or shared data
const courses = ref([
 {
    id: 1,
    title: 'Master Your Mindset: Unleashing the Power Within',
    image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=400&h=300&fit=crop',
    badge: '🎓',
    cardClass: 'card-blue',
    coursesCount: 6,
    originalPrice: 2530,
    price: 2001,
    level: 'All levels',
    weeklyPrice: 30,
    students: 35,
    lessons: 6,
    description: 'The jQuery team knows all about cross-browser issues, and they have written this knowledge into the jQuery library.'
  },
  {
    id: 2,
    title: 'Illustrator master class',
    image: 'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?w=400&h=300&fit=crop',
    badge: '📸',
    cardClass: 'card-orange',
    coursesCount: 6,
    originalPrice: 2690,
    price: 2002,
    level: 'Beginner',
    weeklyPrice: 25,
    students: 42,
    lessons: 8,
    description: 'Learn the basics of Adobe Illustrator and start creating amazing vector graphics today.'
  },
  {
    id: 3,
    title: 'Advanced Cognitive Strategies',
    image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=400&h=300&fit=crop',
    badge: '🎓',
    cardClass: 'card-blue',
    coursesCount: 3,
    originalPrice: 4060,
    price: 2003,
    level: 'Advanced',
    weeklyPrice: 45,
    students: 15,
    lessons: 12,
    description: 'Dive deep into advanced cognitive strategies to unlock your full potential.'
  },
  {
    id: 4,
    title: 'Psychology of Success',
    image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=400&h=300&fit=crop',
    badge: '🎓',
    cardClass: 'card-blue',
    coursesCount: 3,
    originalPrice: 4060,
    price: 2003,
    level: 'Intermediate',
    weeklyPrice: 35,
    students: 28,
    lessons: 5,
    description: 'A robust guide to understanding the psychology of success. Improve your daily habits.'
  },
  {
    id: 5,
    title: 'Floral Design Basics',
    image: 'https://images.unsplash.com/photo-1507290439931-a861b5a38200?w=400&h=300&fit=crop',
    badge: '🌸',
    cardClass: 'card-orange',
    coursesCount: 4,
    originalPrice: 3000,
    price: 2500,
    level: 'Beginner',
    weeklyPrice: 40,
    students: 120,
    lessons: 10,
    description: 'Learn the art of floral arrangement from scratch.'
  },
  {
    id: 6,
    title: 'Wedding Floristry',
    image: 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=400&h=300&fit=crop',
    badge: '💍',
    cardClass: 'card-blue',
    coursesCount: 8,
    originalPrice: 5000,
    price: 4500,
    level: 'Advanced',
    weeklyPrice: 50,
    students: 45,
    lessons: 15,
    description: 'Master the complex skills needed for wedding floral designs.'
  }
])
</script>

<style scoped>
.courses-view {
  padding-top: 150px; /* Offset for fixed header */
  padding-bottom: 50px;
}
</style>
