<script setup lang="ts">
const config = useRuntimeConfig()

// Form data
const formData = ref({
    name: '',
    phone: '',
    email: '',
    subject: '',
    message: ''
})

// State
const isLoading = ref(false)
const showSuccess = ref(false)
const errorMessage = ref('')

// Submit handler
async function handleSubmit() {
    // Validate
    if (!formData.value.name || !formData.value.phone || !formData.value.email || !formData.value.subject || !formData.value.message) {
        errorMessage.value = 'Vui lòng điền đầy đủ thông tin'
        return
    }

    isLoading.value = true
    errorMessage.value = ''
    showSuccess.value = false

    try {
        const response = await $fetch(`${config.public.apiBase}/api/support-requests`, {
            method: 'POST',
            body: formData.value
        })

        // Redirect to success page with name and subject
        navigateTo({
            path: '/contact/success',
            query: {
                name: formData.value.name,
                subject: formData.value.subject
            }
        })
    } catch (error: any) {
        errorMessage.value = error?.data?.message || 'Đã có lỗi xảy ra, vui lòng thử lại sau'
    } finally {
        isLoading.value = false
    }
}
</script>

<template>
    <main class="layout-container flex h-full grow flex-col items-center w-full">
        <div class="w-full max-w-[1400px] px-4 mt-6">
            <div class="relative w-full h-[320px] md:h-[400px] rounded-2xl overflow-hidden shadow-xl group">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBvlZP-Ef82IolFsm5WdFSTI0KqqE4FRUiDqcOHY96ngVPtxUFC2eg_kpXCmZPEL0cnTYZm9blVG_CqrIganhVNBUHQ_Q2fIGYH_tqUcntJ36XvXjlaUzekbqooqi8kNZvg8YxiWfCMSqIFZfxIi8WngNBG88nCz6FYqTKh7HgLgwoGi01ofO6T8GepLHe4X-5aJZqskza-7g9wEddGTUa7TNWwHPDFogvFmiPENwBovHhdkHj0oVOo2Uzs4X5Lm_B8dcfVRT1Lasa6");'>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
                <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-16">
                    <h1
                        class="font-serif text-2xl md:text-5xl font-bold text-white mb-4 drop-shadow-md tracking-tight leading-tight">
                        Kết Nối Cùng <br />
                    </h1>
                    <h1
                        class="font-serif text-2xl md:text-6xl font-bold text-gold italic mb-4 drop-shadow-md tracking-tight leading-tight">
                        Baby Florist
                    </h1>
                    <p class="text-white/90 text-lg md:text-xl font-light max-w-xl drop-shadow-sm">
                        Mang không gian nghệ thuật và hương sắc mùa xuân đến gần bạn hơn.
                    </p>
                </div>
            </div>
        </div>
        <div class="w-full max-w-[1400px] px-4 py-12 flex flex-col lg:flex-row gap-8 items-start">
            <div class="w-full lg:w-1/3 flex flex-col gap-8">
                <h2 class="text-3xl font-bold text-[#181111] dark:text-white border-l-4 border-primary pl-4">
                    Thông Tin Liên Hệ
                </h2>
                <div class="flex flex-col gap-5">
                    <div
                        class="bg-white dark:bg-[#2a1a1a] p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 dark:border-gray-800 flex items-start gap-5">
                        <div
                            class="w-12 h-12 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center shrink-0 text-primary">
                            <span class="material-symbols-outlined text-2xl">storefront</span>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-primary uppercase tracking-wider mb-1">Địa chỉ
                                Studio
                            </h3>
                            <p class="font-bold text-gray-900 dark:text-white text-lg">123 Đường Hoa Lan, Phường
                                2
                            </p>
                            <p class="text-gray-600 dark:text-gray-400">Quận Phú Nhuận, TP.HCM</p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-[#2a1a1a] p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 dark:border-gray-800 flex items-start gap-5">
                        <div
                            class="w-12 h-12 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center shrink-0 text-primary">
                            <span class="material-symbols-outlined text-2xl">call</span>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-primary uppercase tracking-wider mb-1">Hotline Tư
                                Vấn
                            </h3>
                            <p class="font-bold text-gray-900 dark:text-white text-lg">0909 123 456</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">(8:00 - 20:00 Hàng ngày)</p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-[#2a1a1a] p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 dark:border-gray-800 flex items-start gap-5">
                        <div
                            class="w-12 h-12 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center shrink-0 text-primary">
                            <span class="material-symbols-outlined text-2xl">mail</span>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-primary uppercase tracking-wider mb-1">Email Hỗ
                                Trợ
                            </h3>
                            <p class="font-bold text-gray-900 dark:text-white text-lg break-all">
                                support@hoatetworkshop.com</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Mạng xã hội</h3>
                    <div class="flex gap-3">
                        <a class="flex-1 bg-[#1877F2] hover:bg-[#166fe5] text-white py-3 rounded-lg font-bold text-center transition-colors shadow-sm flex items-center justify-center gap-2"
                            href="#">
                            Facebook
                        </a>
                        <a class="flex-1 bg-gradient-to-r from-[#833AB4] via-[#FD1D1D] to-[#FCAF45] hover:opacity-90 text-white py-3 rounded-lg font-bold text-center transition-opacity shadow-sm flex items-center justify-center gap-2"
                            href="#">
                            Instagram
                        </a>
                        <a class="flex-1 bg-[#0068FF] hover:bg-[#0060eb] text-white py-3 rounded-lg font-bold text-center transition-colors shadow-sm flex items-center justify-center gap-2"
                            href="#">
                            Zalo
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div
                    class="bg-white dark:bg-[#2a1a1a] rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-8 md:p-10 h-full">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-[#181111] dark:text-white mb-2">
                            Gửi Yêu Cầu Hỗ Trợ
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400">Vui lòng điền thông tin bên dưới, chúng tôi
                            sẽ
                            liên hệ lại sớm nhất.</p>
                    </div>

                    <!-- Success Message -->
                    <div v-if="showSuccess" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-green-700 font-medium">✓ Gửi yêu cầu thành công! Chúng tôi sẽ liên hệ lại sớm
                            nhất.</p>
                    </div>

                    <!-- Error Message -->
                    <div v-if="errorMessage" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-red-700 font-medium">{{ errorMessage }}</p>
                    </div>

                    <form class="flex flex-col gap-6" @submit.prevent="handleSubmit">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="font-bold text-sm text-gray-700 dark:text-gray-300">Họ và
                                    Tên</label>
                                <input v-model="formData.name"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-[#1f1616] focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm"
                                    placeholder="Nhập họ tên của bạn" type="text" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold text-sm text-gray-700 dark:text-gray-300">Số Điện
                                    Thoại</label>
                                <input v-model="formData.phone"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-[#1f1616] focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm"
                                    placeholder="09xxxxxxxx" type="tel" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold text-sm text-gray-700 dark:text-gray-300">Email</label>
                            <input v-model="formData.email"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-[#1f1616] focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm"
                                placeholder="email@example.com" type="email" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold text-sm text-gray-700 dark:text-gray-300">Chủ Đề Cần Hỗ
                                Trợ</label>
                            <div class="relative">
                                <select v-model="formData.subject"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-[#1f1616] focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm appearance-none cursor-pointer">
                                    <option value="">Chọn chủ đề...</option>
                                    <option value="Tư vấn khóa học">Tư vấn khóa học</option>
                                    <option value="Đặt hàng sản phẩm">Đặt hàng sản phẩm</option>
                                    <option value="Hợp tác doanh nghiệp">Hợp tác doanh nghiệp</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold text-sm text-gray-700 dark:text-gray-300">Nội Dung Tin
                                Nhắn</label>
                            <textarea v-model="formData.message"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-[#1f1616] focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm resize-none"
                                placeholder="Nhập nội dung yêu cầu chi tiết..." rows="5"></textarea>
                        </div>
                        <button :disabled="isLoading" :class="{ 'opacity-70 cursor-not-allowed': isLoading }"
                            class="mt-2 w-full bg-primary hover:bg-[#8a1820] text-white font-bold py-4 rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 active:translate-y-0 text-base uppercase tracking-wide"
                            type="submit">
                            <span v-if="isLoading">Đang gửi...</span>
                            <span v-else>Gửi Yêu Cầu</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full max-w-[1400px] mb-5 relative z-0">
            <div class="w-full h-[450px] bg-gray-200 relative">
                <iframe height="100%" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.162799307268!2d106.6896233!3d10.7988358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528ce2268798d%3A0x29c78736e1338d81!2sPhu%20Nhuan%2C%20Ho%20Chi%20Minh%20City%2C%20Vietnam!5e0!3m2!1sen!2s!4v1709223456789!5m2!1sen!2s"
                    style="border:0; filter: grayscale(100%) contrast(1.2) opacity(0.8);" width="100%"></iframe>
                <div
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center pointer-events-none">
                    <div class="bg-white px-4 py-2 rounded-lg shadow-lg mb-2">
                        <span class="font-bold text-primary text-xs uppercase">Workshop Hoa Tết Studio</span>
                    </div>
                    <span class="material-symbols-outlined text-primary text-5xl drop-shadow-lg">location_on</span>
                </div>
            </div>
        </div>
    </main>
</template>
