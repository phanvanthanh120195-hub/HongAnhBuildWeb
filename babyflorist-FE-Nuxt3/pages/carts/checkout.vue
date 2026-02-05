<template>
    <div class="flex-1 flex flex-col items-center w-full min-h-[70vh]">
        <div class="max-w-[1400px] w-full px-6 lg:px-20 py-8">
            <nav class="flex flex-wrap gap-2 py-4 mb-8">
                <NuxtLink to="/cart" class="text-[#9a4c52] dark:text-[#c08287] text-sm font-medium hover:underline">Giỏ
                    hàng</NuxtLink>
                <span class="text-[#9a4c52] dark:text-[#c08287] text-sm font-medium">/</span>
                <span class="text-[#1b0d0f] dark:text-white text-sm font-medium">Thanh toán</span>
            </nav>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <div class="lg:col-span-8 space-y-8">
                    <div
                        class="bg-white dark:bg-[#2d1b1d] p-8 rounded-xl border border-[#e7cfd1] dark:border-[#3d2a2c] shadow-sm">
                        <h2 class="text-2xl font-black text-[#1b0d0f] dark:text-white mb-8">Thông tin thanh toán
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-[#1b0d0f] dark:text-white mb-2">Họ và tên
                                    <span class="text-red-500">*</span></label>
                                <input
                                    class="w-full rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary"
                                    placeholder="Nhập họ và tên của bạn" type="text" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1b0d0f] dark:text-white mb-2">Số điện
                                    thoại <span class="text-red-500">*</span></label>
                                <input
                                    class="w-full rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary"
                                    placeholder="09xxxxxxxx" type="tel" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1b0d0f] dark:text-white mb-2">Email (Để
                                    nhận thông tin khóa học)</label>
                                <input
                                    class="w-full rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary"
                                    placeholder="email@example.com" type="email" />
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-[#1b0d0f] dark:text-white mb-2">Địa chỉ
                                    chi tiết</label>
                                <textarea
                                    class="w-full rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary"
                                    placeholder="Số nhà, tên đường, phường/xã, quận/huyện..." rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mt-12">
                            <h2 class="text-xl font-black text-[#1b0d0f] dark:text-white mb-6">Chọn ngân hàng chuyển
                                khoản</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div
                                    class="border-2 border-primary bg-primary/5 rounded-xl p-5 relative cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="size-12 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                            <span
                                                class="material-symbols-outlined text-primary text-3xl">account_balance</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-[#1b0d0f] dark:text-white">VPBank</p>
                                            <p class="text-sm font-bold text-primary">Phan Văn Thành</p>
                                            <p class="text-sm text-[#9a4c52] dark:text-[#c08287]">232845376</p>
                                        </div>
                                    </div>
                                    <div class="absolute top-4 right-4 text-primary">
                                        <span class="material-symbols-outlined text-xl">check_circle</span>
                                    </div>
                                </div>
                                <div
                                    class="border border-[#e7cfd1] dark:border-[#3d2a2c] hover:border-primary transition-colors rounded-xl p-5 cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="size-12 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                            <span
                                                class="material-symbols-outlined text-gray-400 text-3xl">account_balance</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-[#1b0d0f] dark:text-white">Vietcombank</p>
                                            <p class="text-sm font-bold text-[#1b0d0f] dark:text-white">Phan Văn
                                                Thành</p>
                                            <p class="text-sm text-[#9a4c52] dark:text-[#c08287]">1012345678</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 space-y-6">
                    <div
                        class="bg-white dark:bg-[#2d1b1d] p-6 rounded-xl border border-[#e7cfd1] dark:border-[#3d2a2c] shadow-sm">
                        <h2
                            class="text-xl font-black text-[#1b0d0f] dark:text-white border-b border-[#e7cfd1] dark:border-[#3d2a2c] pb-4 mb-6">
                            Đơn hàng của bạn</h2>
                        <div class="space-y-4 mb-8">
                            <div class="flex gap-4">
                                <div class="size-16 rounded-lg bg-cover bg-center shrink-0 border border-[#e7cfd1]"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBiZAj79OJYNl2Yc8Z1kfjF5e6ZEh8CFTN61HURLKUBZwVRuxWP3Av_SS3b7dNCgpWPQAT4ikxxnrgbbGf6wJKAUCFGOSTtRSmi9qD-nKQ2lvgQMlrVCRyFNFVxGvXNilpiA0A_TrXmsgrulALgZJ5szPZEmKVV4J77vf4MvgfKVwfcLTZBn8f_dZ04ORR1hmYwHEBm1AywZNyDwHHfS2oPhKXAbM-i3eg0Wb5jmMRt5GPeAz8pieDDNwZxGcJZ3h9hnXw337U_Md8");'>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h4 class="text-sm font-bold text-[#1b0d0f] dark:text-white line-clamp-1">Khóa
                                        học cắm hoa Tết Bình An</h4>
                                    <p class="text-xs text-[#9a4c52]">Số lượng: 1</p>
                                    <p class="text-sm font-bold text-primary">1.500.000đ</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="size-16 rounded-lg bg-cover bg-center shrink-0 border border-[#e7cfd1]"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDy0geSOUeW_Ww9TNiNxuZZrLD9sSKJa5Xrsh6AxjrYJnrmi6hpChcyzWOOLTh-W8uKXOXhAC2VC-_RmXAfEjczVZlhmMHXIH7XMMYlfQu_KF4JL6jOpkx25zkrcIVqEECtpFM2pJaE7DVbDcyeKDcCjn41OiLiEXH95qky5cWbe2ppZYMFJUN-avruyZHouLfDryXQF0kae6i5_iqcan2GIthNBwSrP38UgytKuu0GDjTXNeI64vcM0DDdx8SaqlByl955uZWhUO4");'>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h4 class="text-sm font-bold text-[#1b0d0f] dark:text-white line-clamp-1">Giỏ
                                        quà Tết Phú Quý</h4>
                                    <p class="text-xs text-[#9a4c52]">Số lượng: 1</p>
                                    <p class="text-sm font-bold text-primary">2.200.000đ</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4 border-t border-[#e7cfd1] dark:border-[#3d2a2c] pt-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-[#9a4c52] dark:text-[#c08287]">Tạm tính:</span>
                                <span class="text-[#1b0d0f] dark:text-white font-semibold">3.700.000đ</span>
                            </div>
                            <div>
                                <div class="flex gap-2">
                                    <input
                                        class="form-input flex-1 rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark text-sm px-4 focus:ring-primary focus:border-primary"
                                        placeholder="Nhập mã giảm giá..." type="text" />
                                    <button
                                        class="bg-[#1b0d0f] dark:bg-black text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-black/80 transition-colors uppercase">Áp
                                        dụng</button>
                                </div>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-[#9a4c52] dark:text-[#c08287]">Giảm giá:</span>
                                <span class="text-green-600 font-semibold">- 0đ</span>
                            </div>
                            <div class="border-t border-[#e7cfd1] dark:border-[#3d2a2c] pt-6 mt-6">
                                <div class="flex justify-between items-center mb-8">
                                    <span class="text-[#1b0d0f] dark:text-white text-xl font-black">Tổng
                                        cộng:</span>
                                    <span class="text-primary text-2xl font-black">3.700.000đ</span>
                                </div>
                                <button @click="showPayment = true"
                                    class="w-full bg-primary hover:bg-[#b80e1c] text-white py-4 rounded-xl font-bold text-lg shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-3 uppercase tracking-widest">
                                    THANH TOÁN NGAY
                                    <span class="material-symbols-outlined">payments</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-2 p-4 text-[#9a4c52] dark:text-[#c08287]">
                        <span class="material-symbols-outlined text-green-600">verified_user</span>
                        <span class="text-xs uppercase font-bold tracking-widest">Thanh toán bảo mật 100%</span>
                    </div>
                </div>
            </div>
        </div>
        <PaymentPopup v-if="showPayment" @close="showPayment = false" />
    </div>
</template>

<script setup lang="ts">
import PaymentPopup from '~/components/checkout/PaymentPopup.vue'

useHead({
    title: 'Thanh toán - Hoa Tết Art'
})

const showPayment = ref(false)
</script>
