<script setup lang="ts">
</script>

<template>
    <div class="layout-container flex h-full grow flex-col">
        <main class="site-container px-4 py-8 flex flex-col flex-1">
            <div
                class="relative w-full rounded-2xl overflow-hidden bg-[#fbf5f5] dark:bg-[#2a1a1a] mb-10 shadow-sm border border-[#f4f0f0] dark:border-[#3a2828]">
                <div class="absolute inset-0 opacity-30"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDi6tu_PFakN_PMcVOPdSmhxAjsPDOLNhl5uWgTTXPDKNkJc-jJUWxQGTguI4wDmSW-RUWu6DsPM4Uz1YleOeWbxg9mvcmRpI8rAevEO_mVVUMCeI3SSs6nimydGbMi--7CDdL-Lv0oWsWs6JgdoCDRfHNk8DrQOM9zfIUnrXZU9WeH6lUwjYZq4sp5QWsr5pe9lt28bCb26rI5dvj9QAV2JVNHLkzt-ow5R2Gb5V4nTAp7yWMW34lF8e0EidXxeQHMfCqwlyAHOt8'); background-size: cover; background-position: center;">
                </div>
                <div class="relative z-10 px-6 py-12 md:py-16 text-center max-w-3xl mx-auto">
                    <h1 class="text-3xl md:text-5xl font-black text-[#181111] dark:text-white mb-4 tracking-tight">
                        Khóa Học &amp; Workshop</h1>
                    <div class="flex items-center justify-center gap-4 mb-4">
                        <div class="h-px w-12 bg-primary/40"></div>
                        <span class="material-symbols-outlined text-primary text-2xl">local_florist</span>
                        <div class="h-px w-12 bg-primary/40"></div>
                    </div>
                    <p class="text-[#896161] dark:text-[#d4b0b0] text-lg font-medium">
                        Tham gia các lớp học cắm hoa chuyên nghiệp và workshop làm quà Tết thủ công để mang mùa xuân
                        trọn vẹn, ấm cúng về nhà.
                    </p>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row gap-8">
                <aside class="w-full lg:w-72 flex-shrink-0">
                    <div
                        class="sticky top-24 space-y-6 bg-white dark:bg-[#1a0f0f] p-6 rounded-xl border border-gray-100 dark:border-[#3a2828] shadow-sm">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-lg flex items-center gap-2 text-[#181111] dark:text-white">
                                <span class="material-symbols-outlined text-primary">filter_list</span> Bộ lọc tìm
                                kiếm
                            </h3>
                        </div>
                        <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>
                        <div>
                            <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">
                                Chủ đề</h4>
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 cursor-pointer group select-none">

                                    <input
                                        class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                                        type="checkbox" />
                                    <span
                                        class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">Cắm
                                        hoa bình</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group select-none">
                                    <input
                                        class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                                        type="checkbox" />
                                    <span
                                        class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">Bó
                                        hoa nghệ thuật</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group select-none">
                                    <input
                                        class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                                        type="checkbox" />
                                    <span
                                        class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">Giỏ
                                        quà Tết</span>
                                </label>
                            </div>
                        </div>
                        <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>
                        <div>
                            <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">
                                Cấp độ</h4>
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 cursor-pointer group select-none">
                                    <input
                                        class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                                        type="checkbox" />
                                    <span
                                        class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">Cơ
                                        bản</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group select-none">
                                    <input
                                        class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                                        type="checkbox" />
                                    <span
                                        class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">Nâng
                                        cao</span>
                                </label>
                            </div>
                        </div>
                        <div class="w-full h-px bg-gray-100 dark:bg-[#3a2828]"></div>
                        <div>
                            <h4 class="font-bold text-sm text-[#181111] dark:text-white mb-4 uppercase tracking-wider">
                                Khoảng giá</h4>
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 cursor-pointer group select-none">
                                    <input
                                        class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                                        type="checkbox" />
                                    <span
                                        class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">Dưới
                                        500k</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group select-none">
                                    <input
                                        class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                                        type="checkbox" />
                                    <span
                                        class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">500k
                                        - 1 triệu</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group select-none">
                                    <input
                                        class="w-5 h-5 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary focus:ring-2 focus:ring-offset-1 dark:bg-[#2a1a1a] dark:border-gray-600"
                                        type="checkbox" />
                                    <span
                                        class="text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors text-base">Trên
                                        1 triệu</span>
                                </label>
                            </div>
                        </div>
                        <button
                            class="w-full bg-[#221010] text-white py-3 rounded-lg font-bold text-sm hover:bg-primary transition-colors mt-4">
                            Áp dụng bộ lọc
                        </button>
                    </div>
                </aside>
                <div class="flex-1">
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4 bg-white dark:bg-[#1a0f0f] p-4 rounded-lg border border-gray-100 dark:border-[#3a2828] shadow-sm">
                        <p class="text-base text-gray-500">Hiển thị <span
                                class="font-bold text-[#181111] dark:text-white">6</span> khóa học phù hợp</p>
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-500 whitespace-nowrap">Sắp xếp theo:</span>
                            <select
                                class="form-select bg-gray-50 dark:bg-[#2a1a1a] border-gray-200 dark:border-[#3a2828] rounded-lg text-sm focus:ring-primary focus:border-primary py-2 pl-3 pr-10 cursor-pointer outline-none">
                                <option>Mới nhất</option>
                                <option>Phổ biến nhất</option>
                                <option>Giá: Thấp đến Cao</option>
                                <option>Giá: Cao đến Thấp</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div
                            class="group flex flex-col bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-[#3a2828] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center  transition-transform duration-700"
                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBaee97iKtrgVmBnYPIJ_J5OxsVuez0NdQ5ZTMvVqd7sBy5YY_iFCsUbrDqWJVaQ46ek05zIqLqKTnEHPVaqT_KmQTbaOQf_wa24ELH2vf2r2A1Fmy7Aak5H6R-Ofkr8YNqltoRJ5qfsVacsyi4p2SoPiolSNjCjTbLozmPxndq_ei27aY-m1mp4JVmv1Qot1lqvIZO487ogMsvc0tkLUlsmu3AZ3ek0ZSxlVScf4PRM-nI5l0emDoAywjWdCSJLx1pfWzuVLJYeyQ');">
                                </div>
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors">
                                </div>
                                <span
                                    class="absolute top-3 left-3 bg-red-100 text-primary text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">Hot</span>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <h3
                                    class="text-lg font-bold text-[#181111] dark:text-white mb-2 leading-tight group-hover:text-primary transition-colors">
                                    Cắm Hoa Tết Cơ Bản</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
                                    Khóa học nhập môn dành cho người mới, hướng dẫn cách chọn hoa tươi và kỹ thuật
                                    cắm bình tròn truyền thống.</p>
                                <div
                                    class="mt-auto pt-4 border-t border-gray-50 dark:border-[#2a1a1a] flex items-center justify-between">
                                    <span class="text-lg font-bold text-primary">500.000đ</span>
                                    <NuxtLink to="/course-detail"
                                        class="text-xs font-bold bg-[#181111] dark:bg-white text-white dark:text-[#181111] px-4 py-2.5 rounded-lg hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all shadow-md hover:shadow-lg">
                                        Đăng
                                        ký ngay</NuxtLink>
                                </div>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-[#3a2828] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center  transition-transform duration-700"
                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA8JT3jnMZpG0tsvh_cUVEEd5T03_eL6ZWdNV_oX55OcqBSSJ1inDR2dfPdix2APPdv9CxSQJb3a3BWgJpOykyQFkmw6Zs_ZfrYI2o1EqMJ_vZV_ZVqY4f29VhIKbTMENJnsufkuM6VyYvUn9TnCvgX9f7UPUQNneEZp4WKrJXDwWU6lTYLQ9O8C5uBEJeMjdcrbsB6sdn-2p-C58F5mzeNg1uJZcDb5IGVXmCoL5Eg1w-CRHrBEEmkxxrm88GYLSYeyW-fa0KysYk');">
                                </div>
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors">
                                </div>
                                <span
                                    class="absolute top-3 left-3 bg-yellow-100 text-yellow-700 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">Workshop</span>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <h3
                                    class="text-lg font-bold text-[#181111] dark:text-white mb-2 leading-tight group-hover:text-primary transition-colors">
                                    Workshop Giỏ Quà Tết</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
                                    Tự tay gói những giỏ quà sang trọng, tinh tế tặng đối tác và người thân với sự
                                    hướng dẫn từ nghệ nhân.</p>
                                <div
                                    class="mt-auto pt-4 border-t border-gray-50 dark:border-[#2a1a1a] flex items-center justify-between">
                                    <span class="text-lg font-bold text-primary">850.000đ</span>
                                    <button
                                        class="text-xs font-bold bg-[#181111] dark:bg-white text-white dark:text-[#181111] px-4 py-2.5 rounded-lg hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all shadow-md hover:shadow-lg">Đăng
                                        ký ngay</button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-[#3a2828] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center  transition-transform duration-700"
                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCjQSlXA3jSdaISmv-8CVwU_Hyrv-TaHxxYuT_yOGlMf83XqdIpcy1Jc8uq8ejLR10oQ2qmkCx9NbXddS2e6diRAeiu6cSjvgZ_Swo-HqPc6fcmS3bk2_ZqNiwQf1hcU2a502jAS8KF01RSzDOkOMojU3ajO6w26cbFHRgV21ZTzmgQIDCa4XwxD34Esp2Qy4ZteJ1eT97Bzn-kzasYJIU0UegQ4EQB4bqTWdDjzmEn0sUbIg5I71nIGP--9-inhBkAMTwHj8M9wfE');">
                                </div>
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors">
                                </div>
                                <span
                                    class="absolute top-3 left-3 bg-blue-100 text-blue-800 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">Nâng
                                    cao</span>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <h3
                                    class="text-lg font-bold text-[#181111] dark:text-white mb-2 leading-tight group-hover:text-primary transition-colors">
                                    Nghệ Thuật Bình Hoa Đào</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
                                    Kỹ thuật dưỡng hoa đào tươi lâu và tạo dáng thế cổ truyền mang lại vượng khí,
                                    tài lộc cho gia chủ.</p>
                                <div
                                    class="mt-auto pt-4 border-t border-gray-50 dark:border-[#2a1a1a] flex items-center justify-between">
                                    <span class="text-lg font-bold text-primary">1.200.000đ</span>
                                    <button
                                        class="text-xs font-bold bg-[#181111] dark:bg-white text-white dark:text-[#181111] px-4 py-2.5 rounded-lg hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all shadow-md hover:shadow-lg">Đăng
                                        ký ngay</button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-[#3a2828] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center  transition-transform duration-700"
                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDD2jL7Yy-NZOg68K-kcGfXMJLowfi_qKqp8ol5-xC7uvPyQWp3zudEsB6CNfgBa7KGj3-xXwlhoQUf4T0JzoCpXfxV8Q1gIcnIEg515wOPrIQ4v7UY0JAYxn6JW9oYbJqUzISQhBRxeMHIrJLa8dDUPoqmH-bht8srhm7Gha3Q8d4D4oMva9lpDeVMgDMZibixi3e1D43DyCnZgWwgS9yDfYZeZa4OlLQaCjfT04L9k3JJ38REp1Wr1R6WpSwLI4xsbCNGOrFTN2c');">
                                </div>
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors">
                                </div>
                                <span
                                    class="absolute top-3 left-3 bg-green-100 text-green-700 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">New</span>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <h3
                                    class="text-lg font-bold text-[#181111] dark:text-white mb-2 leading-tight group-hover:text-primary transition-colors">
                                    Thiết Kế Lan Hồ Điệp</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
                                    Học cách phối ghép lan hồ điệp vào chậu lớn, tạo vẻ đẹp sang trọng, đẳng cấp cho
                                    phòng khách.</p>
                                <div
                                    class="mt-auto pt-4 border-t border-gray-50 dark:border-[#2a1a1a] flex items-center justify-between">
                                    <span class="text-lg font-bold text-primary">2.500.000đ</span>
                                    <button
                                        class="text-xs font-bold bg-[#181111] dark:bg-white text-white dark:text-[#181111] px-4 py-2.5 rounded-lg hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all shadow-md hover:shadow-lg">Đăng
                                        ký ngay</button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-[#3a2828] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center  transition-transform duration-700"
                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCrO4HTIXhfKuEMVKFnLMpNarrzhi3e7_eZf2pTuPB1bmTIwQpLiyMBQQRrSW4qqAhn51sGZjAMyP9-2hBm0RSDxO7tpQPRVVAbL_DmL3GbAV1JJwwdqbmpyyMWlhOtHkBQilpHD7nyB_KzIeReEvHBoz1t9cCFF9NB0EDgeaQmEMexuNaPx24gWO-gHnnEX16yvCQ3_hovVRtlxQtko455blZ9XPRnL0Yg2JSNMcFFqQhVbyJXGUvnbyMhMdPLef8fpx3baPSNHq0');">
                                </div>
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors">
                                </div>
                                <span
                                    class="absolute top-3 left-3 bg-red-100 text-primary text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">Hot</span>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <h3
                                    class="text-lg font-bold text-[#181111] dark:text-white mb-2 leading-tight group-hover:text-primary transition-colors">
                                    Mai Vàng Phú Quý</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
                                    Khóa học chuyên sâu về chăm sóc, tuốt lá và uốn tỉa mai vàng để hoa nở đúng Mùng
                                    1 Tết.</p>
                                <div
                                    class="mt-auto pt-4 border-t border-gray-50 dark:border-[#2a1a1a] flex items-center justify-between">
                                    <span class="text-lg font-bold text-primary">1.800.000đ</span>
                                    <button
                                        class="text-xs font-bold bg-[#181111] dark:bg-white text-white dark:text-[#181111] px-4 py-2.5 rounded-lg hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all shadow-md hover:shadow-lg">Đăng
                                        ký ngay</button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-[#3a2828] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center  transition-transform duration-700"
                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAsVos6btThk4HuS8Q3R-pU48tvFdMefwOMGtO2s69Ke6EUZF90Il2tV7EZrtDUEXyYEYUs97qZYCfteEbiRvHS2tmz8TnkutvirHPHtcaiqZyIwT70SXarz9zHSm-AExIV_CgkWk2agQ4og3Zt0Iyz2K0hHiXHRg9ncAA4Dhk4FSOLVBvqceW5UzG8Pjs-uEJEq9MW-xea6FdhnLIFcBaT9sPvfoqdeaBtTw6zjJXXxxnaXvc_JvO22uxAk4ah5utulqwd5yFZfEw');">
                                </div>
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors">
                                </div>
                                <span
                                    class="absolute top-3 left-3 bg-purple-100 text-purple-700 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">Cơ
                                    bản</span>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <h3
                                    class="text-lg font-bold text-[#181111] dark:text-white mb-2 leading-tight group-hover:text-primary transition-colors">
                                    Cắm Hoa Phối Màu</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
                                    Học cách phối màu sắc hoa tươi hiện đại, phá cách, phù hợp với không gian nội
                                    thất trẻ trung.</p>
                                <div
                                    class="mt-auto pt-4 border-t border-gray-50 dark:border-[#2a1a1a] flex items-center justify-between">
                                    <span class="text-lg font-bold text-primary">650.000đ</span>
                                    <button
                                        class="text-xs font-bold bg-[#181111] dark:bg-white text-white dark:text-[#181111] px-4 py-2.5 rounded-lg hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all shadow-md hover:shadow-lg">Đăng
                                        ký ngay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-12 gap-2">
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary transition-all">
                            <span class="material-symbols-outlined text-base">chevron_left</span>
                        </button>
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white font-bold shadow-md shadow-red-200 dark:shadow-none hover:bg-red-700 transition-colors">1</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary transition-all">2</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary transition-all">3</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-[#3a2828] text-gray-500 hover:border-primary hover:text-primary transition-all">
                            <span class="material-symbols-outlined text-base">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
