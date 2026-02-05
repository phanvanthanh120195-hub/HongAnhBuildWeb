<script setup lang="ts">
const props = defineProps(['filters']);
const config = useRuntimeConfig();
const page = ref(1);
const sortBy = ref('Mới nhất');

const sortMap: Record<string, string> = {
    'Mới nhất': 'newest',
    'Giá: Thấp đến Cao': 'price_asc',
    'Giá: Cao đến Thấp': 'price_desc'
};

const query = computed(() => ({
    page: page.value,
    limit: 6,
    sort_by: sortMap[sortBy.value] || 'newest',
    ...(props.filters?.categories?.length ? { 'category_ids': props.filters.categories.join(',') } : {}),
    ...(props.filters?.labels?.length ? { 'labels': props.filters.labels.join(',') } : {}),
    ...(props.filters?.priceRange?.length ? { 'price_range': props.filters.priceRange.join(',') } : {})
}));

const cacheKey = computed(() => `products-${JSON.stringify(query.value)}`);

watch(sortBy, () => {
    page.value = 1;
});

// Non-blocking fetch with caching for smooth tab switching
const { data: response, pending, refresh } = useFetch(`${config.public.apiBase}/api/products`, {
    query,
    key: cacheKey,
    lazy: true,
    getCachedData: (key, nuxtApp) => nuxtApp.payload.data[key] || nuxtApp.static.data[key]
});

const products = computed(() => {
    const data = (response.value as any)?.data;
    return data?.map((item: any) => {
        return {
            id: item.id,
            title: item.name,
            description: item.description,
            originalPrice: formatPrice(item.price),
            price: formatPrice(item.sale_price || item.price),
            image: getImageUrl(item.thumbnail),
            tag: getTagLabel(item.label),
            tagClass: getTagClass(item.label),
            hasDiscount: !!item.sale_price && item.sale_price < item.price
        }
    }) || [];
});

const pagination = computed(() => (response.value as any)?.meta || {});
const totalPages = computed(() => pagination.value.last_page || 1);

const displayedPages = computed(() => {
    const delta = 2
    const range = []
    const current = page.value
    const total = totalPages.value

    for (let i = Math.max(2, current - delta); i <= Math.min(total - 1, current + delta); i++) {
        range.push(i)
    }

    if (current - delta > 2) {
        range.unshift('...')
    }
    if (current + delta < total - 1) {
        range.push('...')
    }

    range.unshift(1)
    if (total > 1) {
        range.push(total)
    }

    return range
})

function formatPrice(value: number) {
    if (!value) return '0đ';
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
}

function getImageUrl(path: string) {
    if (!path) return '';
    if (path.startsWith('http')) return path;
    return `${config.public.apiBase}/storage/${path}`;
}

function getTagLabel(label: string) {
    const map: Record<string, string> = {
        'new': 'Mới',
        'sale': 'Giảm giá',
        'hot': 'Bán chạy',
        'best_seller': 'Bán chạy'
    };
    return map[label] || 'Mới';
}

function getTagClass(label: string) {
    const map: Record<string, string> = {
        'new': 'bg-yellow-100 text-yellow-700',
        'sale': 'bg-orange-100 text-orange-800',
        'hot': 'bg-red-100 text-primary',
        'best_seller': 'bg-red-100 text-primary'
    };
    return map[label] || 'bg-green-100 text-green-700';
}
</script>

<template>
    <div class="flex-1">
        <div
            class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4 bg-white dark:bg-[#1a0f0f] p-4 rounded-lg border border-gray-100 dark:border-[#3a2828] shadow-sm">
            <p class="text-base text-gray-500">Hiển thị <span class="font-bold text-[#181111] dark:text-white">{{
                pagination.total || 0 }}</span> sản phẩm phù hợp</p>
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

        <div v-if="products.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="product in products" :key="product.id"
                class="group flex flex-col bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-[#3a2828] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="relative aspect-[4/3] overflow-hidden">
                    <div class="w-full h-full bg-cover bg-center transition-transform duration-700"
                        :style="{ backgroundImage: `url('${product.image}')` }"></div>
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                    <span
                        :class="[product.tagClass, 'absolute top-3 left-3 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm']">{{
                            product.tag }}</span>
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <h3
                        class="text-lg font-bold text-[#181111] dark:text-white mb-2 leading-tight group-hover:text-primary transition-colors">
                        {{ product.title }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">{{
                        product.description }}</p>
                    <div
                        class="mt-auto pt-4 border-t border-gray-50 dark:border-[#2a1a1a] flex items-center justify-between">
                        <div v-if="product.hasDiscount" class="flex flex-col">
                            <span class="text-xs text-gray-400 line-through">{{ product.originalPrice }}</span>
                            <span class="text-lg font-bold text-primary">{{ product.price }}</span>
                        </div>
                        <span v-else class="text-lg font-bold text-primary">{{ product.price }}</span>
                        <button
                            class="flex items-center gap-1 text-xs font-bold bg-[#181111] dark:bg-white text-white dark:text-[#181111] px-4 py-2.5 rounded-lg hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all shadow-md hover:shadow-lg">
                            Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="text-center py-12 text-gray-500">
            Hiện chưa có sản phẩm nào.
        </div>

        <div v-if="totalPages > 1" class="flex justify-center mt-12 gap-2">
            <button @click="page--" :disabled="page === 1"
                class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="material-symbols-outlined text-base">chevron_left</span>
            </button>

            <template v-for="p in displayedPages" :key="p">
                <button v-if="p === '...'" disabled
                    class="w-10 h-10 flex items-center justify-center text-gray-400">...</button>
                <button v-else @click="page = Number(p)" :class="[
                    'w-10 h-10 flex items-center justify-center rounded-lg transition-all',
                    page === p
                        ? 'bg-primary text-white font-bold shadow-md shadow-red-200 dark:shadow-none hover:bg-red-700'
                        : 'border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary'
                ]">
                    {{ p }}
                </button>
            </template>

            <button @click="page++" :disabled="page === totalPages"
                class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="material-symbols-outlined text-base">chevron_right</span>
            </button>
        </div>
    </div>
</template>
