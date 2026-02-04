<script setup lang="ts">
const topics = [
    'Giỏ quà Tết',
    'Lẵng hoa khai xuân',
    'Bình hoa gốm'
]

const categories = [
    'Cao cấp',
    'Phổ thông'
]

const prices = [
    'Dưới 500k',
    '500k - 1 triệu',
    'Trên 1 triệu'
]
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
                    <label v-for="topic in topics" :key="topic"
                        class="flex items-center gap-3 cursor-pointer group select-none">
                        <input
                            class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                            type="checkbox" />
                        <span
                            class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">{{
                            topic }}</span>
                    </label>
                </div>
            </div>
            <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>
            <div>
                <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">
                    Phân loại</h4>
                <div class="space-y-3">
                    <label v-for="category in categories" :key="category"
                        class="flex items-center gap-3 cursor-pointer group select-none">
                        <input
                            class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                            type="checkbox" />
                        <span
                            class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">{{
                            category }}</span>
                    </label>
                </div>
            </div>
            <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>
            <div>
                <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">
                    Khoảng giá</h4>
                <div class="space-y-3">
                    <label v-for="price in prices" :key="price"
                        class="flex items-center gap-3 cursor-pointer group select-none">
                        <input
                            class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                            type="checkbox" />
                        <span
                            class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">{{
                            price }}</span>
                    </label>
                </div>
            </div>
            <button
                class="w-full bg-[#221010] text-white py-3 rounded-lg font-bold text-sm hover:bg-primary transition-colors mt-4">
                Áp dụng bộ lọc
            </button>
        </div>
    </aside>
</template>
