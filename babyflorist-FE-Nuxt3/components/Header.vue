<script setup lang="ts">
import { ref, onMounted } from 'vue'
import AuthPopup from '~/components/auth/AuthPopup.vue'

const showAuthPopup = ref(false)
const isCartOpen = useIsCartOpen()
const { user, logout, fetchUser } = useAuth()

// Helper to get avatar URL
const getAvatarUrl = (customer: any) => {
    if (customer?.avatar) {
        if (customer.avatar.startsWith('http')) return customer.avatar;
        const config = useRuntimeConfig();
        return `${config.public.apiBase}/storage/${customer.avatar}`;
    }
    // Fallback using UI Avatars
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(customer?.name || 'User')}&background=random&color=fff`;
}

// Fetch user on mount to restore session
onMounted(() => {
    fetchUser()
})

const handleLogout = async () => {
    await logout()
}
</script>

<template>
    <header
        class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f4f0f0] bg-white px-6 md:px-10 py-4 shadow-sm">
        <div class="flex items-center gap-4 text-[#181111] max-w-[1600px] mx-auto w-full">
            <NuxtLink to="/" class="flex items-center gap-3">
                <div class="size-10 bg-primary text-white flex items-center justify-center rounded-lg">
                    <span class="material-symbols-outlined text-3xl">local_florist</span>
                </div>
                <h2 class="text-xl font-black leading-tight tracking-tight text-primary">Baby <span
                        class="text-gold">Florist</span></h2>
            </NuxtLink>
            <div class="flex flex-1 justify-end gap-8">
                <nav class="hidden lg:flex items-center gap-9">
                    <NuxtLink
                        class="text-sm font-semibold leading-normal hover:text-primary transition-colors uppercase tracking-wider"
                        to="/" exact-active-class="text-primary">Trang chủ</NuxtLink>
                    <NuxtLink
                        class="text-sm font-semibold leading-normal hover:text-primary transition-colors uppercase tracking-wider"
                        to="/courses" active-class="text-primary">Khóa học</NuxtLink>
                    <NuxtLink
                        class="text-sm font-semibold leading-normal hover:text-primary transition-colors uppercase tracking-wider"
                        to="/products" active-class="text-primary">Sản phẩm</NuxtLink>
                    <NuxtLink
                        class="text-sm font-semibold leading-normal hover:text-primary transition-colors uppercase tracking-wider"
                        to="/blog" active-class="text-primary">Blog</NuxtLink>
                    <NuxtLink
                        class="text-sm font-semibold leading-normal hover:text-primary transition-colors uppercase tracking-wider"
                        to="/contact" active-class="text-primary">Liên hệ</NuxtLink>
                </nav>
                <div class="flex items-center gap-4">
                    <button @click="isCartOpen = true"
                        class="relative p-2 text-[#181111] hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-2xl">shopping_cart</span>
                        <!-- TODO: Connect cart count -->
                        <span
                            class="absolute -top-1 -right-1 bg-primary text-white text-[10px] font-bold size-5 flex items-center justify-center rounded-full border-2 border-white">2</span>
                    </button>
                    <!-- User Dropdown -->
                    <ClientOnly>
                        <div class="relative group" v-if="user">
                            <button
                                class="flex items-center justify-center size-11 rounded-full border-2 border-gold/30 p-0.5 hover:border-gold transition-all duration-300">
                                <div class="w-full h-full rounded-full bg-cover bg-center"
                                    :style="{ backgroundImage: `url('${getAvatarUrl(user)}')` }">
                                </div>
                            </button>
                            <div
                                class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl shadow-2xl user-dropdown opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[100] overflow-hidden">
                                <div class="bg-primary/5 p-4 border-b border-gray-100">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-0.5">Xin
                                        chào,</p>
                                    <p class="text-sm font-black text-primary truncate">{{ user.name }}</p>
                                </div>
                                <div class="flex flex-col">
                                    <NuxtLink
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-light-beige hover:text-primary transition-colors"
                                        to="/profile">
                                        <span class="material-symbols-outlined text-xl text-gold">person</span>
                                        Hồ sơ cá nhân
                                    </NuxtLink>
                                    <NuxtLink
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-light-beige hover:text-primary transition-colors"
                                        to="/order-history">
                                        <span class="material-symbols-outlined text-xl text-gold">receipt_long</span>
                                        Lịch sử đơn hàng
                                    </NuxtLink>
                                    <div class="h-px bg-gray-100 mx-4 my-1"></div>
                                    <button @click="handleLogout"
                                        class="flex w-full items-center gap-3 px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors text-left">
                                        <span class="material-symbols-outlined text-xl">logout</span>
                                        Đăng xuất
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button v-else @click="showAuthPopup = true"
                            class="flex min-w-[120px] cursor-pointer items-center justify-center rounded-lg h-11 px-6 bg-primary hover:bg-[#5a252b] text-white text-sm font-bold transition-all shadow-md">
                            Đăng nhập
                        </button>
                    </ClientOnly>
                </div>
            </div>
        </div>
    </header>
    <Teleport to="body">
        <AuthPopup v-if="showAuthPopup" @close="showAuthPopup = false" />
    </Teleport>
</template>
