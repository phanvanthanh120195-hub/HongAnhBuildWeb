<script setup lang="ts">
definePageMeta({
    layout: 'default'
})

const route = useRoute()
const config = useRuntimeConfig()

// Get order data from route query
const orderNumber = computed(() => route.query.order || 'N/A')
const orderTotal = computed(() => {
    const total = Number(route.query.total) || 0
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(total)
})
const courseName = computed(() => route.query.course || 'Khóa học')

useHead({
    title: 'Thanh toán thành công | Baby Florist'
})
</script>

<template>
    <main class="text-gray-800 antialiased bg-[#FCF9F5] dark:bg-gray-900 min-h-screen">
        <div class="max-w-[1400px] mx-auto px-6 py-12">
            <!-- Success Header -->
            <div
                class="text-center mb-12 relative overflow-hidden py-10 rounded-3xl bg-white dark:bg-gray-800 shadow-sm border border-orange-50 dark:border-gray-700">
                <div class="absolute top-10 left-10 text-[#C5A059] opacity-30">
                    <span class="material-symbols-outlined text-6xl">celebration</span>
                </div>
                <div class="absolute top-20 right-20 text-primary opacity-30">
                    <span class="material-symbols-outlined text-7xl">auto_awesome</span>
                </div>
                <div class="absolute bottom-10 left-1/4 text-[#C5A059] opacity-20">
                    <span class="material-symbols-outlined text-4xl">flare</span>
                </div>
                <div class="relative z-10">
                    <div
                        class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-50 dark:bg-red-900/20 mb-6">
                        <span class="material-symbols-outlined text-6xl text-primary">check_circle</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4 italic">Đã gửi yêu cầu thanh toán!</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-2">
                        Mã đơn hàng: <span class="font-bold text-gray-900 dark:text-white">#{{ orderNumber }}</span>
                    </p>
                    <p class="text-xl text-gray-700 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
                        Cảm ơn bạn đã lựa chọn <span class="text-primary font-semibold">Baby Florist</span>.
                        Chúng tôi sẽ xác nhận thanh toán và liên hệ bạn sớm nhất.
                    </p>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div
                    class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2 text-gray-900 dark:text-white">
                        <span class="material-symbols-outlined text-[#C5A059]">receipt_long</span>
                        Thông tin đơn hàng
                    </h2>
                    <div class="space-y-4">
                        <div
                            class="flex justify-between items-center pb-4 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-600 dark:text-gray-400">Sản phẩm:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ courseName }}</span>
                        </div>
                        <div
                            class="flex justify-between items-center pb-4 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-600 dark:text-gray-400">Trạng thái:</span>
                            <span class="px-3 py-1 rounded-full text-sm font-bold bg-yellow-100 text-yellow-700">Chờ xác
                                nhận</span>
                        </div>
                        <div class="flex justify-between items-center text-xl pt-2">
                            <span class="font-bold text-gray-900 dark:text-white">Tổng tiền:</span>
                            <span class="font-bold text-primary">{{ orderTotal }}</span>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-primary text-white p-8 rounded-2xl shadow-xl">
                    <h2 class="text-xl font-bold mb-6 border-b border-white/20 pb-4">Bước tiếp theo</h2>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-[#ffc24c]">hourglass_top</span>
                            <div>
                                <p class="font-bold text-sm uppercase tracking-wider text-[#ffc24c]">Đang chờ xác nhận
                                </p>
                                <p class="text-white/90">Chúng tôi đang kiểm tra giao dịch của bạn và sẽ xác nhận trong
                                    thời gian sớm nhất.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-[#ffc24c]">mail</span>
                            <div>
                                <p class="font-bold text-sm uppercase tracking-wider text-[#ffc24c]">Nhận thông báo</p>
                                <p class="text-white/90">Sau khi xác nhận, bạn sẽ nhận được thông tin qua email hoặc
                                    điện thoại.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <NuxtLink to="/"
                    class="min-w-[300px] py-4 px-8 text-white font-bold rounded-xl shadow-lg transition-all flex items-center justify-center gap-2 uppercase tracking-widest text-sm bg-gradient-to-r from-primary to-[#C5A059] hover:from-[#C5A059] hover:to-primary">
                    <span class="material-symbols-outlined text-lg">home</span>
                    Trang chủ
                </NuxtLink>

                <NuxtLink to="/infor/order-history"
                    class="min-w-[300px] py-4 px-8 bg-white dark:bg-gray-800 border-2 border-primary text-primary font-bold rounded-xl hover:bg-red-50 dark:hover:bg-gray-700 transition-all flex items-center justify-center gap-2 uppercase tracking-widest text-sm">
                    <span class="material-symbols-outlined text-lg">history</span>
                    Xem lịch sử đơn hàng
                </NuxtLink>
            </div>

            <!-- Support Info -->
            <div
                class="mt-8 p-6 rounded-xl border border-dashed border-gray-300 dark:border-gray-600 text-center bg-white dark:bg-gray-800">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Cần hỗ trợ về đơn hàng?</p>
                <div class="flex flex-wrap justify-center gap-4 text-primary font-bold">
                    <a class="hover:underline" href="tel:19001234">Hotline: 1900 xxxx</a>
                    <span class="text-gray-300 dark:text-gray-600">|</span>
                    <a class="hover:underline" href="#">Zalo Hỗ Trợ</a>
                </div>
            </div>
        </div>
    </main>
</template>
