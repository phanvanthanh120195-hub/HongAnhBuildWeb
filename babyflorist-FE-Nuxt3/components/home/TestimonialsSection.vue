<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay } from 'swiper/modules';
import 'swiper/css';

const config = useRuntimeConfig();

const { data: response } = useFetch('/api/featured-reviews', {
    baseURL: config.public.apiBase,
    lazy: true,
});

const reviews = computed(() => {
    return response.value?.data || [];
});
</script>

<template>
    <section class="bg-white py-24" v-if="reviews.length > 0">
        <div class="max-w-[1400px] mx-auto px-6 md:px-10">
            <div class="flex flex-col items-center text-center gap-4 mb-16">
                <h2 class="text-4xl font-black text-primary">Khách Hàng Nói Gì?</h2>
                <div class="flex text-gold">
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                </div>
            </div>

            <ClientOnly>
                <Swiper :modules="[Autoplay]" :slides-per-view="3" :space-between="30" :loop="reviews.length > 3"
                    :autoplay="{
                        delay: 6000,
                        disableOnInteraction: false,
                    }" :breakpoints="{
                        320: {
                            slidesPerView: 1,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 30,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                    }" class="testimonials-swiper">
                    <SwiperSlide v-for="review in reviews" :key="review.id">
                        <div class="bg-[#F2EBE3]/30 p-10 rounded-3xl relative flex flex-col justify-between h-full">
                            <span
                                class="material-symbols-outlined text-primary/10 text-7xl absolute top-6 right-8">format_quote</span>
                            <p class="text-gray-600 italic mb-8 relative z-10">"{{ review.content }}"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-cover bg-center ring-2 ring-primary/10 shrink-0"
                                    :style="{ backgroundImage: `url('${review.display_avatar || `https://ui-avatars.com/api/?name=${encodeURIComponent(review.display_name)}&background=random`}')` }">
                                </div>
                                <div>
                                    <p class="font-black text-primary">{{ review.display_name }}</p>
                                    <p class="text-xs text-gray-500">{{ review.display_label }}</p>
                                </div>
                            </div>
                        </div>
                    </SwiperSlide>
                </Swiper>
            </ClientOnly>
        </div>
    </section>
</template>

<style scoped>
.testimonials-swiper {
    padding: 10px 5px;
}

.testimonials-swiper :deep(.swiper-slide) {
    height: auto;
}
</style>
