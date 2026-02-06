<script setup>
const route = useRoute()
const slug = route.params.slug

import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';
import { Autoplay, Pagination } from 'swiper/modules';

const modules = [Autoplay, Pagination];

// Fetch course data from Backend API
const { data: response, error } = await useFetch(`http://127.0.0.1:8000/api/courses/${slug}`)
const course = computed(() => response.value?.data || {})

const titleParts = computed(() => {
    const rawTitle = course.value?.name || ''
    if (!rawTitle) return { line1: 'Đang tải...', line2: '', line3: '' }

    const words = rawTitle.split(' ')
    const line1 = words.slice(0, 2).join(' ')
    const line2 = words.slice(2, 5).join(' ')
    const line3 = words.slice(5).join(' ')

    return { line1, line2, line3 }
})

const processedContent = computed(() => {
    let content = course.value?.content || ''
    // Replace 'check_circle' keyword with Material Symbol icon
    return content.replace(/check_circle/g, '<span class="material-symbols-outlined text-primary text-xl align-middle mr-2 translate-y-[-2px]">check_circle</span>')
})

useHead({
    title: computed(() => `${course.value?.name || 'Chi tiết khóa học'} | Baby Florist`),
    meta: [
        { name: 'description', content: computed(() => course.value?.description || 'Khóa học cắm hoa chuyên nghiệp') }
    ]
})

// Check if course is open for registration
const isCourseOpen = computed(() => {
    if (!course.value) return false
    // Require both dates to be set
    if (!course.value.sale_start || !course.value.sale_end) return false
    const now = new Date()
    const start = new Date(course.value.sale_start)
    const end = new Date(course.value.sale_end)
    return now >= start && now <= end
})
</script>

