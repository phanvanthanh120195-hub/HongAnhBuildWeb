<template>
    <main class="max-w-[1400px] mx-auto px-6 py-12 min-h-[60vh]">
        <div class="flex flex-col lg:flex-row gap-8">
            <aside class="w-full lg:w-1/4 space-y-6">
                <div
                    class="bg-white dark:bg-stone-900 rounded-2xl p-8 shadow-sm border border-stone-100 dark:border-stone-800 text-center">
                    <div class="relative inline-block group">
                        <div
                            class="w-32 h-32 rounded-full bg-stone-100 dark:bg-stone-800 border-4 border-stone-50 dark:border-stone-700 mx-auto flex items-center justify-center overflow-hidden mb-4">
                            <span class="display-font text-5xl text-stone-400 font-bold">A</span>
                        </div>
                        <button
                            class="absolute bottom-1 right-1 bg-white dark:bg-stone-700 p-2 rounded-full shadow-lg border border-stone-200 dark:border-stone-600 hover:text-primary transition-colors">
                            <span class="material-icons-outlined text-sm">photo_camera</span>
                        </button>
                    </div>
                    <h2 class="display-font text-xl font-bold mt-2"></h2>
                    <p class="text-sm text-stone-500 dark:text-stone-400"></p>
                </div>
                <nav
                    class="bg-white dark:bg-stone-900 rounded-2xl overflow-hidden shadow-sm border border-stone-100 dark:border-stone-800">
                    <ul class="divide-y divide-stone-100 dark:divide-stone-800">
                        <li>
                            <NuxtLink
                                class="flex items-center gap-4 px-6 py-4 hover:bg-stone-50 dark:hover:bg-stone-800 text-stone-600 dark:text-stone-400 transition-all border-l-4 border-transparent hover:border-stone-300"
                                to="/profile">
                                <span class="material-icons-outlined">person</span>
                                Thông tin cá nhân
                            </NuxtLink>
                        </li>
                        <li>
                            <NuxtLink
                                class="flex items-center gap-4 px-6 py-4 bg-red-50 dark:bg-red-900/20 text-primary font-semibold border-l-4 border-primary transition-all"
                                to="/change-password">
                                <span class="material-icons-outlined">lock</span>
                                Đổi mật khẩu
                            </NuxtLink>
                        </li>
                        <li>
                            <NuxtLink
                                class="flex items-center gap-4 px-6 py-4 hover:bg-stone-50 dark:hover:bg-stone-800 text-stone-600 dark:text-stone-400 transition-all border-l-4 border-transparent hover:border-stone-300"
                                to="/order-history">
                                <span class="material-icons-outlined">history</span>
                                Lịch sử đơn hàng
                            </NuxtLink>
                        </li>
                        <li>
                            <a class="flex items-center gap-4 px-6 py-4 hover:bg-red-50 dark:hover:bg-red-900/10 text-red-600 transition-all border-l-4 border-transparent hover:border-red-200"
                                href="#">
                                <span class="material-icons-outlined">logout</span>
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <section class="w-full lg:w-3/4">
                <div
                    class="bg-white dark:bg-stone-900 rounded-2xl p-8 lg:p-10 shadow-sm border border-stone-100 dark:border-stone-800 min-w-[1000px]">
                    <div>
                        <div class="mb-10">
                            <h2 class="display-font text-3xl font-bold mb-2 flex items-center gap-3">
                                <span class="w-8 h-[2px] bg-primary"></span>
                                Đổi mật khẩu
                            </h2>
                        </div>
                        <form class="space-y-8">
                            <div class="space-y-2">
                                <label class="text-base font-semibold text-stone-600 dark:text-stone-400 ml-1">Mật khẩu
                                    mới</label>
                                <div class="relative group">
                                    <span
                                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 group-focus-within:text-primary transition-colors">lock_reset</span>
                                    <input
                                        class="w-full pl-12 pr-12 py-3.5 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                        placeholder="••••••••" type="password" />
                                    <button
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600 dark:hover:text-stone-200 transition-colors"
                                        type="button">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-base font-semibold text-stone-600 dark:text-stone-400 ml-1">Xác nhận
                                    mật khẩu mới</label>
                                <div class="relative group">
                                    <span
                                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 group-focus-within:text-primary transition-colors">verified_user</span>
                                    <input
                                        class="w-full pl-12 pr-12 py-3.5 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                        placeholder="••••••••" type="password" />
                                    <button
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600 dark:hover:text-stone-200 transition-colors"
                                        type="button">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex justify-start pt-4">
                                <button
                                    class="bg-primary hover:bg-red-800 text-white font-bold py-4 px-10 rounded-lg shadow-lg shadow-red-900/20 hover:shadow-red-900/40 transition-all active:scale-95 flex items-center gap-3"
                                    type="submit">
                                    <span class="material-symbols-outlined">update</span>
                                    CẬP NHẬT MẬT KHẨU
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
</template>
