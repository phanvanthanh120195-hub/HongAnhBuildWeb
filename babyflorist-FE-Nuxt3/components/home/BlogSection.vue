<script setup>
const config = useRuntimeConfig();

const { data: response } = useFetch('/api/blogs', {
    baseURL: config.public.apiBase,
    lazy: true,
    key: 'home-blogs-featured',
    getCachedData: (key, nuxtApp) => nuxtApp.payload.data[key] || nuxtApp.static.data[key],
    query: {
        limit: 2,
        featured_priority: 1
    }
});

const posts = computed(() => {
    return response.value?.data || [];
});

const getImageUrl = (path) => {
    if (!path) return '';
    if (path.startsWith('http')) return path;
    return `${config.public.apiBase}/storage/${path}`;
};
</script>

<template>
    <section class="bg-light-beige py-24">
        <div class="max-w-[1400px] mx-auto px-6 md:px-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-4xl font-black text-[#722F37]">Góc Chia Sẻ</h2>
                    <p class="text-gray-500 mt-2 text-lg">Bí quyết cắm hoa và văn hóa Tết từ các chuyên gia</p>
                </div>
                <a class="text-primary font-bold flex items-center gap-2 group" href="#">
                    <span class="group-hover:underline">Xem thêm bài viết</span> <span
                        class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <!-- Loading State -->
            <div v-if="!posts.length" class="text-center py-10 text-gray-400">
                Đang tải hoặc chưa có bài viết nào...
            </div>

            <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <article v-for="post in posts" :key="post.id"
                    class="bg-white p-6 rounded-[2rem] flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-xl transition-all border border-gray-100">
                    <div class="md:w-1/2 shrink-0">
                        <div class="aspect-[4/3] rounded-2xl bg-center bg-cover"
                            :style="{ backgroundImage: `url('${getImageUrl(post.thumbnail)}')` }">
                        </div>
                    </div>
                    <div class="flex flex-col justify-between py-2">
                        <div>
                            <span class="text-xs font-bold text-gold uppercase tracking-widest mb-2 block">
                                {{ post.category ? post.category : 'Tin Tức' }}
                            </span>
                            <h3 class="text-xl font-bold mb-3 leading-tight group-hover:text-primary transition-colors">
                                {{ post.title }}
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-3 mb-4">
                                {{ post.excerpt || post.title }}...
                            </p>
                        </div>
                        <a class="inline-flex items-center gap-2 text-primary font-bold text-sm group/btn" href="#">
                            Đọc thêm <span
                                class="material-symbols-outlined text-lg group-hover/btn:translate-x-1 transition-transform">trending_flat</span>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>
</template>
