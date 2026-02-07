<script setup>
const { user, logout } = useAuth()

// Helper to get avatar URL
const getAvatarUrl = (customer) => {
    if (customer?.avatar) {
        if (customer.avatar.startsWith('http')) return customer.avatar;
        const config = useRuntimeConfig();
        return `${config.public.apiBase}/storage/${customer.avatar}`;
    }
    // Fallback using UI Avatars
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(customer?.name || 'User')}&background=random&color=fff`;
}

const handleLogout = async () => {
    await logout()
    navigateTo('/')
}
</script>

<template>
    <aside class="w-full lg:w-1/4 space-y-6">
        <div
            class="bg-white dark:bg-stone-900 rounded-2xl p-8 shadow-sm border border-stone-100 dark:border-stone-800 text-center">
            <div class="relative inline-block group">
                <div
                    class="w-32 h-32 rounded-full bg-stone-100 dark:bg-stone-800 border-4 border-stone-50 dark:border-stone-700 mx-auto flex items-center justify-center overflow-hidden mb-4">
                    <img v-if="user" :src="getAvatarUrl(user)" alt="User Avatar" class="w-full h-full object-cover" />
                    <span v-else class="display-font text-5xl text-stone-400 font-bold">A</span>
                </div>
                <!-- <button
                    class="absolute bottom-1 right-1 bg-white dark:bg-stone-700 p-2 rounded-full shadow-lg border border-stone-200 dark:border-stone-600 hover:text-primary transition-colors">
                    <span class="material-icons-outlined text-sm">photo_camera</span>
                </button> -->
            </div>
            <h2 class="display-font text-xl font-bold mt-2">{{ user?.name || 'Khách' }}</h2>
            <p class="text-sm text-stone-500 dark:text-stone-400">{{ user?.email || '' }}</p>
        </div>
        <nav
            class="bg-white dark:bg-stone-900 rounded-2xl overflow-hidden shadow-sm border border-stone-100 dark:border-stone-800">
            <ul class="divide-y divide-stone-100 dark:divide-stone-800">
                <li>
                    <NuxtLink class="flex items-center gap-4 px-6 py-4 transition-all border-l-4"
                        active-class="bg-red-50 dark:bg-red-900/20 text-primary font-semibold border-primary"
                        class-active="bg-red-50 dark:bg-red-900/20 text-primary font-semibold border-primary" :class="[
                            $route.path === '/infor/profile'
                                ? ''
                                : 'hover:bg-stone-50 dark:hover:bg-stone-800 text-stone-600 dark:text-stone-400 border-transparent hover:border-stone-300'
                        ]" to="/infor/profile">
                        <span class="material-icons-outlined">person</span>
                        Hồ sơ cá nhân
                    </NuxtLink>
                </li>
                <li>
                    <NuxtLink class="flex items-center gap-4 px-6 py-4 transition-all border-l-4"
                        active-class="bg-red-50 dark:bg-red-900/20 text-primary font-semibold border-primary" :class="[
                            $route.path === '/infor/change-password'
                                ? ''
                                : 'hover:bg-stone-50 dark:hover:bg-stone-800 text-stone-600 dark:text-stone-400 border-transparent hover:border-stone-300'
                        ]" to="/infor/change-password">
                        <span class="material-icons-outlined">lock</span>
                        Đổi mật khẩu
                    </NuxtLink>
                </li>
                <li>
                    <NuxtLink class="flex items-center gap-4 px-6 py-4 transition-all border-l-4"
                        active-class="bg-red-50 dark:bg-red-900/20 text-primary font-semibold border-primary" :class="[
                            $route.path === '/infor/order-history'
                                ? ''
                                : 'hover:bg-stone-50 dark:hover:bg-stone-800 text-stone-600 dark:text-stone-400 border-transparent hover:border-stone-300'
                        ]" to="/infor/order-history">
                        <span class="material-icons-outlined">history</span>
                        Lịch sử đơn hàng
                    </NuxtLink>
                </li>
                <li>
                    <a class="flex items-center gap-4 px-6 py-4 hover:bg-red-50 dark:hover:bg-red-900/10 text-red-600 transition-all border-l-4 border-transparent hover:border-red-200 cursor-pointer"
                        @click.prevent="handleLogout">
                        <span class="material-icons-outlined">logout</span>
                        Đăng xuất
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
</template>