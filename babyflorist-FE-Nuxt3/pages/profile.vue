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
                                class="flex items-center gap-4 px-6 py-4 bg-red-50 dark:bg-red-900/20 text-primary font-semibold border-l-4 border-primary transition-all"
                                to="/profile">
                                <span class="material-icons-outlined">person</span>
                                Thông tin cá nhân
                            </NuxtLink>
                        </li>
                        <li>
                            <NuxtLink
                                class="flex items-center gap-4 px-6 py-4 hover:bg-stone-50 dark:hover:bg-stone-800 text-stone-600 dark:text-stone-400 transition-all border-l-4 border-transparent hover:border-stone-300"
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
                    <div class="mb-10">
                        <h2 class="display-font text-2xl font-bold mb-6 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-primary"></span>
                            Thông tin cá nhân
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Họ và
                                    tên</label>
                                <input
                                    class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                    placeholder="Nhập họ và tên" type="text" value="" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Số điện
                                    thoại</label>
                                <input
                                    class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                    placeholder="Nhập số điện thoại" type="tel" value="" />
                            </div>
                            <div class="md:col-span-2 space-y-2">
                                <label
                                    class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Email</label>
                                <input
                                    class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                    placeholder="example@email.com" type="email" value="" />
                            </div>
                        </div>
                    </div>
                    <hr class="border-stone-100 dark:border-stone-800 mb-10" />
                    <div class="mb-10">
                        <h2 class="display-font text-2xl font-bold mb-6 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-primary"></span>
                            Địa chỉ nhận hàng
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Tỉnh/Thành
                                    phố</label>
                                <select
                                    class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none appearance-none cursor-pointer">
                                    <option value="">Chọn Tỉnh/Thành</option>
                                    <option value="hanoi">Hà Nội</option>
                                    <option value="hcm">TP. Hồ Chí Minh</option>
                                    <option value="danang">Đà Nẵng</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Quận/Huyện</label>
                                <select
                                    class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none appearance-none cursor-pointer">
                                    <option value="">Chọn Quận/Huyện</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Phường/Xã</label>
                                <select
                                    class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none appearance-none cursor-pointer">
                                    <option value="">Chọn Phường/Xã</option>
                                </select>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Địa chỉ cụ
                                thể</label>
                            <textarea
                                class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none resize-none"
                                placeholder="Số nhà, tên đường..." rows="4"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-start">
                        <button
                            class="bg-primary hover:bg-red-800 text-white font-bold py-4 px-10 rounded-lg shadow-lg shadow-red-900/20 hover:shadow-red-900/40 transition-all active:scale-95 flex items-center gap-2">
                            <span class="material-icons-outlined">save</span>
                            LƯU THAY ĐỔI
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </main>
</template>
