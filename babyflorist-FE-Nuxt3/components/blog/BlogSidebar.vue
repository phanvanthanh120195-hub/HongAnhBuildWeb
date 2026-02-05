<script setup lang="ts">
const config = useRuntimeConfig();

interface Category {
    id: number;
    name: string;
    slug: string;
    count: number;
}

interface Post {
    id: number;
    title: string;
    slug: string;
    thumbnail: string;
    category: string;
    published_at: string;
}

// Fetch blog categories
const { data: categoriesResponse } = await useFetch(`${config.public.apiBase}/api/blog-categories`, {
    lazy: true,
    getCachedData: (key, nuxtApp) => nuxtApp.payload.data[key] || nuxtApp.static.data[key]
});

const categories = computed<Category[]>(() => (categoriesResponse.value as any)?.data || []);

// Fetch featured posts (limit 3, newest first)
const { data: featuredResponse } = await useFetch(`${config.public.apiBase}/api/blogs`, {
    query: {
        featured: true,
        limit: 3
    },
    lazy: true,
    getCachedData: (key, nuxtApp) => nuxtApp.payload.data[key] || nuxtApp.static.data[key]
});

const featuredPosts = computed<Post[]>(() => (featuredResponse.value as any)?.data || []);
</script>

<template>
    <aside class="w-full lg:w-[28%] flex-shrink-0 space-y-8">
        <div class="bg-white dark:bg-[#1a0f0f] p-6 rounded-xl border border-gray-100 dark:border-[#3a2828] shadow-sm">
            <h4
                class="font-bold text-base text-[#181111] dark:text-white mb-5 pb-2 border-b border-gray-100 dark:border-[#3a2828]">
                Danh mục
            </h4>
            <ul class="space-y-3">
                <li v-for="category in categories" :key="category.id">
                    <NuxtLink :to="`/blog/category/${category.slug}`" class="flex items-center justify-between group">
                        <span
                            class="text-sm text-gray-600 dark:text-gray-300 group-hover:text-primary transition-colors">{{
                                category.name }}</span>
                        <span
                            class="text-[10px] font-bold bg-gray-100 dark:bg-[#2a1a1a] text-gray-500 px-2 py-0.5 rounded-full group-hover:bg-primary/10 group-hover:text-primary transition-colors">{{
                                category.count.toString().padStart(2, '0') }}</span>
                    </NuxtLink>
                </li>
                <li v-if="categories.length === 0" class="text-sm text-gray-500 italic">
                    Chưa có danh mục nào.
                </li>
            </ul>
        </div>
        <div class="bg-white dark:bg-[#1a0f0f] p-6 rounded-xl border border-gray-100 dark:border-[#3a2828] shadow-sm">
            <h4
                class="font-bold text-base uppercase tracking-wider text-[#181111] dark:text-white mb-5 pb-2 border-b border-gray-100 dark:border-[#3a2828] flex items-center gap-2">
                <span class="material-symbols-outlined text-amber-600">trending_up</span>
                Bài viết nổi bật
            </h4>
            <div class="flex flex-col gap-5">
                <div v-for="(post, index) in featuredPosts" :key="post.id">
                    <NuxtLink :to="`/blog/${post.slug}`" class="group flex gap-3 items-start">
                        <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden relative">
                            <div class="w-full h-full bg-cover bg-center"
                                :style="{ backgroundImage: `url('${post.thumbnail}')` }">
                            </div>
                            <span
                                :class="[index === 0 ? 'bg-primary' : 'bg-gray-500', 'absolute top-0 left-0 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-br']">
                                {{ index + 1 }}
                            </span>
                        </div>
                        <div>
                            <h5
                                class="text-sm font-bold text-[#181111] dark:text-white leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                {{ post.title }}
                            </h5>
                            <span class="text-[10px] text-gray-400 mt-1 block">{{ post.category }}</span>
                        </div>
                    </NuxtLink>
                </div>
                <div v-if="featuredPosts.length === 0" class="text-sm text-gray-500 italic text-center">
                    Chưa có bài viết nổi bật.
                </div>
            </div>
        </div>
        <div
            class="bg-[#fbf5f5] dark:bg-[#2a1a1a] p-6 rounded-xl border border-primary/10 dark:border-[#3a2828] text-center relative overflow-hidden">
            <div class="absolute -top-6 -right-6 text-primary/5 dark:text-white/5">
                <span class="material-symbols-outlined text-[120px]">mark_email_unread</span>
            </div>
            <div class="relative z-10">
                <div
                    class="w-12 h-12 bg-white dark:bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm text-primary">
                    <span class="material-symbols-outlined text-2xl">mail_outline</span>
                </div>
                <h4 class="font-bold text-lg text-[#181111] dark:text-white mb-2">Đăng ký nhận tin
                </h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-5 leading-relaxed">Nhận ngay
                    ưu
                    đãi khóa học và các bí quyết cắm hoa nghệ thuật hàng tuần.</p>
                <form class="space-y-3">
                    <input
                        class="w-full text-sm px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1a0f0f] focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-shadow placeholder-gray-400"
                        placeholder="Nhập email của bạn" type="email" />
                    <button
                        class="w-full bg-primary hover:bg-red-700 text-white font-bold text-sm py-2.5 rounded-lg transition-colors shadow-lg shadow-primary/20">Đăng
                        ký ngay</button>
                </form>
            </div>
        </div>
    </aside>
</template>
