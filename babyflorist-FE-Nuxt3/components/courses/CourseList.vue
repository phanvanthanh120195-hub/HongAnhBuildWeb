<script setup lang="ts">
const config = useRuntimeConfig()

interface Course {
    id: number
    name: string
    description: string
    price: number
    sale_price: number | null
    thumbnail: string | null
    slug: string
    label: string | null
    [key: string]: any
}

interface CourseResponse {
    success: boolean
    data: Course[]
}

const props = defineProps<{
    filters?: {
        categories: number[]
        levels: string[]
        prices: string[]
    }
}>()

const queryParams = computed(() => {
    const params: any = { format: 'course' }
    if (props.filters?.categories?.length) {
        params.categories = props.filters.categories.join(',')
    }
    if (props.filters?.levels?.length) {
        params.levels = props.filters.levels.join(',')
    }
    if (props.filters?.prices?.length) {
        params.price_ranges = props.filters.prices.join(',')
    }
    return params
})

const cacheKey = computed(() => `courses-${JSON.stringify(queryParams.value)}`)

// Non-blocking fetch - page renders immediately, data loads in background
const { data: response, pending } = useFetch<CourseResponse>(`${config.public.apiBase}/api/courses`, {
    query: queryParams,
    key: cacheKey,
    lazy: true,
    getCachedData: (key, nuxtApp) => nuxtApp.payload.data[key] || nuxtApp.static.data[key]
})

const formatPrice = (price: number) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price)
}

const sortBy = ref('Mới nhất')
const currentPage = ref(1)
const itemsPerPage = 6

watch(sortBy, () => {
    currentPage.value = 1
})

watch(() => props.filters, () => {
    currentPage.value = 1
}, { deep: true })

const getLabelClass = (label: string | null) => {
    if (label === 'basic') return 'bg-purple-100 text-purple-700'
    if (label === 'advanced') return 'bg-orange-100 text-orange-800'
    return 'bg-red-100 text-primary'
}

const filteredAndSortedCourses = computed(() => {
    if (!response.value?.success) return []
    let items = [...response.value.data]

    // Sorting
    items.sort((a: any, b: any) => {
        if (sortBy.value === 'Phổ biến nhất') {
            const countA = a.enrollments_count || a.student_count || 0
            const countB = b.enrollments_count || b.student_count || 0
            return countB - countA
        }
        if (sortBy.value === 'Giá: Thấp đến Cao') {
            const priceA = a.sale_price || a.price
            const priceB = b.sale_price || b.price
            return priceA - priceB
        }
        if (sortBy.value === 'Giá: Cao đến Thấp') {
            const priceA = a.sale_price || a.price
            const priceB = b.sale_price || b.price
            return priceB - priceA
        }
        // Default: Mới nhất
        return new Date(b.created_at).getTime() - new Date(a.created_at).getTime()
    })

    return items.map((course: any) => ({
        id: course.id,
        title: course.name,
        description: course.description || 'Khóa học cắm hoa chuyên nghiệp...',
        originalPrice: course.sale_price ? formatPrice(course.price) : null,
        price: course.sale_price ? formatPrice(course.sale_price) : formatPrice(course.price),
        image: course.thumbnail ? (course.thumbnail.startsWith('http') ? course.thumbnail : `${config.public.apiBase}/storage/${course.thumbnail}`) : 'https://placehold.co/600x400',
        label: course.label,
        tagClass: getLabelClass(course.label),
        slug: course.slug
    }))
})

const totalPages = computed(() => Math.ceil(filteredAndSortedCourses.value.length / itemsPerPage))

const paginatedCourses = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage
    const end = start + itemsPerPage
    return filteredAndSortedCourses.value.slice(start, end)
})

const displayedPages = computed(() => {
    const delta = 2
    const range = []
    for (let i = Math.max(2, currentPage.value - delta); i <= Math.min(totalPages.value - 1, currentPage.value + delta); i++) {
        range.push(i)
    }

    if (currentPage.value - delta > 2) {
        range.unshift('...')
    }
    if (currentPage.value + delta < totalPages.value - 1) {
        range.push('...')
    }

    range.unshift(1)
    if (totalPages.value > 1) {
        range.push(totalPages.value)
    }

    return range
})
</script>

