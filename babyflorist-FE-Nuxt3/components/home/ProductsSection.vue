<script setup>
const config = useRuntimeConfig();

const { data: response } = useFetch('/api/products', {
    baseURL: config.public.apiBase,
    lazy: true,
    key: 'home-products-featured',
    getCachedData: (key, nuxtApp) => nuxtApp.payload.data[key] || nuxtApp.static.data[key],
    query: {
        limit: 4,
        featured_priority: 1
    }
});

const products = computed(() => {
    return response.value?.data || [];
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
};

const getImageUrl = (path) => {
    if (!path) return '';
    if (path.startsWith('http')) return path;
    return `${config.public.apiBase}/storage/${path}`;
};

const getLabelClass = (label) => {
    if (!label) return 'bg-yellow-100 text-yellow-700';
    const l = label.toLowerCase();

    if (l === 'sale') return 'bg-purple-100 text-purple-700';
    if (l === 'hot') return 'bg-red-100 text-[#722F37]';
    if (l === 'new' || l === 'mới') return 'bg-green-100 text-green-700';

    return 'bg-yellow-100 text-yellow-700';
};
</script>

<template>
    <section class="bg-off-white py-24 border-y border-gray-100">
        <div class="max-w-[1400px] mx-auto px-6 md:px-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-4xl font-black text-primary">Sản Phẩm Nổi Bật</h2>
                    <p class="text-gray-500 mt-2 text-lg">Quà tặng hoa nghệ thuật thiết kế riêng cho dịp Tết</p>
                </div>
                <a class="text-primary font-bold flex items-center gap-2 group" href="#">
                    <span class="group-hover:underline">Xem tất cả sản phẩm</span> <span
                        class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <!-- Loading State -->
            <div v-if="!products.length" class="text-center py-10 text-gray-400">
                Đang tải hoặc chưa có sản phẩm nào nổi bật...
            </div>

            <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div v-for="product in products" :key="product.id" class="group cursor-pointer">
                    <div
                        class="aspect-square relative overflow-hidden rounded-2xl mb-4 bg-gray-100 shadow-sm transition-all group-hover:shadow-xl">
                        <div class="w-full h-full bg-center bg-cover transition-transform duration-700 group-hover:scale-110"
                            :style="{ backgroundImage: `url('${getImageUrl(product.thumbnail)}')` }">
                        </div>
                        <span v-if="product.label"
                            :class="['absolute top-3 left-3 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm', getLabelClass(product.label)]">
                            {{ product.label }}
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-[#181111] mb-1 group-hover:text-primary transition-colors">
                        {{ product.name }}
                    </h3>

                    <!-- Price Section -->
                    <div class="flex mt-3 flex-col">
                        <!-- Discount Case -->
                        <div v-if="product.sale_price && product.sale_price < product.price"
                            class="flex items-center gap-2">
                            <span class="text-gray-400 text-sm line-through">{{ formatPrice(product.price) }}</span>
                            <span v-if="product.discount_percent"
                                class="text-[12px] font-bold text-white bg-primary px-2 py-1 rounded mb-1">
                                -{{ product.discount_percent }}%
                            </span>
                            <span v-else class="text-[12px] font-bold text-white bg-primary px-2 py-1 rounded mb-1">
                                Sale
                            </span>
                        </div>
                        <!-- Final Price -->
                        <p class="text-primary font-bold text-lg">
                            {{ formatPrice(product.sale_price && product.sale_price < product.price ? product.sale_price
                                : product.price) }} </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
