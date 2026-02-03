<script setup lang="ts">
const emit = defineEmits(['close'])

const timeLeft = ref('02:56')

// Simple countdown timer logic (optional, for visual effect like in HTML)
let timer: any
onMounted(() => {
    let seconds = 176 // 2m 56s
    timer = setInterval(() => {
        if (seconds > 0) {
            seconds--
            const m = Math.floor(seconds / 60).toString().padStart(2, '0')
            const s = (seconds % 60).toString().padStart(2, '0')
            timeLeft.value = `${m}:${s}`
        } else {
            clearInterval(timer)
        }
    }, 1000)
})

onUnmounted(() => {
    if (timer) clearInterval(timer)
})
</script>

<template>
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
        @click.self="emit('close')">
        <div
            class="bg-white dark:bg-[#1a0c0e] w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
            <div class="relative p-6 border-b border-[#e7cfd1] dark:border-[#3d2a2c] text-center">
                <h3 class="text-xl font-bold text-[#1b0d0f] dark:text-white">Quét mã để thanh toán</h3>
                <button @click="emit('close')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6 md:p-8">
                <p class="text-center text-sm text-[#9a4c52] dark:text-[#c08287] mb-6">
                    Vui lòng quét mã QR hoặc chuyển khoản theo thông tin bên dưới để hoàn tất đăng ký.
                </p>
                <div class="flex items-center justify-center space-x-2 text-primary font-medium mb-6">
                    <span class="material-symbols-outlined text-lg">schedule</span>
                    <span>Thời gian còn lại: <span class="font-bold">{{ timeLeft }}</span></span>
                </div>
                <div class="flex flex-col items-center mb-8">
                    <div class="mb-4">
                        <img alt="Mã QR Thanh Toán VietQR"
                            class="w-48 h-48 border-4 border-white dark:border-[#3d2a2c] rounded-lg shadow-sm"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAeNAVO2fNfa5Yd_0DKNjqCS-rarqWUsZHcWbuB0gTWeJ3fonh6hD46JHVSQdYAVB_7t-tOo8c5y9NVwF2dwTDZ_rs850uYDwvHbxC7MoGuv6hHG_C7Uq7fdxjswKb8BffxuGCeZNGPt56GPhco4Dz8_Ni49C0rwCx3a1Dbkf54HQgGMygtpL8hLGlBgy21zRCqNKUx7UrAy4Z7MmPzpWugZatV43RIj4LpMMHgDkIyv5k2469DjoWfwf1ewzCIxJ8m-2rBNwlEnDw" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <img alt="Logo Napas" class="h-6 grayscale opacity-70 dark:invert"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAOQNTYvN2mzjwMjYqhRDPmniPGoe6vsxusMi2OoOC9mIQN02EeJqTcObvVuP8Y0Prd76PRhd9iZOYacLznEAFuOKCo7QtcU0i2xpz372xkSWUa1Gfo182ckVvT9DkEQnGIYiqKVXOqEx-cp0am53_SCPdKgxALabQ8iILnoRhSgyKQjeYwDmAvCnw6y3hBUdNQO10QgDByzb1P-XTZKd20Xhi0UJPqL_gXRlCT8jvlQu6vLwKBznt0dUKEJO7FWZ2Pz3mpNg-c2uU" />
                        <div class="h-4 w-[1px] bg-[#e7cfd1] dark:bg-[#3d2a2c]"></div>
                        <img alt="VPBank Logo" class="h-5"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCM9UFYRianP8vycuLzDyPrGf5Fk8LK0P6r3ja5x06Vu4sp1Eh6HiAQCojQkUq9Y5drfbedyM7oYOUvSIHS7YEAbwh67DXEu95haRuUt4HYhYTG9viQT-yV_3n_Bgn9waF_qNu2rxvvXW45ld_COB-kOPtLtBsQNSxnt963RxzearB16eOw0Lm45g_3Kh78XE69zuBsMq6GU4F8AIeRl5dbg1UF6NHHtNihUZOt2Vwv903PpFKeiglgXl-U7xIKViGJHKqKpQA1Jwg" />
                    </div>
                </div>
                <div class="space-y-3 text-sm md:text-base mb-8">
                    <div class="flex justify-between items-center py-1">
                        <span class="text-[#9a4c52] dark:text-[#c08287]">Ngân hàng:</span>
                        <span class="font-semibold text-[#1b0d0f] dark:text-white">VPBank</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-[#9a4c52] dark:text-[#c08287]">Số tài khoản:</span>
                        <div class="flex items-center space-x-2">
                            <span class="font-bold text-[#1b0d0f] dark:text-white">232845376</span>
                            <button class="text-primary hover:bg-primary/10 p-1 rounded transition-colors" title="Copy">
                                <span class="material-symbols-outlined text-base">content_copy</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-[#9a4c52] dark:text-[#c08287]">Chủ tài khoản:</span>
                        <span class="font-semibold text-[#1b0d0f] dark:text-white uppercase">Phan Văn Thành</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-[#9a4c52] dark:text-[#c08287]">Số tiền:</span>
                        <span class="font-bold text-primary text-lg">3.700.000 đ</span>
                    </div>
                    <div
                        class="flex justify-between items-center py-2 px-3 bg-background-light dark:bg-background-dark rounded-lg">
                        <span class="text-[#9a4c52] dark:text-[#c08287] text-xs">Nội dung CK:</span>
                        <div class="flex items-center space-x-2">
                            <span class="font-mono font-bold text-[#1b0d0f] dark:text-white">KH 0965324921 XTNMU</span>
                            <button
                                class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600/80 px-2 py-1 rounded text-xs flex items-center transition-colors">
                                <span class="material-symbols-outlined text-sm mr-1">content_copy</span> Copy
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Info banner -->
                <div
                    class="bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 p-4 rounded-xl mb-6">
                    <div class="flex space-x-3">
                        <span class="material-symbols-outlined text-blue-500 text-xl">info</span>
                        <p class="text-xs md:text-sm text-blue-800 dark:text-blue-300 leading-relaxed">
                            Hệ thống sẽ tự động kích hoạt khóa học sau khi nhận được thanh toán (1-5 phút).
                        </p>
                    </div>
                </div>
                <button
                    class="w-full py-4 bg-[#0dad68] hover:bg-[#0b9c5d] active:scale-[0.98] text-white font-bold rounded-xl transition-all shadow-lg shadow-green-200 dark:shadow-none uppercase tracking-wide">
                    Tôi đã chuyển khoản
                </button>
            </div>
        </div>
    </div>
</template>
