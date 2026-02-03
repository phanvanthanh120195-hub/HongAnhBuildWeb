<template>
    <section class="bg-white py-12 md:py-20">
        <div class="max-w-[1400px] mx-auto px-6 md:px-10">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex flex-col gap-6 lg:w-1/2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-red-50 rounded-full w-fit">
                        <span class="material-symbols-outlined text-primary text-sm">colors_spark</span>
                        <span class="text-base font-bold text-primary uppercase tracking-widest">Chào Xuân Bính Ngọ
                            2026</span>
                    </div>
                    <h1
                        class="text-[#181111] text-5xl md:text-7xl font-black leading-tight tracking-[-0.03em] !leading-[1.15]">
                        Tinh Hoa <br /> <span class="text-gold italic">Nghệ Thuật</span> <br /> <span
                            class="text-primary italic">Cắm Hoa Tết</span>
                    </h1>
                    <p class="text-gray-600 text-lg md:text-xl max-w-xl leading-relaxed">
                        Khám phá nét đẹp truyền thống qua từng nhành hoa cùng nghệ nhân hàng đầu. Tham gia ngay
                        để tự tay tạo nên những tác phẩm Tết ý nghĩa, mang xuân về nhà.
                    </p>
                    <div class="flex flex-wrap gap-4 mt-4">
                        <NuxtLink to="/courses"
                            class="flex items-center justify-center rounded-full h-14 px-8 bg-primary hover:bg-red-700 text-white text-lg font-bold transition-all shadow-xl shadow-red-100">
                            Khám phá khóa học
                        </NuxtLink>
                        <NuxtLink to="/products"
                            class="flex items-center justify-center rounded-full h-14 px-8 bg-white border-2 border-primary text-primary text-lg font-bold hover:bg-red-50 transition-all">
                            Xem sản phẩm
                        </NuxtLink>
                    </div>
                </div>
                <div class="lg:w-1/2 w-full">
                    <div class="relative">
                        <div class="w-full aspect-[4/3] bg-center bg-cover rounded-[2rem] shadow-2xl relative z-10"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDi6tu_PFakN_PMcVOPdSmhxAjsPDOLNhl5uWgTTXPDKNkJc-jJUWxQGTguI4wDmSW-RUWu6DsPM4Uz1YleOeWbxg9mvcmRpI8rAevEO_mVVUMCeI3SSs6nimydGbMi--7CDdL-Lv0oWsWs6JgdoCDRfHNk8DrQOM9zfIUnrXZU9WeH6lUwjYZq4sp5QWsr5pe9lt28bCb26rI5dvj9QAV2JVNHLkzt-ow5R2Gb5V4nTAp7yWMW34lF8e0EidXxeQHMfCqwlyAHOt8");'>
                        </div>
                        <div class="absolute -bottom-6 -right-6 w-1/2 h-1/2 bg-gold/20 rounded-[2rem] -z-0">
                        </div>
                        <div class="absolute -top-6 -left-6 w-1/3 h-1/3 border-4 border-primary/10 rounded-[2rem] -z-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
