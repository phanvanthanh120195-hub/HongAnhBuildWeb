<script setup lang="ts">
const config = useRuntimeConfig()
const emit = defineEmits(['apply'])

interface Category {
    id: number
    name: string
    slug: string
}

// Fetch categories from API with caching
const { data: categoryResponse } = await useFetch<{ success: boolean, data: Category[] }>(`${config.public.apiBase}/api/course-categories`, {
    key: 'course-categories',
    getCachedData: (key, nuxtApp) => nuxtApp.payload.data[key] || nuxtApp.static.data[key]
})
const categories = computed(() => categoryResponse.value?.data || [])

const levels = [
    'Cơ bản',
    'Nâng cao'
]

const prices = [
    { label: 'Dưới 500k', value: 'under-500k' },
    { label: '500k - 1 triệu', value: '500k-1m' },
    { label: 'Trên 1 triệu', value: 'above-1m' }
]

const selectedCategories = ref<number[]>([])
const selectedLevels = ref<string[]>([])
const selectedPrices = ref<string[]>([])

const applyFilters = () => {
    emit('apply', {
        categories: selectedCategories.value,
        levels: selectedLevels.value,
        prices: selectedPrices.value
    })
}
</script>

<template>
    <aside class="w-full lg:w-72 flex-shrink-0">
        <div
            class="sticky top-24 space-y-6 bg-white dark:bg-[#1a0f0f] p-6 rounded-xl border border-gray-100 dark:border-[#3a2828] shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-lg flex items-center gap-2 text-[#181111] dark:text-white">
                    <span class="material-symbols-outlined text-primary">filter_list</span> Bộ lọc tìm kiếm
                </h3>
            </div>
            <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>

            <!-- Categories -->
            <div>
                <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">DANH MỤC</h4>
                <div class="space-y-3">
                    <label v-for="category in categories" :key="category.id"
                        class="flex items-center gap-3 cursor-pointer group select-none">
                        <input v-model="selectedCategories" :value="category.id"
                            class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                            type="checkbox" />
                        <span
                            class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">{{
                                category.name }}</span>
                    </label>
                </div>
            </div>

            <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>

            <!-- Levels -->
            <div>
                <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">Cấp độ</h4>
                <div class="space-y-3">
                    <label v-for="level in levels" :key="level"
                        class="flex items-center gap-3 cursor-pointer group select-none">
                        <input v-model="selectedLevels" :value="level"
                            class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                            type="checkbox" />
                        <span
                            class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">{{
                                level }}</span>
                    </label>
                </div>
            </div>

            <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>

            <!-- Prices -->
            <div>
                <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">Khoảng giá
                </h4>
                <div class="space-y-3">
                    <label v-for="price in prices" :key="price.value"
                        class="flex items-center gap-3 cursor-pointer group select-none">
                        <input v-model="selectedPrices" :value="price.value"
                            class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                            type="checkbox" />
                        <span
                            class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">{{
                                price.label }}</span>
                    </label>
                </div>
            </div>

            <button @click="applyFilters"
                class="w-full bg-[#221010] text-white py-3 rounded-lg font-bold text-sm hover:bg-primary transition-colors mt-4">
                Áp dụng bộ lọc
            </button>
        </div>
    </aside>
</template>
