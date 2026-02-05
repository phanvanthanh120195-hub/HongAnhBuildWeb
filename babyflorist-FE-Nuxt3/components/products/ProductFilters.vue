<script setup lang="ts">
import { reactive, watch } from 'vue'; // Added reactive and watch imports
const config = useRuntimeConfig();
const emit = defineEmits(['change']);

const { data: categoriesResponse } = await useFetch('/api/categories', {
    baseURL: config.public.apiBase,
});

const topics = computed(() => {
    return (categoriesResponse.value as any)?.data?.map((item: any) => ({
        id: item.id,
        name: item.name,
        slug: item.slug
    })) || [];
});

const categories = [
    { id: 'new', name: 'Mới' },
    { id: 'sale', name: 'Giảm giá' },
    { id: 'hot', name: 'Bán chạy' }
]

const prices = [
    { id: 'under_500', name: 'Dưới 500k', value: '0-500000' },
    { id: '500_1000', name: '500k - 1 triệu', value: '500000-1000000' },
    { id: 'over_1000', name: 'Trên 1 triệu', value: '1000000-99999999' }
]

const selected = reactive({
    categories: [] as number[],
    labels: [] as string[],
    priceRange: [] as string[]
});

const applyFilters = () => {
    emit('change', { ...selected });
}
</script>

<template>
    <aside class="w-full lg:w-72 flex-shrink-0">
        <div
            class="sticky top-24 space-y-6 bg-white dark:bg-[#1a0f0f] p-6 rounded-xl border border-gray-100 dark:border-[#3a2828] shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-lg flex items-center gap-2 text-[#181111] dark:text-white">
                    <span class="material-symbols-outlined text-primary">filter_list</span> Bộ lọc sản phẩm
                </h3>
            </div>
            <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>
            <div>
                <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">
                    Chủ đề</h4>
                <div class="space-y-3">
                    <label v-for="topic in topics" :key="topic.id"
                        class="flex items-center gap-3 cursor-pointer group select-none">
                        <input
                            class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                            type="checkbox" :value="topic.id" v-model="selected.categories" />
                        <span
                            class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">{{
                                topic.name }}</span>
                    </label>
                </div>
            </div>
            <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>
            <div>
                <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">
                    Phân loại</h4>
                <div class="space-y-3">
                    <label v-for="category in categories" :key="category.id"
                        class="flex items-center gap-3 cursor-pointer group select-none">
                        <input
                            class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                            type="checkbox" :value="category.id" v-model="selected.labels" />
                        <span
                            class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">{{
                                category.name }}</span>
                    </label>
                </div>
            </div>
            <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>
            <div>
                <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">
                    Khoảng giá</h4>
                <div class="space-y-3">
                    <label v-for="price in prices" :key="price.id"
                        class="flex items-center gap-3 cursor-pointer group select-none">
                        <input
                            class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                            type="checkbox" :value="price.value" v-model="selected.priceRange" />
                        <span
                            class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">{{
                                price.name }}</span>
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
