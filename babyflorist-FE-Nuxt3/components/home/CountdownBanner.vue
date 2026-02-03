<template>
    <section class="py-12 bg-white">
        <div class="max-w-[1400px] mx-auto px-4 md:px-10">
            <div
                class="relative w-full rounded-[2.5rem] overflow-hidden bg-gradient-to-br from-[#722F37] to-[#4a1a1e] shadow-2xl p-8 md:p-14 flex flex-col lg:flex-row items-center justify-between gap-10 border border-[#8a3c45]">
                <div class="relative z-10 flex flex-col gap-5 text-center lg:text-left flex-1">
                    <div class="inline-flex items-center justify-center lg:justify-start gap-2 mb-1">
                        <span class="material-symbols-outlined text-[#FFD700]">celebration</span>
                        <span class="text-[#FFD700] font-bold tracking-[0.2em] text-sm uppercase">Sự kiện giới
                            hạn</span>
                    </div>
                    <h2 class="text-3xl md:text-5xl font-black text-white leading-tight">
                        Workshop Đặc Biệt:<br />Nghệ Thuật Cắm Hoa Khai Xuân
                    </h2>
                    <p class="text-white/80 text-lg max-w-xl">
                        Đừng bỏ lỡ cơ hội nhận ưu đãi <span
                            class="font-black text-[#FFD700] text-xl underline decoration-2 underline-offset-4">Giảm
                            ngay 20%</span> khi đăng ký trước khi bộ đếm kết thúc.
                    </p>
                    <div class="flex items-start justify-center lg:justify-start gap-3 md:gap-5 mt-4">
                        <div class="flex flex-col items-center">
                            <div
                                class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl w-20 h-20 md:w-24 md:h-24 flex items-center justify-center shadow-2xl">
                                <span class="text-3xl md:text-4xl font-black text-white">03</span>
                            </div>
                            <span class="text-xs text-white/60 mt-3 uppercase tracking-widest font-bold">Ngày</span>
                        </div>
                        <span class="text-3xl font-bold text-white/30 mt-6 md:mt-8">:</span>
                        <div class="flex flex-col items-center">
                            <div
                                class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl w-20 h-20 md:w-24 md:h-24 flex items-center justify-center shadow-2xl">
                                <span class="text-3xl md:text-4xl font-black text-white">12</span>
                            </div>
                            <span class="text-xs text-white/60 mt-3 uppercase tracking-widest font-bold">Giờ</span>
                        </div>
                        <span class="text-3xl font-bold text-white/30 mt-6 md:mt-8">:</span>
                        <div class="flex flex-col items-center">
                            <div
                                class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl w-20 h-20 md:w-24 md:h-24 flex items-center justify-center shadow-2xl">
                                <span class="text-3xl md:text-4xl font-black text-white">45</span>
                            </div>
                            <span class="text-xs text-white/60 mt-3 uppercase tracking-widest font-bold">Phút</span>
                        </div>
                        <span class="text-3xl font-bold text-white/30 mt-6 md:mt-8">:</span>
                        <div class="flex flex-col items-center">
                            <div
                                class="bg-[#FFD700]/20 backdrop-blur-xl border border-[#FFD700]/40 rounded-2xl w-20 h-20 md:w-24 md:h-24 flex items-center justify-center shadow-2xl ring-2 ring-[#FFD700]/50 ring-offset-4 ring-offset-[#722F37]">
                                <span class="text-3xl md:text-4xl font-black text-[#FFD700]">20</span>
                            </div>
                            <span class="text-xs text-[#FFD700] mt-3 uppercase tracking-widest font-black">Giây</span>
                        </div>
                    </div>
                </div>
                <div
                    class="relative z-10 flex flex-col items-center gap-4 shrink-0 bg-white/5 p-8 rounded-3xl border border-white/10 backdrop-blur-sm">
                    <NuxtLink to="/workshop"
                        class="group relative overflow-hidden bg-gradient-to-b from-[#FFD700] to-[#E6C200] hover:to-[#D4AF37] text-[#5e1313] font-bold text-lg py-4 px-10 rounded-full shadow-[0_4px_20px_rgba(255,215,0,0.3)] hover:shadow-[0_8px_30px_rgba(255,215,0,0.4)] transform hover:-translate-y-0.5 transition-all duration-300">
                        <span class="relative z-10 flex items-center gap-2 font-black uppercase tracking-wide">
                            Đăng ký ngay
                            <span
                                class="material-symbols-outlined text-2xl group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </span>
                        <div
                            class="absolute inset-0 bg-white/40 skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-in-out">
                        </div>
                    </NuxtLink>
                    <div class="flex items-center gap-2 text-[#FFD700] font-bold">
                        <span class="material-symbols-outlined text-xl">group_add</span>
                        <span>Chỉ còn 5 suất cuối cùng!</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
