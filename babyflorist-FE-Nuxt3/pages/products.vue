<script setup lang="ts">
import ProductFilters from '~/components/products/ProductFilters.vue'
import ProductList from '~/components/products/ProductList.vue'

const filters = ref({
    categories: [] as number[],
    labels: [] as string[],
    priceRange: [] as string[]
});

const handleFilterChange = (newFilters: any) => {
    filters.value = newFilters;
}
</script>

<template>
    <div class="layout-container flex h-full grow flex-col">
        <main class="site-container px-4 py-8 flex flex-col flex-1">
            <div
                class="relative w-full rounded-2xl overflow-hidden bg-[#fbf5f5] dark:bg-[#2a1a1a] mb-10 shadow-sm border border-[#f4f0f0] dark:border-[#3a2828]">
                <div class="absolute inset-0 opacity-30"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDi6tu_PFakN_PMcVOPdSmhxAjsPDOLNhl5uWgTTXPDKNkJc-jJUWxQGTguI4wDmSW-RUWu6DsPM4Uz1YleOeWbxg9mvcmRpI8rAevEO_mVVUMCeI3SSs6nimydGbMi--7CDdL-Lv0oWsWs6JgdoCDRfHNk8DrQOM9zfIUnrXZU9WeH6lUwjYZq4sp5QWsr5pe9lt28bCb26rI5dvj9QAV2JVNHLkzt-ow5R2Gb5V4nTAp7yWMW34lF8e0EidXxeQHMfCqwlyAHOt8'); background-size: cover; background-position: center;">
                </div>
                <div class="relative z-10 px-6 py-12 md:py-16 text-center max-w-3xl mx-auto">
                    <h1 class="text-3xl md:text-5xl font-black text-[#181111] dark:text-white mb-4 tracking-tight">
                        Sản Phẩm Tết Nghệ Thuật</h1>
                    <div class="flex items-center justify-center gap-4 mb-4">
                        <div class="h-px w-12 bg-primary/40"></div>
                        <span class="material-symbols-outlined text-primary text-2xl">local_florist</span>
                        <div class="h-px w-12 bg-primary/40"></div>
                    </div>
                    <p class="text-[#896161] dark:text-[#d4b0b0] text-lg font-medium">
                        Khám phá bộ sưu tập quà tặng và hoa nghệ thuật độc đáo, mang đậm bản sắc truyền thống và hơi
                        thở hiện đại cho mùa Tết đoàn viên.
                    </p>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row gap-8">
                <ProductFilters @change="handleFilterChange" />
                <ProductList :filters="filters" />
            </div>
        </main>
    </div>
</template>