<template>
    <div v-if="error" class="flex justify-center items-center h-screen">
        <p class="text-red-500 font-bold">Không tìm thấy khóa học hoặc lỗi kết nối.</p>
    </div>
    <div v-else class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-8 flex flex-1 justify-center py-8">
            <div class="layout-content-container flex flex-col w-full max-w-[1400px]">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center mb-16 lg:mb-24">
                    <div class="flex flex-col gap-6 order-2 lg:order-1">
                        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 font-medium">
                            <NuxtLink to="/" class="hover:text-primary">Trang chủ</NuxtLink>
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                            <NuxtLink to="/courses" class="hover:text-primary">Khóa học</NuxtLink>
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                            <span class="text-primary font-bold truncate max-w-[300px]">{{ course.name }}</span>
                        </div>

                        <!-- Dynamic Label -->
                        <div v-if="course.label || course.is_featured"
                            class="inline-flex self-start bg-wine/10 dark:bg-wine/30 px-3 py-1 rounded-full border border-wine/20">
                            <span class="text-wine dark:text-[#ff8a8a] text-xs font-bold uppercase tracking-wider">
                                {{ course.label || 'Khóa học Best Seller' }}
                            </span>
                        </div>

                        <h1
                            class="text-4xl lg:text-5xl xl:text-6xl font-black text-[#181111] dark:text-white !leading-[1.2]">
                            <div class="text-[#181111] dark:text-white">{{ titleParts.line1 }}</div>
                            <div class="text-transparent bg-clip-text bg-gradient-to-r from-wine to-primary mt-1">
                                {{ titleParts.line2 }}
                            </div>
                            <div class="text-primary mt-1">
                                {{ titleParts.line3 }}
                            </div>
                        </h1>

                        <!-- Dynamic Description with HTML processing -->
                        <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed max-w-lg">
                            {{ course.description }}
                        </p>
                        <div v-if="course.highlights && course.highlights.length > 0" class="flex flex-col gap-3">
                            <div v-for="highlight in course.highlights" :key="highlight.id"
                                class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">check_circle</span>
                                <span class="text-gray-700 dark:text-gray-200">{{ highlight.content }}</span>
                            </div>
                        </div>

                        <!-- Dynamic Targets -->
                        <div v-if="course.targets && course.targets.length > 0" class="flex flex-col gap-3">
                            <div v-for="(target, index) in course.targets" :key="index" class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">check_circle</span>
                                <span class="text-gray-700 dark:text-gray-200">{{ target }}</span>
                            </div>
                        </div>
                        <!-- Fallback targets if empty (Optional, but user asked to bind data, so maybe empty is correct if no data) -->

                        <div class="flex flex-col sm:flex-row items-center gap-6 mt-4">
                            <div class="flex items-end gap-2">
                                <span class="text-3xl font-bold text-primary dark:text-[#ff8a8a]">{{ new
                                    Intl.NumberFormat('vi-VN', {
                                        style: 'currency', currency: 'VND'
                                    }).format(course.sale_price || course.price || 0) }}</span>
                                <span v-if="course.sale_price" class="text-lg text-gray-400 line-through mb-1">{{
                                    new
                                        Intl.NumberFormat('vi-VN', {
                                            style: 'currency', currency: 'VND'
                                        }).format(course.price || 0) }}</span>
                            </div>
                            <button v-if="isCourseOpen" @click="navigateTo(`/carts/checkout?course=${course.slug}`)"
                                class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-wine to-[#961c1c] hover:from-[#5a1c22] hover:to-[#7a1212] text-white rounded-lg font-bold text-lg shadow-lg shadow-red-900/20 hover:shadow-xl transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                Đăng Ký Ngay
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </button>
                            <button v-else disabled
                                class="w-full sm:w-auto px-8 py-4 bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 rounded-lg font-bold text-lg cursor-not-allowed flex items-center justify-center gap-2">
                                Chưa mở đăng ký
                                <span class="material-symbols-outlined">block</span>
                            </button>
                        </div>
                        <div class="flex">
                            <p v-if="course.discount_percent" class="text-sm text-gray-500 italic mr-1">* Ưu đãi
                                giảm
                                <span class="font-bold">{{
                                    course.discount_percent
                                    }}%</span>
                            </p>
                            <p v-if="course.student_count" class="text-sm text-gray-500 italic"> Áp dụng cho <span
                                    class="font-bold">{{
                                        course.student_count }}</span> học viên đăng ký đầu tiên.</p>
                        </div>
                    </div>
                    <div class="relative order-1 lg:order-2">
                        <div
                            class="absolute inset-0 bg-gold rounded-2xl transform rotate-3 opacity-20 translate-x-4 translate-y-4">
                        </div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] w-full group"
                            :style="`background-image: url('${course.thumbnail ? (course.thumbnail.startsWith('http') ? course.thumbnail : 'http://127.0.0.1:8000/storage/' + course.thumbnail) : 'https://placehold.co/800x600'}'); background-size: cover; background-position: center;`">
                            <div
                                class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-all duration-500">
                            </div>
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur px-4 py-2 rounded-lg shadow-lg flex flex-col items-center">
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Thời
                                    lượng</span>
                                <span class="text-xl font-bold text-wine">{{ course.lesson_count || '03' }}
                                    Buổi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Curriculum & FAQ sections (Hardcoded structure but could bind later) -->
                <!-- I will keep the mockup structure for these parts as user only requested top section binding -->
                <div
                    class="bg-white dark:bg-[#1f1212] rounded-3xl p-8 lg:p-12 shadow-sm border border-gray-100 dark:border-gray-800 mb-16 relative overflow-hidden">
                    <div class="text-center mb-16 relative z-10">
                        <span class="text-primary font-bold tracking-widest uppercase text-sm">Chương trình
                            học</span>
                        <h2 class="text-3xl lg:text-4xl font-black mt-2 text-[#181111] dark:text-white">Lộ Trình Đào
                            Tạo</h2>
                        <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Giáo trình được thiết kế tinh gọn, tập trung
                            vào thực hành để bạn có thể tự tin sáng tạo ngay sau khóa học.</p>
                    </div>
                    <div class="relative z-10">
                        <div
                            class="absolute left-6 lg:left-1/2 top-0 bottom-0 w-0.5 bg-gray-100 dark:bg-gray-800 hidden lg:block">
                        </div>
                        <div class="flex flex-col gap-8 lg:gap-12">
                            <div v-for="(curriculum, index) in course.curriculums" :key="curriculum.id"
                                class="flex flex-col lg:flex-row gap-6 lg:gap-12 items-start lg:items-center justify-between w-full group">
                                <template v-if="index % 2 === 0">
                                    <div class="w-full lg:w-[45%] lg:text-right order-2 lg:order-1">
                                        <h3
                                            class="text-xl font-bold text-wine dark:text-[#ff8a8a] group-hover:text-primary transition-colors">
                                            {{ curriculum.title }}</h3>
                                        <p class="text-gray-600 dark:text-gray-300 mt-2">{{ curriculum.description
                                            }}
                                        </p>
                                    </div>
                                    <div
                                        class="relative z-10 w-12 h-12 rounded-full bg-gold text-wine font-black flex items-center justify-center text-xl shadow-lg border-4 border-white dark:border-[#1f1212] order-1 lg:order-2 shrink-0 group-hover:scale-110 transition-transform">
                                        {{ index + 1 }}</div>
                                    <div
                                        class="w-full lg:w-[45%] order-3 bg-background-light dark:bg-[#2a1a1a] p-5 rounded-xl border-l-4 border-gold group-hover:bg-[#e7e5e5] dark:group-hover:bg-[#332222] transition-colors shadow-sm lg:order-3">
                                        <ul class="space-y-3 text-sm">
                                            <li v-for="item in curriculum.items" :key="item.id"
                                                class="flex items-center gap-2">
                                                <span class="material-symbols-outlined text-lg text-primary">{{
                                                    item.icon || 'local_florist' }}</span>
                                                {{ item.content }}
                                            </li>
                                        </ul>
                                    </div>
                                </template>
                                <template v-else>
                                    <div
                                        class="w-full lg:w-[45%] order-3 bg-background-light dark:bg-[#2a1a1a] p-5 rounded-xl border-l-4 lg:border-l-0 lg:border-r-4 border-gold group-hover:bg-[#e7e5e5] dark:group-hover:bg-[#332222] transition-colors shadow-sm lg:order-1">
                                        <ul class="space-y-3 text-sm lg:text-right">
                                            <li v-for="item in curriculum.items" :key="item.id"
                                                class="flex items-center gap-2 lg:flex-row-reverse">
                                                <span class="material-symbols-outlined text-lg text-primary">{{
                                                    item.icon || 'local_florist' }}</span>
                                                {{ item.content }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="relative z-10 w-12 h-12 rounded-full bg-gold text-wine font-black flex items-center justify-center text-xl shadow-lg border-4 border-white dark:border-[#1f1212] order-1 lg:order-2 shrink-0 group-hover:scale-110 transition-transform">
                                        {{ index + 1 }}</div>
                                    <div class="w-full lg:w-[45%] lg:text-left order-2 lg:order-3">
                                        <h3
                                            class="text-xl font-bold text-wine dark:text-[#ff8a8a] group-hover:text-primary transition-colors">
                                            {{ curriculum.title }}</h3>
                                        <p class="text-gray-600 dark:text-gray-300 mt-2">{{ curriculum.description
                                            }}
                                        </p>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 mb-16 lg:mb-24">
                    <div class="lg:col-span-5">
                        <div class="sticky top-24">
                            <span class="text-primary font-bold tracking-widest uppercase text-sm">Hỗ trợ</span>
                            <h2 class="text-3xl font-black text-[#181111] dark:text-white mb-4 mt-2">Câu Hỏi Thường
                                Gặp</h2>
                            <p class="text-gray-600 dark:text-gray-300 mb-8">Bạn còn thắc mắc về khóa học? Đừng ngần
                                ngại liên hệ với chúng tôi để được tư vấn chi tiết hơn.</p>
                            <div class="relative rounded-xl overflow-hidden shadow-lg aspect-[4/3] group"
                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDi6tu_PFakN_PMcVOPdSmhxAjsPDOLNhl5uWgTTXPDKNkJc-jJUWxQGTguI4wDmSW-RUWu6DsPM4Uz1YleOeWbxg9mvcmRpI8rAevEO_mVVUMCeI3SSs6nimydGbMi--7CDdL-Lv0oWsWs6JgdoCDRfHNk8DrQOM9zfIUnrXZU9WeH6lUwjYZq4sp5QWsr5pe9lt28bCb26rI5dvj9QAV2JVNHLkzt-ow5R2Gb5V4nTAp7yWMW34lF8e0EidXxeQHMfCqwlyAHOt8'); background-size: cover; background-position: center;">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                <div class="absolute bottom-6 left-6 text-white">
                                    <p class="font-bold text-white/80 uppercase text-xs tracking-wider mb-1">Hotline
                                        tư vấn 24/7</p>
                                    <p class="text-3xl font-black text-gold">1900 1234</p>
                                    <button
                                        class="mt-4 px-4 py-2 bg-white/20 backdrop-blur hover:bg-white/30 rounded-lg text-sm font-bold transition-colors">Gửi
                                        tin nhắn ngay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="course.faqs" class="lg:col-span-7 flex flex-col gap-4 pt-4">
                        <details v-for="faq in course.faqs" :key="faq.id"
                            class="group bg-white dark:bg-[#2a1a1a] rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 open:ring-1 open:ring-primary/50 overflow-hidden transition-all duration-300">
                            <summary
                                class="flex items-center justify-between p-6 cursor-pointer select-none bg-gray-50/50 dark:bg-[#332222] group-open:bg-white dark:group-open:bg-[#2a1a1a] hover:bg-gray-100 dark:hover:bg-[#3d2b2b] transition-colors">
                                <span class="font-bold text-lg text-[#181111] dark:text-white">{{ faq.question
                                    }}</span>
                                <span
                                    class="material-symbols-outlined transition-transform duration-300 group-open:rotate-180 text-primary bg-primary/10 rounded-full p-1">expand_more</span>
                            </summary>
                            <div
                                class="p-6 pt-0 text-gray-600 dark:text-gray-300 leading-relaxed border-t border-transparent group-open:border-gray-100 dark:group-open:border-gray-700 animate-[fadeIn_0.3s_ease-out]">
                                <div class="mt-4 prose dark:prose-invert max-w-none" v-html="faq.answer"></div>
                            </div>
                        </details>
                        <div v-if="!course.faqs || course.faqs.length === 0"
                            class="lg:col-span-7 flex flex-col gap-4 pt-4">
                            <details
                                class="group bg-white dark:bg-[#2a1a1a] rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 open:ring-1 open:ring-primary/50 overflow-hidden transition-all duration-300">
                                <summary
                                    class="flex items-center justify-between p-6 cursor-pointer select-none bg-gray-50/50 dark:bg-[#332222] group-open:bg-white dark:group-open:bg-[#2a1a1a] hover:bg-gray-100 dark:hover:bg-[#3d2b2b] transition-colors">
                                    <span class="font-bold text-lg text-[#181111] dark:text-white">Tôi chưa từng cắm hoa
                                        thì có học được không?</span>
                                    <span
                                        class="material-symbols-outlined transition-transform duration-300 group-open:rotate-180 text-primary bg-primary/10 rounded-full p-1">expand_more</span>
                                </summary>
                                <div
                                    class="p-6 pt-0 text-gray-600 dark:text-gray-300 leading-relaxed border-t border-transparent group-open:border-gray-100 dark:group-open:border-gray-700 animate-[fadeIn_0.3s_ease-out]">
                                    <p class="mt-4">Hoàn toàn được! Khóa học được thiết kế từ cơ bản đến nâng cao, phù
                                        hợp cho người mới bắt đầu. Giảng viên sẽ hướng dẫn chi tiết cách sử dụng dụng cụ
                                        và kỹ thuật cơ bản nhất trước khi đi vào thực hành chuyên sâu.</p>
                                </div>
                            </details>
                            <details
                                class="group bg-white dark:bg-[#2a1a1a] rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 open:ring-1 open:ring-primary/50 overflow-hidden transition-all duration-300">
                                <summary
                                    class="flex items-center justify-between p-6 cursor-pointer select-none bg-gray-50/50 dark:bg-[#332222] group-open:bg-white dark:group-open:bg-[#2a1a1a] hover:bg-gray-100 dark:hover:bg-[#3d2b2b] transition-colors">
                                    <span class="font-bold text-lg text-[#181111] dark:text-white">Học phí đã bao gồm
                                        hoa và dụng cụ chưa?</span>
                                    <span
                                        class="material-symbols-outlined transition-transform duration-300 group-open:rotate-180 text-primary bg-primary/10 rounded-full p-1">expand_more</span>
                                </summary>
                                <div
                                    class="p-6 pt-0 text-gray-600 dark:text-gray-300 leading-relaxed border-t border-transparent group-open:border-gray-100 dark:group-open:border-gray-700 animate-[fadeIn_0.3s_ease-out]">
                                    <p class="mt-4">Học phí đã bao gồm toàn bộ hoa tươi cao
                                        cấp, bình hoa gốm sứ và các phụ kiện trang trí thực
                                        hành tại lớp. Bạn chỉ cần mang theo tâm hồn yêu cái đẹp!</p>
                                </div>
                            </details>
                            <details
                                class="group bg-white dark:bg-[#2a1a1a] rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 open:ring-1 open:ring-primary/50 overflow-hidden transition-all duration-300">
                                <summary
                                    class="flex items-center justify-between p-6 cursor-pointer select-none bg-gray-50/50 dark:bg-[#332222] group-open:bg-white dark:group-open:bg-[#2a1a1a] hover:bg-gray-100 dark:hover:bg-[#3d2b2b] transition-colors">
                                    <span class="font-bold text-lg text-[#181111] dark:text-white">Sau khóa học tôi có
                                        được mang sản phẩm về không?</span>
                                    <span
                                        class="material-symbols-outlined transition-transform duration-300 group-open:rotate-180 text-primary bg-primary/10 rounded-full p-1">expand_more</span>
                                </summary>
                                <div
                                    class="p-6 pt-0 text-gray-600 dark:text-gray-300 leading-relaxed border-t border-transparent group-open:border-gray-100 dark:group-open:border-gray-700 animate-[fadeIn_0.3s_ease-out]">
                                    <p class="mt-4">Chắc chắn rồi. Mỗi buổi học bạn sẽ hoàn thiện một tác phẩm và được
                                        hỗ trợ đóng gói cẩn thận để mang về trưng bày tại nhà hoặc làm quà tặng người
                                        thân, đối tác.</p>
                                </div>
                            </details>
                            <details
                                class="group bg-white dark:bg-[#2a1a1a] rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 open:ring-1 open:ring-primary/50 overflow-hidden transition-all duration-300">
                                <summary
                                    class="flex items-center justify-between p-6 cursor-pointer select-none bg-gray-50/50 dark:bg-[#332222] group-open:bg-white dark:group-open:bg-[#2a1a1a] hover:bg-gray-100 dark:hover:bg-[#3d2b2b] transition-colors">
                                    <span class="font-bold text-lg text-[#181111] dark:text-white">Lớp học có bao nhiêu
                                        người?</span>
                                    <span
                                        class="material-symbols-outlined transition-transform duration-300 group-open:rotate-180 text-primary bg-primary/10 rounded-full p-1">expand_more</span>
                                </summary>
                                <div
                                    class="p-6 pt-0 text-gray-600 dark:text-gray-300 leading-relaxed border-t border-transparent group-open:border-gray-100 dark:group-open:border-gray-700 animate-[fadeIn_0.3s_ease-out]">
                                    <p class="mt-4">Để đảm bảo chất lượng, mỗi lớp học chỉ nhận số lượng học viên nhất
                                        định.
                                        Giảng viên và trợ giảng sẽ theo sát từng học viên để hướng dẫn chi tiết.</p>
                                </div>
                            </details>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-wine to-[#5a1c22] rounded-3xl p-8 lg:p-16 text-center text-white relative mb-12 shadow-2xl">
                    <div class="absolute top-0 left-0 w-48 h-48 bg-gold rounded-full blur-[100px] opacity-20"></div>
                    <div class="absolute bottom-0 right-0 w-80 h-80 bg-red-600 rounded-full blur-[120px] opacity-30">
                    </div>
                    <div
                        class="absolute top-10 right-10 text-white/5 text-9xl font-serif font-black select-none pointer-events-none">
                        "</div>
                    <h2 class="text-3xl lg:text-4xl font-black mb-12 relative z-10">Học Viên Nói Gì Về Khóa Học?
                    </h2>
                    <div class="relative z-10">
                        <swiper v-if="course.reviews && course.reviews.length > 0" :modules="modules"
                            :slides-per-view="1" :space-between="30" :loop="true" :autoplay="{
                                delay: 5000,
                                disableOnInteraction: false,
                            }" :breakpoints="{
                                '768': {
                                    slidesPerView: 2,
                                    spaceBetween: 20,
                                },
                                '1024': {
                                    slidesPerView: 3,
                                    spaceBetween: 30,
                                },
                            }" class="pb-12 pt-6 [&_.swiper-wrapper]:!overflow-visible">
                            <swiper-slide v-for="review in course.reviews" :key="review.id" class="h-auto pt-4">
                                <div
                                    class="bg-white text-gray-800 p-8 rounded-2xl shadow-xl flex flex-col items-center hover:-translate-y-2 transition-transform duration-300 h-full">
                                    <div
                                        class="w-20 h-20 rounded-full p-1 bg-gradient-to-br from-primary to-gold mb-6 shrink-0">
                                        <div class="w-full h-full rounded-full bg-gray-200 bg-cover bg-center border-2 border-white"
                                            :style="{ backgroundImage: `url('${review.customer?.avatar ? (review.customer.avatar.startsWith('http') ? review.customer.avatar : 'http://127.0.0.1:8000/storage/' + review.customer.avatar) : 'https://placehold.co/100x100?text=' + review.reviewer_name.charAt(0)}')` }">
                                        </div>
                                    </div>
                                    <div class="flex gap-1 text-gold mb-4 shrink-0">
                                        <span v-for="n in 5" :key="n" class="material-symbols-outlined text-xl"
                                            :class="{ 'filled': n <= review.rating }">
                                            {{ n <= review.rating ? 'star' : 'star_border' }} </span>
                                    </div>
                                    <p class="italic text-gray-600 text-sm mb-6 leading-relaxed text-center grow">
                                        "{{ review.content }}"</p>
                                    <div class="mt-auto text-center shrink-0">
                                        <h4 class="font-bold text-lg text-wine">{{ review.reviewer_name }}</h4>
                                        <!-- <span class="text-xs text-gray-500 uppercase tracking-wide">Học viên khóa K23</span> -->
                                    </div>
                                </div>
                            </swiper-slide>
                        </swiper>
                        <div v-else class="flex justify-center w-full">
                            <div
                                class="bg-white/90 backdrop-blur text-gray-800 dark:text-gray-200 p-8 rounded-2xl flex items-center justify-center max-w-md w-full shadow-lg text-center">
                                <p class="italic">Chưa có đánh giá nào cho khóa học này.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
