<script setup>
const isDrawerOpen = ref(false);
</script>

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
                                class="flex items-center gap-4 px-6 py-4 hover:bg-stone-50 dark:hover:bg-stone-800 text-stone-600 dark:text-stone-400 transition-all border-l-4 border-transparent hover:border-stone-300"
                                to="/infor/change-password">
                                <span class="material-icons-outlined">lock</span>
                                Đổi mật khẩu
                            </NuxtLink>
                        </li>
                        <li>
                            <NuxtLink
                                class="flex items-center gap-4 px-6 py-4 bg-red-50 dark:bg-red-900/20 text-primary font-semibold border-l-4 border-primary transition-all"
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
                <div class="flex items-center justify-between mb-2 min-w-[1000px]">
                    <h2 class="display-font text-3xl font-bold flex items-center gap-3">
                        <span class="w-10 h-[2px] bg-primary"></span>
                        Lịch sử đơn hàng
                    </h2>
                    <span class="text-stone-500 text-sm">3 đơn hàng gần đây</span>
                </div>
                <div class="order-card mt-6">
                    <div
                        class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-stone-100 dark:border-stone-800">
                        <div class="flex items-center gap-8">
                            <div>
                                <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Mã đơn
                                    hàng</p>
                                <p class="font-bold text-stone-900 dark:text-stone-100">#HT-202401</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Ngày mua
                                </p>
                                <p class="font-medium">15/01/2024</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Tổng tiền
                                </p>
                                <p class="font-bold text-primary">1.250.000đ</p>
                            </div>
                        </div>
                        <div>
                            <span
                                class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full uppercase tracking-wide">
                                Đã thanh toán
                            </span>
                        </div>
                    </div>
                    <div class="py-6 space-y-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-20 h-20 rounded-lg overflow-hidden bg-stone-100 border border-stone-200 dark:border-stone-700 shrink-0">
                                <img alt="Workshop" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDoWf7h7KREKzeuE8TqBRSkWq1JbCGo8Kdkg5aIoVysKKhIN9x4F20quY9SfmEyJoZLcGqDUA3jUb1-fKi7zw-FdlqXU--0rQzUOqWbY5NFe8vHz2ZGudvba5IuhLsBwy9CRNKFXjZ7iicWp5HaXdOrwROyDlPKJ65qyiyL3yOTNgb7N8-ojA0ybGY7FOf5E5Dz6jh33oyulg9nz_HPrfqdVPn4ZNH8fNMHLzdyjguupTicPAZw-_6zDNojasDObjPYwbwzn2wUTE0" />
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-semibold text-lg text-stone-800 dark:text-stone-200">Workshop: Cắm Hoa
                                    Đào Nghệ Thuật</h3>
                                <p class="text-sm text-stone-500">Giảng viên: Nghệ nhân Trần Thu</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">850.000đ</p>
                                <p class="text-xs text-stone-400">SL: 01</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-20 h-20 rounded-lg overflow-hidden bg-stone-100 border border-stone-200 dark:border-stone-700 shrink-0">
                                <img alt="Giỏ quà" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCE9EOP2dMQw4pC9O3z1jVT3zHfVQMH5XqUqd8mHL0K5uBRCmg9KkSSQLAU4hJxIRpcfczWDN2cKB6_ZEd-vnzWt6veyeE7pBRExz5OURSvQ6eg2EaWEAbRBUlWNtIfmOKhSQc7qGac5IooAKeJprhdnpeWzwSlCQPRTklLr-VX3yS2S811IOrnjzccHP5dJeZYXgoMzE_rhjq76-Vijv6mYyES3Q-kWc_wGV-CbyRhKA84pySVrXeDHnvMcLk7OyKufI07VZn-uw" />
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-semibold text-lg text-stone-800 dark:text-stone-200">Set Phụ Kiện Giỏ
                                    Quà Tết Sang Trọng</h3>
                                <p class="text-sm text-stone-500">Kích thước: L - Vàng Kim</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">400.000đ</p>
                                <p class="text-xs text-stone-400">SL: 01</p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-stone-100 dark:border-stone-800 flex justify-end">
                        <button class="flex items-center gap-2 text-primary font-bold text-sm group"
                            @click="isDrawerOpen = true">
                            <span class="group-hover:underline decoration-2 underline-offset-4">XEM CHI TIẾT</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </button>
                    </div>
                </div>
                <div class="order-card mt-6">
                    <div
                        class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-stone-100 dark:border-stone-800">
                        <div class="flex items-center gap-8">
                            <div>
                                <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Mã đơn
                                    hàng</p>
                                <p class="font-bold text-stone-900 dark:text-stone-100">#HT-202395</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Ngày mua
                                </p>
                                <p class="font-medium">08/01/2024</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Tổng tiền
                                </p>
                                <p class="font-bold text-primary">2.100.000đ</p>
                            </div>
                        </div>
                        <div>
                            <span
                                class="px-3 py-1 bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 text-xs font-bold rounded-full uppercase tracking-wide">
                                Đang xử lý
                            </span>
                        </div>
                    </div>
                    <div class="py-6 space-y-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-20 h-20 rounded-lg overflow-hidden bg-stone-100 border border-stone-200 dark:border-stone-700 shrink-0">
                                <img alt="Workshop" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDEf6J2jLc8RU397-P0DYuhoiHpT_vSVtYtXaRh8rccc4bceJnJT7mQxa-dqDcbw-82XEXTjG-9vrQLH0rXkgiBCinh12xF8KvJDahAwnOY8N0HGU02VWxsxTcxMYiHUdt-OvZdHqytUSCNMBLks9P0lxinQzm6xFYzNOnukMXzwvZIMivEHS2wJ0833sVgoJVSPU0m6GAU6pV4ZqbaZuQtQww50py91IOOZK1EqHCReiiQxPrKc8Uui7D-1FDEcQBm02ijsOaic1U" />
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-semibold text-lg text-stone-800 dark:text-stone-200">Trọn bộ Workshop
                                    Giỏ Quà Tết Cao Cấp</h3>
                                <p class="text-sm text-stone-500">Khóa học Offline tại Hà Nội</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">2.100.000đ</p>
                                <p class="text-xs text-stone-400">SL: 01</p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-stone-100 dark:border-stone-800 flex justify-end">
                        <button class="flex items-center gap-2 text-primary font-bold text-sm group"
                            @click="isDrawerOpen = true">
                            <span class="group-hover:underline decoration-2 underline-offset-4">XEM CHI TIẾT</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </button>
                    </div>
                </div>
                <div class="order-card opacity-75 grayscale-[0.3] mt-6">
                    <div
                        class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-stone-100 dark:border-stone-800">
                        <div class="flex items-center gap-8">
                            <div>
                                <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Mã đơn
                                    hàng</p>
                                <p class="font-bold text-stone-900 dark:text-stone-100">#HT-202388</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Ngày mua
                                </p>
                                <p class="font-medium">28/12/2023</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Tổng tiền
                                </p>
                                <p class="font-bold text-primary">550.000đ</p>
                            </div>
                        </div>
                        <div>
                            <span
                                class="px-3 py-1 bg-stone-100 text-stone-600 dark:bg-stone-800 dark:text-stone-400 text-xs font-bold rounded-full uppercase tracking-wide">
                                Đã hủy
                            </span>
                        </div>
                    </div>
                    <div class="py-6 space-y-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-20 h-20 rounded-lg overflow-hidden bg-stone-100 border border-stone-200 dark:border-stone-700 shrink-0">
                                <img alt="Sách" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuACxU5AWTQfRvUPzOMDUvoFltUjr6CgTeaNjeqsSKqXXufGHlbaR5G3yCbUlxTxaI4zOSfH9qACB91GVEqlYqn93WE1yvp52riQlnA43_wOuqeMjJMX8ubkLa_JqMVOK7zv4pRLRkTJglsg6pvfReYe27kmf8S1BkZzRKRBthik1aGPv4K6q6ceRZ_khvZocSHpKe-0pS4AwSa_YGmYs9JZeZfmtcUJ2Iqi5Ntdxdh0SwfZR99IqU2HWVkLnXrRB2Ij85YDAG2aRZc" />
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-semibold text-lg text-stone-800 dark:text-stone-200">Ebook: Cẩm Nang
                                    Trang Trí Tết Hiện Đại</h3>
                                <p class="text-sm text-stone-500">Định dạng PDF / Tải xuống trực tuyến</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">550.000đ</p>
                                <p class="text-xs text-stone-400">SL: 01</p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-stone-100 dark:border-stone-800 flex justify-end">
                        <button
                            class="flex items-center gap-2 text-stone-500 font-bold text-sm group hover:text-stone-700"
                            @click="isDrawerOpen = true">
                            <span class="group-hover:underline decoration-2 underline-offset-4">XEM CHI TIẾT</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Drawer -->
    <Transition enter-active-class="transition-opacity duration-300 ease-out" enter-from-class="opacity-0"
        enter-to-class="opacity-100" leave-active-class="transition-opacity duration-200 ease-in"
        leave-from-class="opacity-100" leave-to-class="opacity-0">
        <div v-if="isDrawerOpen" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50" @click="isDrawerOpen = false">
        </div>
    </Transition>

    <Transition enter-active-class="transform transition ease-in-out duration-300" enter-from-class="translate-x-full"
        enter-to-class="translate-x-0" leave-active-class="transform transition ease-in-out duration-300"
        leave-from-class="translate-x-0" leave-to-class="translate-x-full">
        <div v-if="isDrawerOpen"
            class="fixed inset-y-0 right-0 w-full max-w-md h-full bg-white dark:bg-stone-900 shadow-2xl z-50 flex flex-col border-l border-stone-200 dark:border-stone-800">
            <div
                class="p-6 border-b border-stone-100 dark:border-stone-800 flex items-center justify-between bg-stone-50 dark:bg-stone-900">
                <div>
                    <h2 class="display-font text-2xl font-bold text-primary mb-1">Chi tiết đơn hàng</h2>
                    <p class="text-stone-500 text-sm font-medium">#HT-202401</p>
                </div>
                <button @click="isDrawerOpen = false" class="rounded-full transition-colors text-stone-500">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto drawer-content p-6 space-y-8">
                <div class="relative pl-4 border-l-2 border-stone-200 dark:border-stone-800 space-y-6">
                    <div class="relative">
                        <div
                            class="absolute -left-[21px] w-4 h-4 rounded-full bg-primary border-4 border-white dark:border-stone-900">
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-stone-900 dark:text-stone-100">Đặt hàng thành công</p>
                            <p class="text-xs text-stone-500">15/01/2024 - 09:30</p>
                        </div>
                    </div>
                    <div class="relative">
                        <div
                            class="absolute -left-[21px] w-4 h-4 rounded-full bg-primary border-4 border-white dark:border-stone-900">
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-stone-900 dark:text-stone-100">Thanh toán hoàn tất</p>
                            <p class="text-xs text-stone-500">15/01/2024 - 09:35</p>
                        </div>
                    </div>
                    <div class="relative">
                        <div
                            class="absolute -left-[21px] w-4 h-4 rounded-full bg-gold border-4 border-white dark:border-stone-900 animate-pulse">
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-gold">Đang xử lý</p>
                            <p class="text-xs text-stone-500">Đang đóng gói quà tặng...</p>
                        </div>
                    </div>
                    <div class="relative opacity-50">
                        <div
                            class="absolute -left-[21px] w-4 h-4 rounded-full bg-stone-300 dark:bg-stone-700 border-4 border-white dark:border-stone-900">
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-stone-400">Hoàn thành</p>
                            <p class="text-xs text-stone-400">Dự kiến 17/01/2024</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-stone-800 dark:text-stone-200 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg text-primary">shopping_bag</span>
                        Sản phẩm
                    </h3>
                    <div class="space-y-4">
                        <div
                            class="flex gap-4 p-3 rounded-xl bg-stone-50 dark:bg-stone-800/50 border border-stone-100 dark:border-stone-800">
                            <div
                                class="w-16 h-16 rounded-lg overflow-hidden border border-stone-200 dark:border-stone-700 shrink-0">
                                <img alt="Product" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDoWf7h7KREKzeuE8TqBRSkWq1JbCGo8Kdkg5aIoVysKKhIN9x4F20quY9SfmEyJoZLcGqDUA3jUb1-fKi7zw-FdlqXU--0rQzUOqWbY5NFe8vHz2ZGudvba5IuhLsBwy9CRNKFXjZ7iicWp5HaXdOrwROyDlPKJ65qyiyL3yOTNgb7N8-ojA0ybGY7FOf5E5Dz6jh33oyulg9nz_HPrfqdVPn4ZNH8fNMHLzdyjguupTicPAZw-_6zDNojasDObjPYwbwzn2wUTE0" />
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-stone-800 dark:text-stone-200 line-clamp-1">
                                    Workshop: Cắm Hoa Đào Nghệ Thuật</h4>
                                <p class="text-xs text-stone-500 mb-1">Giảng viên: Trần Thu</p>
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-stone-600 dark:text-stone-400">x1</span>
                                    <span class="font-bold text-stone-900 dark:text-stone-100">850.000đ</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex gap-4 p-3 rounded-xl bg-stone-50 dark:bg-stone-800/50 border border-stone-100 dark:border-stone-800">
                            <div
                                class="w-16 h-16 rounded-lg overflow-hidden border border-stone-200 dark:border-stone-700 shrink-0">
                                <img alt="Product" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCE9EOP2dMQw4pC9O3z1jVT3zHfVQMH5XqUqd8mHL0K5uBRCmg9KkSSQLAU4hJxIRpcfczWDN2cKB6_ZEd-vnzWt6veyeE7pBRExz5OURSvQ6eg2EaWEAbRBUlWNtIfmOKhSQc7qGac5IooAKeJprhdnpeWzwSlCQPRTklLr-VX3yS2S811IOrnjzccHP5dJeZYXgoMzE_rhjq76-Vijv6mYyES3Q-kWc_wGV-CbyRhKA84pySVrXeDHnvMcLk7OyKufI07VZn-uw" />
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-stone-800 dark:text-stone-200 line-clamp-1">Set
                                    Phụ Kiện Giỏ Quà Tết Sang Trọng</h4>
                                <p class="text-xs text-stone-500 mb-1">Size L - Vàng Kim</p>
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-stone-600 dark:text-stone-400">x1</span>
                                    <span class="font-bold text-stone-900 dark:text-stone-100">400.000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-stone-800 dark:text-stone-200 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg text-primary">receipt_long</span>
                        Thanh toán
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-stone-600 dark:text-stone-400">
                            <span>Tạm tính</span>
                            <span>1.250.000đ</span>
                        </div>
                        <div class="flex justify-between text-stone-600 dark:text-stone-400">
                            <span>Giảm giá (Voucher TẾT)</span>
                            <span class="text-green-600">-50.000đ</span>
                        </div>
                        <div class="flex justify-between text-stone-600 dark:text-stone-400">
                            <span>Phí vận chuyển</span>
                            <span>50.000đ</span>
                        </div>
                        <div
                            class="pt-3 border-t border-dashed border-stone-200 dark:border-stone-700 flex justify-between items-center">
                            <span class="font-bold text-stone-900 dark:text-stone-100">Tổng cộng</span>
                            <span class="font-bold text-xl text-primary">1.250.000đ</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-stone-100 dark:border-stone-800 bg-stone-50 dark:bg-stone-900">
                <a href="/bill" target="_blank"
                    class="w-full bg-stone-900 dark:bg-stone-100 hover:bg-stone-800 dark:hover:bg-stone-200 text-white dark:text-stone-900 py-3 rounded-xl font-medium transition-colors flex items-center justify-center gap-2 mb-3 shadow-lg">
                    <span class="material-symbols-outlined text-xl">download</span>
                    Tải Hóa Đơn
                </a>
                <button
                    class="w-full text-stone-500 hover:text-stone-800 dark:hover:text-stone-200 text-sm font-medium transition-colors">
                    Cần trợ giúp? Liên hệ CSKH
                </button>
            </div>
        </div>
    </Transition>
</template>
