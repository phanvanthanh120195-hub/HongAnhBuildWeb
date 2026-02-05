<script setup lang="ts">
const config = useRuntimeConfig();
const page = ref(1);

// Fetch featured blog post (is_featured = true, newest first, limit 1)
const { data: featuredResponse } = await useFetch(`${config.public.apiBase}/api/blogs`, {
    query: {
        featured: true,
        limit: 1
    },
    lazy: true,
    getCachedData: (key, nuxtApp) => nuxtApp.payload.data[key] || nuxtApp.static.data[key]
});

const featuredPost = computed(() => {
    const data = (featuredResponse.value as any)?.data;
    return data && data.length > 0 ? data[0] : null;
});

// Fetch blog posts with pagination
const query = computed(() => ({
    page: page.value,
    limit: 6
}));

const cacheKey = computed(() => `blogs-${JSON.stringify(query.value)}`);

const { data: postsResponse, pending } = useFetch(`${config.public.apiBase}/api/blogs`, {
    query,
    key: cacheKey,
    lazy: true,
    getCachedData: (key, nuxtApp) => nuxtApp.payload.data[key] || nuxtApp.static.data[key]
});

const posts = computed(() => {
    return (postsResponse.value as any)?.data || [];
});

const pagination = computed(() => (postsResponse.value as any)?.meta || {});
const totalPages = computed(() => pagination.value.last_page || 1);

const displayedPages = computed(() => {
    const pages: number[] = [];
    const current = page.value;
    const total = totalPages.value;

    let start = Math.max(1, current - 2);
    let end = Math.min(total, start + 4);

    if (end - start < 4) {
        start = Math.max(1, end - 4);
    }

    for (let i = start; i <= end; i++) {
        pages.push(i);
    }
    return pages;
});

const goToPage = (p: number) => {
    if (p >= 1 && p <= totalPages.value) {
        page.value = p;
    }
};

// Category badge colors - each category gets a different color
const categoryColors: Record<string, string> = {
    'Kiến thức hoa tươi': 'bg-emerald-500 text-white',
    'Xu hướng 2024': 'bg-rose-500 text-white',
    'Mẹo cắm hoa': 'bg-amber-500 text-white',
    'Workshop': 'bg-violet-500 text-white',
    'Ý nghĩa hoa': 'bg-sky-500 text-white',
    'Sự kiện': 'bg-pink-500 text-white',
    'Quà Tết': 'bg-red-600 text-white',
};

const getCategoryClass = (category: string) => {
    return categoryColors[category] || 'bg-primary text-white';
};
</script>

<template>
    <div class="w-full lg:w-[72%] flex flex-col gap-10">
        <!-- Featured Post Section - Only show if featuredPost exists -->
        <div v-if="featuredPost"
            class="group relative flex flex-col md:flex-row bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-[#3a2828] hover:shadow-lg transition-all duration-300">
            <div class="md:w-3/5 relative overflow-hidden h-64 md:h-auto">
                <div class="w-full h-full bg-cover bg-center group-hover:scale-105 transition-transform duration-700"
                    :style="{ backgroundImage: `url('${featuredPost.thumbnail}')` }">
                </div>
                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors">
                </div>
                <span
                    class="absolute top-4 left-4 bg-primary text-white text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">Nổi
                    bật</span>
            </div>
            <div class="md:w-2/5 p-6 md:p-8 flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    <span class="text-xs font-bold text-amber-600 uppercase tracking-widest">{{ featuredPost.category
                    }}</span>
                </div>
                <h2
                    class="text-2xl font-bold text-[#181111] dark:text-white mb-4 leading-tight group-hover:text-primary transition-colors">
                    <NuxtLink :to="`/blog/${featuredPost.slug}`">{{ featuredPost.title }}</NuxtLink>
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 line-clamp-3 leading-relaxed">
                    {{ featuredPost.excerpt }}
                </p>
                <div
                    class="mt-auto flex items-center justify-between pt-4 border-t border-gray-50 dark:border-[#2a1a1a]">
                    <span class="text-xs text-gray-400 font-medium">{{ featuredPost.published_at }}</span>
                    <NuxtLink :to="`/blog/${featuredPost.slug}`"
                        class="text-sm font-bold text-primary hover:text-[#b00e0e] flex items-center gap-1 transition-colors group/btn">
                        Đọc thêm <span
                            class="material-symbols-outlined text-base group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                    </NuxtLink>
                </div>
            </div>
        </div>
        <div>
            <div class="flex items-center gap-3 mb-6">
                <h3 class="text-xl font-bold text-[#181111] dark:text-white">Bài viết mới nhất</h3>
                <div class="h-px flex-1 bg-gray-100 dark:bg-[#3a2828]"></div>
            </div>
            <div v-if="posts.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <article v-for="post in posts" :key="post.id" class="flex flex-col group h-full bg-transparent">
                    <div
                        class="relative aspect-[4/3] rounded-lg overflow-hidden mb-4 border border-gray-100 dark:border-[#3a2828] shadow-sm">
                        <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500"
                            :style="{ backgroundImage: `url('${post.thumbnail}')` }">
                        </div>
                        <div
                            :class="[getCategoryClass(post.category), 'absolute top-3 left-3 backdrop-blur-sm px-2.5 py-1 rounded text-[10px] font-bold uppercase tracking-wider shadow-sm']">
                            {{ post.category }}
                        </div>
                    </div>
                    <div class="flex flex-col flex-1">
                        <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                            <span>{{ post.published_at }}</span>
                        </div>
                        <h4
                            class="text-lg font-bold text-[#181111] dark:text-white mb-2 leading-snug group-hover:text-primary transition-colors line-clamp-2">
                            <NuxtLink :to="`/blog/${post.slug}`">{{ post.title }}</NuxtLink>
                        </h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
                            {{ post.excerpt }}
                        </p>
                        <NuxtLink :to="`/blog/${post.slug}`"
                            class="mt-auto self-start text-xs font-bold text-[#181111] dark:text-white border-b-2 border-primary/20 hover:border-primary transition-all pb-0.5">
                            Đọc thêm
                        </NuxtLink>
                    </div>
                </article>
            </div>
            <div v-else class="text-center py-12 text-gray-500">
                Hiện chưa có bài viết nào.
            </div>
        </div>
        <div v-if="totalPages > 1" class="flex justify-center mt-6 gap-2">
            <button @click="goToPage(page - 1)" :disabled="page === 1"
                class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="material-symbols-outlined text-sm">chevron_left</span>
            </button>
            <button v-for="p in displayedPages" :key="p" @click="goToPage(p)"
                :class="[p === page ? 'bg-primary text-white font-bold shadow-md shadow-primary/30' : 'border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary', 'w-9 h-9 flex items-center justify-center rounded-lg transition-all']">
                {{ p }}
            </button>
            <button @click="goToPage(page + 1)" :disabled="page === totalPages"
                class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="material-symbols-outlined text-sm">chevron_right</span>
            </button>
        </div>
    </div>
</template>
