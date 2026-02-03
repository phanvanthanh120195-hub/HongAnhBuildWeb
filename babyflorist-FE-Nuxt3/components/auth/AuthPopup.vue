<script setup lang="ts">
import { ref } from 'vue'

const emit = defineEmits(['close'])
type AuthView = 'login' | 'register' | 'forgot' | 'otp'
const currentView = ref<AuthView>('login')
</script>

<template>
    <div @click.self="emit('close')"
        class="fixed inset-0 z-[100] bg-black/70 backdrop-blur-md flex items-center justify-center p-4">
        <div
            class="relative w-full max-w-[900px] bg-[#332222] border border-black/10 rounded-xl overflow-hidden shadow-2xl flex flex-col md:flex-row min-h-[550px]">
            <button @click="emit('close')"
                class="absolute top-4 right-4 z-30 text-black/50 hover:text-black transition-colors">
                <span class="material-symbols-outlined text-3xl">close</span>
            </button>
            <div class="hidden md:flex md:w-5/12 relative overflow-hidden group">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-background-dark/95 via-background-dark/20 to-transparent z-10">
                </div>
                <img alt="Tet flowers arrangement"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmUHvi062Fw__zSentslMMROB1GyKXnsOyFc91I82CG8Va2VgE-1J_H8jLPEPOtbOXB3dLOmPoJTbbUjuExslv8bFWQD20Q42nD2LsGOt1HOigPQV2rqH1cAgRbDjt1UGFJQuQ0vBqicgvoANsVHDwgcCfLCGNodyvdJEOUCTEN-1FdzbYyvQ4uAat8HkT1d24grDolKnnN6MvfeyAEBSnxFLOP5RG5I02-dqH6u7SPc4Ow9DoC1IWerd1E5rFO4m5Ubwu8RjikUs" />
                <div class="absolute bottom-10 left-10 z-20 pr-10">
                    <h3 class="text-3xl font-bold text-white mb-3">Tinh Hoa Tết Việt</h3>
                    <p class="text-white/70 text-sm leading-relaxed">
                        Khám phá nghệ thuật cắm hoa truyền thống và tạo nên những tác phẩm đặc sắc đón xuân.
                    </p>
                </div>
            </div>
            <div class="flex-1 p-8 md:p-14 flex flex-col justify-center bg-white">
                <!-- Tab Navigation (Only show for Login/Register) -->
                <div v-if="currentView !== 'forgot' && currentView !== 'otp'"
                    class="mb-10 flex border-b border-black/10">
                    <button @click="currentView = 'login'"
                        :class="currentView === 'login' ? 'border-primary text-primary' : 'border-transparent text-gray-400 hover:text-gray-600'"
                        class="flex-1 pb-4 text-center border-b-2 font-bold text-lg tracking-wide transition-all">
                        Đăng nhập
                    </button>
                    <button @click="currentView = 'register'"
                        :class="currentView === 'register' ? 'border-primary text-primary' : 'border-transparent text-gray-400 hover:text-gray-600'"
                        class="flex-1 pb-4 text-center border-b-2 font-bold text-lg tracking-wide transition-all">
                        Đăng ký
                    </button>
                </div>

                <!-- Login Form -->
                <div v-if="currentView === 'login'" class="flex flex-col gap-6">
                    <div class="space-y-5">
                        <div class="flex flex-col gap-2">
                            <label class="text-[#181113] text-base font-medium flex items-center gap-2">
                                <span class="material-symbols-outlined text-base">mail</span>
                                Email hoặc số điện thoại
                            </label>
                            <input
                                class="w-full bg-white border border-[#e6dbdf] rounded-lg h-14 px-4 text-[#181113] placeholder-[#89616f]/70 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                                placeholder="nguyenvan@gmail.com" type="text" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-between items-center">
                                <label class="text-[#181113] text-base font-medium flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base">lock</span>
                                    Mật khẩu
                                </label>
                                <button @click="currentView = 'forgot'"
                                    class="text-primary text-sm hover:text-primary transition-colors text-base font-medium">
                                    Quên mật khẩu?</button>
                            </div>
                            <input
                                class="w-full bg-white border border-[#e6dbdf] rounded-lg h-14 px-4 text-[#181113] placeholder-[#89616f]/70 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                                placeholder="••••••••" type="password" />
                        </div>
                        <div class="flex items-center gap-3 py-1">
                            <input
                                class="h-5 w-5 rounded border-gray-300 bg-white text-primary focus:ring-offset-white cursor-pointer transition-all"
                                id="remember-me" name="remember-me" type="checkbox" />
                            <label class="text-[#89616f] text-sm font-medium cursor-pointer select-none"
                                for="remember-me">Ghi nhớ đăng nhập</label>
                        </div>
                    </div>
                    <button
                        class="w-full bg-primary hover:bg-[#b00e43] text-white h-14 rounded-lg font-bold text-base shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2 mt-2">
                        Đăng nhập
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                    <div class="text-center">
                        <button @click="currentView = 'register'" class="text-[#89616f] hover:text-primary text-sm">
                            Chưa có tài khoản? <span class="text-primary font-bold">Đăng ký ngay</span>
                        </button>
                    </div>
                </div>

                <!-- Register Form -->
                <div v-else-if="currentView === 'register'" class="flex flex-col gap-4">
                    <div class="space-y-4">
                        <div class="flex flex-col gap-2">
                            <label class="text-[#181113] text-base font-medium flex items-center gap-2">
                                <span class="material-symbols-outlined text-base">person</span>
                                Họ và tên
                            </label>
                            <input
                                class="w-full bg-white border border-[#e6dbdf] rounded-lg h-12 px-4 text-[#181113] placeholder-[#89616f]/70 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                                placeholder="Nguyễn Văn A" type="text" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-[#181113] text-base font-medium flex items-center gap-2">
                                <span class="material-symbols-outlined text-base">mail</span>
                                Email
                            </label>
                            <input
                                class="w-full bg-white border border-[#e6dbdf] rounded-lg h-12 px-4 text-[#181113] placeholder-[#89616f]/70 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                                placeholder="email@example.com" type="email" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-[#181113] text-base font-medium flex items-center gap-2">
                                <span class="material-symbols-outlined text-base">call</span>
                                Số điện thoại
                            </label>
                            <input
                                class="w-full bg-white border border-[#e6dbdf] rounded-lg h-12 px-4 text-[#181113] placeholder-[#89616f]/70 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                                placeholder="0909 123 456" type="tel" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-[#181113] text-base font-medium flex items-center gap-2">
                                <span class="material-symbols-outlined text-base">lock</span>
                                Mật khẩu
                            </label>
                            <input
                                class="w-full bg-white border border-[#e6dbdf] rounded-lg h-12 px-4 text-[#181113] placeholder-[#89616f]/70 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                                placeholder="••••••••" type="password" />
                        </div>
                    </div>
                    <button
                        class="w-full bg-primary hover:bg-[#b00e43] text-white h-14 rounded-lg font-bold text-base shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2 mt-2">
                        Đăng ký ngay
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                    <div class="text-center">
                        <button @click="currentView = 'login'" class="text-[#89616f] hover:text-primary text-sm">
                            Bạn đã có tài khoản? <span class="text-primary font-bold">Đăng nhập ngay</span>
                        </button>
                    </div>
                </div>

                <!-- Forgot Password Form -->
                <div v-else-if="currentView === 'forgot'"
                    class="w-full max-w-[480px] bg-white rounded-2xl shadow-luxury overflow-hidden mx-auto">
                    <div class="flex flex-col gap-6">
                        <!-- Icon Header -->
                        <div
                            class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary mb-2">
                            <span class="material-symbols-outlined text-[28px]">lock_reset</span>
                        </div>
                        <!-- Header -->
                        <div class="flex flex-col gap-2">
                            <h2 class="text-3xl font-bold text-[#181113] tracking-tight">Quên Mật Khẩu?</h2>
                            <p class="text-[#89616f] text-base leading-relaxed">
                                Đừng lo lắng, chúng tôi sẽ giúp bạn. Nhập email đã đăng ký để nhận mã xác thực.
                            </p>
                        </div>
                        <!-- Form -->
                        <div class="flex flex-col gap-5">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#181113] text-sm font-semibold">Email</span>
                                <div class="relative">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-[#89616f] material-symbols-outlined">mail</span>
                                    <input
                                        class="w-full h-12 pl-12 pr-4 rounded-lg border border-[#e6dbdf] bg-white text-[#181113] placeholder:text-[#89616f]/70 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200"
                                        placeholder="vidu@email.com" type="email">
                                </div>
                            </label>
                            <button @click="currentView = 'otp'"
                                class="flex w-full cursor-pointer items-center justify-center rounded-lg h-12 px-6 bg-primary hover:bg-[#b00e43] text-white text-base font-bold tracking-wide transition-colors duration-200 shadow-lg shadow-primary/30">
                                Gửi mã xác thực
                            </button>
                        </div>
                        <!-- Footer Link -->
                        <div class="flex justify-center pt-2">
                            <button @click="currentView = 'login'"
                                class="flex items-center gap-2 text-sm font-medium text-[#89616f] hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">arrow_back</span>
                                Quay lại đăng nhập
                            </button>
                        </div>
                    </div>
                </div>

                <!-- OTP Verification Form -->
                <div v-else-if="currentView === 'otp'"
                    class="w-full max-w-[480px] bg-white rounded-2xl shadow-luxury overflow-hidden mx-auto">
                    <div class="flex flex-col gap-6">
                        <!-- Icon Header -->
                        <div
                            class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary mb-2">
                            <span class="material-symbols-outlined text-[28px]">security</span>
                        </div>
                        <!-- Header -->
                        <div class="flex flex-col gap-2">
                            <h2 class="text-3xl font-bold text-text-main tracking-tight">Xác thực OTP</h2>
                            <p class="text-text-sub text-base leading-relaxed">
                                Mã xác thực 6 số đã được gửi tới email <span
                                    class="font-semibold text-text-main">khachhang@email.com</span>
                            </p>
                        </div>
                        <!-- OTP Inputs -->
                        <div class="flex flex-col gap-6 py-2">
                            <div class="flex justify-between gap-2">
                                <!-- 6 Individual Input Boxes -->
                                <input
                                    class="w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border border-border-color bg-background-light focus:bg-white text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200"
                                    maxlength="1" type="text" value="5">
                                <input autofocus
                                    class="w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border border-primary bg-white text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 shadow-[0_0_0_4px_rgba(212,17,82,0.1)]"
                                    maxlength="1" type="text" value="">
                                <input
                                    class="w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border border-border-color bg-background-light focus:bg-white text-text-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200"
                                    maxlength="1" type="text" value="">
                                <input
                                    class="w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border border-border-color bg-background-light focus:bg-white text-text-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200"
                                    maxlength="1" type="text" value="">
                                <input
                                    class="w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border border-border-color bg-background-light focus:bg-white text-text-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200"
                                    maxlength="1" type="text" value="">
                                <input
                                    class="w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border border-border-color bg-background-light focus:bg-white text-text-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200"
                                    maxlength="1" type="text" value="">
                            </div>
                            <!-- Timer & Resend -->
                            <div class="text-center">
                                <p class="text-sm text-text-sub">
                                    Không nhận được mã?
                                    <button class="ml-1 font-semibold text-text-sub cursor-not-allowed" disabled>
                                        Gửi lại sau (59s)
                                    </button>
                                </p>
                            </div>
                            <button
                                class="flex w-full cursor-pointer items-center justify-center rounded-lg h-12 px-6 bg-primary hover:bg-primary-hover text-white text-base font-bold tracking-wide transition-colors duration-200 shadow-lg shadow-primary/30 mt-2">
                                Xác nhận
                            </button>
                        </div>
                        <!-- Footer Link -->
                        <div class="flex justify-center pt-2">
                            <button @click="currentView = 'forgot'"
                                class="flex items-center gap-2 text-sm font-medium text-text-sub hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">edit</span>
                                Thay đổi email
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
