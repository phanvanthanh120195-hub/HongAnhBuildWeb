<script setup lang="ts">
const route = useRoute()

// Get data from query params
const name = route.query.name as string || 'Khách hàng'
const subject = route.query.subject as string || 'Yêu cầu hỗ trợ'
</script>

<template>
    <main class="flex-1 flex items-center justify-center py-16 px-4 relative">
        <div class="absolute inset-0 flower-pattern pointer-events-none"></div>
        <div
            class="w-full max-w-[700px] bg-white rounded-2xl shadow-2xl border border-[#e6dbde] overflow-hidden relative z-10">
            <div class="h-2 bg-gradient-to-r from-primary via-gold to-primary"></div>
            <div class="p-10 md:p-16 flex flex-col items-center text-center">
                <div class="relative mb-8">
                    <div class="absolute inset-0 scale-150 opacity-20 text-gold">
                        <span class="material-symbols-outlined text-[100px]">filter_vintage</span>
                    </div>
                    <div class="size-24 rounded-full bg-primary/5 flex items-center justify-center relative">
                        <div
                            class="size-20 rounded-full border-2 border-dashed border-gold flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-[48px] font-bold">check</span>
                        </div>
                    </div>
                </div>
                <h1 class="text-primary text-4xl font-bold font-display mb-6">Gửi yêu cầu thành công!</h1>
                <p class="text-[#5c4a4e] text-lg leading-relaxed font-sans max-w-lg mb-10">
                    Cảm ơn bạn đã quan tâm đến <span class="font-semibold text-primary">Baby Florist</span>.
                    Đội ngũ của chúng tôi đã nhận được thông tin và sẽ phản hồi bạn trong vòng 24 giờ tới qua số
                    điện thoại hoặc email bạn đã cung cấp.
                </p>
                <div class="w-full bg-cream rounded-xl p-6 border border-gold/20 mb-10 text-left">
                    <h3
                        class="text-primary text-xs font-bold uppercase tracking-widest mb-4 border-b border-gold/20 pb-2">
                        Tóm tắt yêu cầu</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-[#89616b] text-xs font-medium uppercase">Họ tên khách hàng</p>
                            <p class="text-[#181113] font-semibold">{{ name }}</p>
                        </div>
                        <div>
                            <p class="text-[#89616b] text-xs font-medium uppercase">Chủ đề quan tâm</p>
                            <p class="text-[#181113] font-semibold">{{ subject }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 w-full justify-center">
                    <NuxtLink to="/"
                        class="flex flex-1 items-center justify-center h-14 px-8 rounded-lg bg-primary text-white font-bold tracking-wide hover:bg-opacity-90 transition-all shadow-lg">
                        VỀ TRANG CHỦ
                    </NuxtLink>
                    <NuxtLink to="/courses"
                        class="flex flex-1 items-center justify-center h-14 px-8 rounded-lg border-2 border-primary text-primary font-bold tracking-wide hover:bg-primary hover:text-white transition-all">
                        XEM THÊM KHÓA HỌC
                    </NuxtLink>
                </div>
            </div>
            <div class="p-6 bg-cream border-t border-[#e6dbde] flex justify-center items-center gap-2">
                <span class="material-symbols-outlined text-gold text-sm">auto_awesome</span>
                <span class="text-[#89616b] text-sm font-sans italic italic">Hẹn sớm được cùng bạn sáng tạo nghệ
                    thuật hoa Tết</span>
                <span class="material-symbols-outlined text-gold text-sm">auto_awesome</span>
            </div>
        </div>
    </main>
</template>

<style scoped>
.flower-pattern {
    background-image: radial-gradient(#D4AF37 1px, transparent 1px);
    background-size: 20px 20px;
    opacity: 0.1;
}
</style>
