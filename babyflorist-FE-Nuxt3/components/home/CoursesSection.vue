<script setup>
const config = useRuntimeConfig();

const { data: response } = useFetch('/api/courses', {
    baseURL: config.public.apiBase,
    lazy: true,
    query: {
        limit: 3,
        format: 'course',
        featured_priority: 1
    }
});

const courses = computed(() => {
    return response.value?.data || [];
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
};

const getImageUrl = (path) => {
    if (!path) return '';
    if (path.startsWith('http')) return path;
    // Assuming Laravel storage link
    return `${config.public.apiBase}/storage/${path}`;
};

const getLabelClass = (label) => {
    if (!label) return 'bg-yellow-100 text-yellow-700';
    const l = label.toLowerCase();

    if (l === 'hot') return 'bg-red-100 text-[#722F37]'; // Primary color used in text-primary is typically #722F37 based on previous context, or just use text-primary if it's a utility class. User said 'text-primary' for Hot.
    if (l === 'nâng cao') return 'bg-blue-100 text-blue-800';
    if (l === 'new' || l === 'mới') return 'bg-green-100 text-green-700';
    if (l === 'cơ bản') return 'bg-purple-100 text-purple-700';

    return 'bg-yellow-100 text-yellow-700';
};
</script>

<template>
    <section class="bg-white py-24">
        <div class="max-w-[1400px] mx-auto px-6 md:px-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-4xl font-black text-[#722F37]">Khóa Học</h2>
                    <p class="text-gray-500 mt-2 text-lg">Học viên thực hành trực tiếp dưới sự hướng dẫn tỉ mỉ
                    </p>
                </div>
                <a class="text-primary font-bold flex items-center gap-2 group" href="#">
                    <span class="group-hover:underline">Xem tất cả khóa học</span> <span
                        class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <!-- Loading State -->
            <div v-if="!courses.length" class="text-center py-10 text-gray-400">
                Đang tải hoặc chưa có khóa học nào...
            </div>

            <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div v-for="course in courses" :key="course.id" class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-3xl mb-6">
                        <div class="aspect-[4/3] bg-center bg-cover transition-transform duration-700 group-hover:scale-110"
                            :style="{ backgroundImage: `url('${getImageUrl(course.thumbnail)}')` }">
                        </div>
                        <span v-if="course.label"
                            :class="['absolute top-3 left-3 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm', getLabelClass(course.label)]">
                            {{ course.label }}
                        </span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-3 text-gray-400 text-sm font-medium">
                            <span v-if="course.type" class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">calendar_today</span>
                                {{ course.type }}
                            </span>
                            <span v-if="course.lesson_count" class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">schedule</span>
                                {{ course.lesson_count }} bài học
                            </span>
                        </div>
                        <h3 class="text-2xl font-black group-hover:text-primary transition-colors">
                            {{ course.name }}
                        </h3>
                        <p class="text-gray-500 line-clamp-2">
                            {{ course.description }}
                        </p>

                        <!-- Price Section -->
                        <div class="flex mt-3 gap-3 flex-col">
                            <!-- Discount Case -->
                            <div v-if="course.sale_price && course.sale_price < course.price"
                                class="flex items-center gap-2">
                                <span class="text-gray-400 text-lg line-through">{{ formatPrice(course.price) }}</span>
                                <span v-if="course.discount_percent"
                                    class="text-xs font-bold text-white bg-primary px-2 py-1 rounded mb-1">
                                    -{{ course.discount_percent }}%
                                </span>
                                <span v-else class="text-xs font-bold text-white bg-primary px-2 py-1 rounded mb-1">
                                    Giảm giá
                                </span>
                            </div>
                            <!-- Final Price -->
                            <span class="text-2xl font-black text-primary">
                                {{ formatPrice(course.sale_price && course.sale_price < course.price ? course.sale_price
                                    : course.price) }} </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