<template>
    <div class="flex-1">
        <div
            class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4 bg-white dark:bg-[#1a0f0f] p-4 rounded-lg border border-gray-100 dark:border-[#3a2828] shadow-sm">
            <p class="text-base text-gray-500">Hiển thị <span class="font-bold text-[#181111] dark:text-white">{{
                filteredAndSortedCourses.length }}</span> khóa học phù hợp</p>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500 whitespace-nowrap">Sắp xếp theo:</span>
                <select v-model="sortBy"
                    class="form-select bg-gray-50 dark:bg-[#2a1a1a] border-gray-200 dark:border-[#3a2828] rounded-lg text-sm focus:ring-primary focus:border-primary py-2 pl-3 pr-10 cursor-pointer outline-none">
                    <option>Mới nhất</option>
                    <option>Giá: Thấp đến Cao</option>
                    <option>Giá: Cao đến Thấp</option>
                </select>
            </div>
        </div>

        <!-- Skeleton Loading -->
        <div v-if="pending" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="i in 6" :key="i"
                class="bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden border border-gray-100 dark:border-[#3a2828] animate-pulse">
                <div class="aspect-[4/3] bg-gray-200 dark:bg-gray-700"></div>
                <div class="p-5">
                    <div class="h-5 bg-gray-200 dark:bg-gray-700 rounded w-3/4 mb-3"></div>
                    <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-full mb-2"></div>
                    <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-2/3 mb-4"></div>
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-between">
                        <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded w-24"></div>
                        <div class="h-8 bg-gray-200 dark:bg-gray-700 rounded w-20"></div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="paginatedCourses.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="course in paginatedCourses" :key="course.id"
                class="group flex flex-col bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-[#3a2828] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="relative aspect-[4/3] overflow-hidden">
                    <div class="w-full h-full bg-cover bg-center transition-transform duration-700"
                        :style="{ backgroundImage: `url('${course.image}')` }"></div>
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                    <span
                        :class="[course.tagClass, 'absolute top-3 left-3 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm']">{{
                            course.label }}</span>
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <h3
                        class="text-lg font-bold text-[#181111] dark:text-white mb-2 leading-tight group-hover:text-primary transition-colors">
                        {{ course.title }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">{{
                        course.description }}</p>
                    <div
                        class="mt-auto pt-4 border-t border-gray-50 dark:border-[#2a1a1a] flex items-center justify-between">
                        <div class="flex flex-col">
                            <span v-if="course.originalPrice" class="text-sm text-gray-400 line-through">{{
                                course.originalPrice }}</span>
                            <span class="text-lg font-bold text-primary">{{ course.price }}</span>
                        </div>
                        <NuxtLink :to="`/courses/${course.slug}`"
                            class="text-xs font-bold bg-[#181111] dark:bg-white text-white dark:text-[#181111] px-4 py-2.5 rounded-lg hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all shadow-md hover:shadow-lg">
                            Đăng
                            ký ngay</NuxtLink>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="text-center py-12 text-gray-500">
            Hiện chưa có khóa học nào.
        </div>

        <!-- Pagination -->
        <div v-if="totalPages > 1" class="flex justify-center mt-12 gap-2">
            <button @click="currentPage--" :disabled="currentPage === 1"
                class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="material-symbols-outlined text-base">chevron_left</span>
            </button>

            <template v-for="page in displayedPages" :key="page">
                <button v-if="page === '...'" disabled
                    class="w-10 h-10 flex items-center justify-center text-gray-400">...</button>
                <button v-else @click="currentPage = Number(page)" :class="[
                    'w-10 h-10 flex items-center justify-center rounded-lg transition-all',
                    currentPage === page
                        ? 'bg-primary text-white font-bold shadow-md shadow-red-200 dark:shadow-none hover:bg-red-700'
                        : 'border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary'
                ]">
                    {{ page }}
                </button>
            </template>

            <button @click="currentPage++" :disabled="currentPage === totalPages"
                class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="material-symbols-outlined text-base">chevron_right</span>
            </button>
        </div>
    </div>
</template>
