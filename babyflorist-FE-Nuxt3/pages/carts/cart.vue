<template>
    <div class="flex-1 flex flex-col items-center w-full">
        <div class="max-w-[1400px] w-full px-6 lg:px-20 py-8">
            <!-- Breadcrumbs -->
            <nav class="flex flex-wrap gap-2 py-4 mb-4">
                <NuxtLink to="/" class="text-[#9a4c52] dark:text-[#c08287] text-sm font-medium hover:underline">Trang
                    chủ</NuxtLink>
                <span class="text-[#9a4c52] dark:text-[#c08287] text-sm font-medium">/</span>
                <span class="text-[#1b0d0f] dark:text-white text-sm font-medium">Giỏ hàng của bạn</span>
            </nav>
            <!-- Page Heading -->
            <div class="flex flex-wrap justify-between items-end gap-3 pb-6">
                <h1 class="text-[#1b0d0f] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Giỏ
                    hàng của bạn</h1>
                <p class="text-[#9a4c52] dark:text-[#c08287] font-medium">(2 khóa học/sản phẩm)</p>
            </div>
            <!-- Cart Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Left: Product List -->
                <div class="lg:col-span-2 space-y-6">
                    <div
                        class="bg-white dark:bg-[#2d1b1d] rounded-xl border border-[#e7cfd1] dark:border-[#3d2a2c] overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-primary/5 dark:bg-primary/10 border-b border-[#e7cfd1] dark:border-[#3d2a2c]">
                                    <th
                                        class="px-6 py-4 text-sm font-bold text-[#1b0d0f] dark:text-white uppercase tracking-wider">
                                        Sản phẩm</th>
                                    <th
                                        class="px-6 py-4 text-sm font-bold text-[#1b0d0f] dark:text-white uppercase tracking-wider hidden md:table-cell">
                                        Giá</th>
                                    <th
                                        class="px-6 py-4 text-sm font-bold text-[#1b0d0f] dark:text-white uppercase tracking-wider">
                                        Số lượng</th>
                                    <th
                                        class="px-6 py-4 text-sm font-bold text-[#1b0d0f] dark:text-white uppercase tracking-wider text-right">
                                        Tổng</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e7cfd1] dark:divide-[#3d2a2c]">
                                <!-- Product Row 1 -->
                                <tr class="group">
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="size-20 rounded-lg bg-cover bg-center shrink-0 border border-[#e7cfd1] dark:border-[#3d2a2c]"
                                                data-alt="Traditional Tet flower arrangement workshop"
                                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBiZAj79OJYNl2Yc8Z1kfjF5e6ZEh8CFTN61HURLKUBZwVRuxWP3Av_SS3b7dNCgpWPQAT4ikxxnrgbbGf6wJKAUCFGOSTtRSmi9qD-nKQ2lvgQMlrVCRyFNFVxGvXNilpiA0A_TrXmsgrulALgZJ5szPZEmKVV4J77vf4MvgfKVwfcLTZBn8f_dZ04ORR1hmYwHEBm1AywZNyDwHHfS2oPhKXAbM-i3eg0Wb5jmMRt5GPeAz8pieDDNwZxGcJZ3h9hnXw337U_Md8");'>
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm text-primary font-bold uppercase tracking-wide">Workshop</span>
                                                <h3 class="text-[#1b0d0f] dark:text-white font-bold text-lg">Khóa
                                                    học cắm hoa Tết Bình An</h3>
                                                <button
                                                    class="text-[#9a4c52] dark:text-[#c08287] text-xs mt-2 flex items-center gap-1 hover:text-primary transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                    Xóa khỏi giỏ
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 hidden md:table-cell">
                                        <span class="text-[#1b0d0f] dark:text-white font-medium">1.500.000đ</span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div
                                            class="flex items-center border border-[#e7cfd1] dark:border-[#3d2a2c] rounded-lg w-fit bg-background-light dark:bg-background-dark">
                                            <button class="p-2 hover:text-primary"><span
                                                    class="material-symbols-outlined text-sm">remove</span></button>
                                            <span class="px-3 font-bold text-sm">1</span>
                                            <button class="p-2 hover:text-primary"><span
                                                    class="material-symbols-outlined text-sm">add</span></button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        <span class="text-primary font-bold text-lg">1.500.000đ</span>
                                    </td>
                                </tr>
                                <!-- Product Row 2 -->
                                <tr class="group">
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="size-20 rounded-lg bg-cover bg-center shrink-0 border border-[#e7cfd1] dark:border-[#3d2a2c]"
                                                data-alt="Luxury Tet gift basket with flowers and wine"
                                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDy0geSOUeW_Ww9TNiNxuZZrLD9sSKJa5Xrsh6AxjrYJnrmi6hpChcyzWOOLTh-W8uKXOXhAC2VC-_RmXAfEjczVZlhmMHXIH7XMMYlfQu_KF4JL6jOpkx25zkrcIVqEECtpFM2pJaE7DVbDcyeKDcCjn41OiLiEXH95qky5cWbe2ppZYMFJUN-avruyZHouLfDryXQF0kae6i5_iqcan2GIthNBwSrP38UgytKuu0GDjTXNeI64vcM0DDdx8SaqlByl955uZWhUO4");'>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-sm text-primary font-bold uppercase tracking-wide">Sản
                                                    phẩm</span>
                                                <h3 class="text-[#1b0d0f] dark:text-white font-bold text-lg">Giỏ quà
                                                    Tết Phú Quý</h3>
                                                <button
                                                    class="text-[#9a4c52] dark:text-[#c08287] text-xs mt-2 flex items-center gap-1 hover:text-primary transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                    Xóa khỏi giỏ
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 hidden md:table-cell">
                                        <span class="text-[#1b0d0f] dark:text-white font-medium">2.200.000đ</span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div
                                            class="flex items-center border border-[#e7cfd1] dark:border-[#3d2a2c] rounded-lg w-fit bg-background-light dark:bg-background-dark">
                                            <button class="p-2 hover:text-primary"><span
                                                    class="material-symbols-outlined text-sm">remove</span></button>
                                            <span class="px-3 font-bold text-sm">1</span>
                                            <button class="p-2 hover:text-primary"><span
                                                    class="material-symbols-outlined text-sm">add</span></button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        <span class="text-primary font-bold text-lg">2.200.000đ</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Extra Actions -->
                    <div class="flex justify-between items-center px-4">
                        <NuxtLink to="/products"
                            class="flex items-center gap-2 text-primary font-bold hover:gap-3 transition-all">
                            <span class="material-symbols-outlined">arrow_back</span>
                            Tiếp tục mua sắm
                        </NuxtLink>
                    </div>
                </div>
                <!-- Right: Order Summary -->
                <div class="space-y-6">
                    <div
                        class="bg-white dark:bg-[#2d1b1d] p-6 rounded-xl border border-[#e7cfd1] dark:border-[#3d2a2c] shadow-sm">
                        <h2
                            class="text-xl font-black text-[#1b0d0f] dark:text-white border-b border-[#e7cfd1] dark:border-[#3d2a2c] pb-4 mb-6">
                            Đơn hàng của bạn</h2>
                        <div class="space-y-4 mb-8">
                            <div class="flex gap-4">
                                <div class="size-16 rounded-lg bg-cover bg-center shrink-0 border border-[#e7cfd1]"
                                    style="background-image: url(&quot;https://lh3.googleusercontent.com/aida-public/AB6AXuBiZAj79OJYNl2Yc8Z1kfjF5e6ZEh8CFTN61HURLKUBZwVRuxWP3Av_SS3b7dNCgpWPQAT4ikxxnrgbbGf6wJKAUCFGOSTtRSmi9qD-nKQ2lvgQMlrVCRyFNFVxGvXNilpiA0A_TrXmsgrulALgZJ5szPZEmKVV4J77vf4MvgfKVwfcLTZBn8f_dZ04ORR1hmYwHEBm1AywZNyDwHHfS2oPhKXAbM-i3eg0Wb5jmMRt5GPeAz8pieDDNwZxGcJZ3h9hnXw337U_Md8&quot;);">
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
                                    style="background-image: url(&quot;https://lh3.googleusercontent.com/aida-public/AB6AXuDy0geSOUeW_Ww9TNiNxuZZrLD9sSKJa5Xrsh6AxjrYJnrmi6hpChcyzWOOLTh-W8uKXOXhAC2VC-_RmXAfEjczVZlhmMHXIH7XMMYlfQu_KF4JL6jOpkx25zkrcIVqEECtpFM2pJaE7DVbDcyeKDcCjn41OiLiEXH95qky5cWbe2ppZYMFJUN-avruyZHouLfDryXQF0kae6i5_iqcan2GIthNBwSrP38UgytKuu0GDjTXNeI64vcM0DDdx8SaqlByl955uZWhUO4&quot;);">
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
                                        placeholder="Nhập mã giảm giá..." type="text">
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
                                <NuxtLink to="/checkout"
                                    class="w-full bg-primary hover:bg-[#b80e1c] text-white py-4 rounded-xl font-bold text-lg shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-3 uppercase tracking-widest">
                                    THANH TOÁN NGAY
                                    <span class="material-symbols-outlined">payments</span>
                                </NuxtLink>
                            </div>
                        </div>
                    </div>
                    <!-- Security Badges -->
                    <div class="flex flex-col items-center gap-4 p-4 text-[#9a4c52] dark:text-[#c08287]">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600">verified_user</span>
                            <span class="text-xs uppercase font-bold tracking-widest">Thanh toán bảo mật 100%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
useHead({
    title: 'Giỏ hàng của bạn - Hoa Tết Art'
})
</script>
