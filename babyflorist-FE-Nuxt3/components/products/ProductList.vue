<script setup lang="ts">
const products = [
    {
        id: 1,
        title: 'Giỏ Quà Tết Thịnh Vượng',
        description: 'Sự kết hợp hoàn hảo giữa rượu vang nhập khẩu cao cấp và các loại bánh mứt truyền thống tuyển chọn.',
        originalPrice: '1.500.000đ',
        price: '1.500.000đ',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBaee97iKtrgVmBnYPIJ_J5OxsVuez0NdQ5ZTMvVqd7sBy5YY_iFCsUbrDqWJVaQ46ek05zIqLqKTnEHPVaqT_KmQTbaOQf_wa24ELH2vf2r2A1Fmy7Aak5H6R-Ofkr8YNqltoRJ5qfsVacsyi4p2SoPiolSNjCjTbLozmPxndq_ei27aY-m1mp4JVmv1Qot1lqvIZO487ogMsvc0tkLUlsmu3AZ3ek0ZSxlVScf4PRM-nI5l0emDoAywjWdCSJLx1pfWzuVLJYeyQ',
        tag: 'Best Seller',
        tagClass: 'bg-red-100 text-primary',
        hasDiscount: false
    },
    {
        id: 2,
        title: 'Lẵng Hoa Khai Xuân',
        description: 'Thiết kế hoa tươi rực rỡ với gam màu đỏ vàng chủ đạo, mang ý nghĩa khởi đầu may mắn, tài lộc.',
        originalPrice: '850.000đ',
        price: '850.000đ',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuA8JT3jnMZpG0tsvh_cUVEEd5T03_eL6ZWdNV_oX55OcqBSSJ1inDR2dfPdix2APPdv9CxSQJb3a3BWgJpOykyQFkmw6Zs_ZfrYI2o1EqMJ_vZV_ZVqY4f29VhIKbTMENJnsufkuM6VyYvUn9TnCvgX9f7UPUQNneEZp4WKrJXDwWU6lTYLQ9O8C5uBEJeMjdcrbsB6sdn-2p-C58F5mzeNg1uJZcDb5IGVXmCoL5Eg1w-CRHrBEEmkxxrm88GYLSYeyW-fa0KysYk',
        tag: 'New',
        tagClass: 'bg-yellow-100 text-yellow-700',
        hasDiscount: false
    },
    {
        id: 3,
        title: 'Bình Gốm Hoa Đào',
        description: 'Bình gốm thủ công Bát Tràng cắm cành đào phai dáng cổ, đậm chất Tết xưa, vượng khí cho gia chủ.',
        originalPrice: '1.500.000đ',
        price: '1.200.000đ',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCjQSlXA3jSdaISmv-8CVwU_Hyrv-TaHxxYuT_yOGlMf83XqdIpcy1Jc8uq8ejLR10oQ2qmkCx9NbXddS2e6diRAeiu6cSjvgZ_Swo-HqPc6fcmS3bk2_ZqNiwQf1hcU2a502jAS8KF01RSzDOkOMojU3ajO6w26cbFHRgV21ZTzmgQIDCa4XwxD34Esp2Qy4ZteJ1eT97Bzn-kzasYJIU0UegQ4EQB4bqTWdDjzmEn0sUbIg5I71nIGP--9-inhBkAMTwHj8M9wfE',
        tag: 'Giảm giá',
        tagClass: 'bg-orange-100 text-orange-800',
        hasDiscount: true
    },
    {
        id: 4,
        title: 'Lan Hồ Điệp Đại Sảnh',
        description: 'Chậu lan hồ điệp trắng 5 cành thiết kế sang trọng, đẳng cấp, phù hợp trưng bày phòng khách lớn.',
        originalPrice: '3.500.000đ',
        price: '3.500.000đ',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDD2jL7Yy-NZOg68K-kcGfXMJLowfi_qKqp8ol5-xC7uvPyQWp3zudEsB6CNfgBa7KGj3-xXwlhoQUf4T0JzoCpXfxV8Q1gIcnIEg515wOPrIQ4v7UY0JAYxn6JW9oYbJqUzISQhBRxeMHIrJLa8dDUPoqmH-bht8srhm7Gha3Q8d4D4oMva9lpDeVMgDMZibixi3e1D43DyCnZgWwgS9yDfYZeZa4OlLQaCjfT04L9k3JJ38REp1Wr1R6WpSwLI4xsbCNGOrFTN2c',
        tag: 'Best Seller',
        tagClass: 'bg-red-100 text-primary',
        hasDiscount: false
    },
    {
        id: 5,
        title: 'Mai Vàng Phú Quý',
        description: 'Chậu mai vàng bonsai được uốn tỉa công phu, nụ nhiều và đều, cam kết nở đúng Mùng 1 Tết.',
        originalPrice: '1.800.000đ',
        price: '1.800.000đ',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCrO4HTIXhfKuEMVKFnLMpNarrzhi3e7_eZf2pTuPB1bmTIwQpLiyMBQQRrSW4qqAhn51sGZjAMyP9-2hBm0RSDxO7tpQPRVVAbL_DmL3GbAV1JJwwdqbmpyyMWlhOtHkBQilpHD7nyB_KzIeReEvHBoz1t9cCFF9NB0EDgeaQmEMexuNaPx24gWO-gHnnEX16yvCQ3_hovVRtlxQtko455blZ9XPRnL0Yg2JSNMcFFqQhVbyJXGUvnbyMhMdPLef8fpx3baPSNHq0',
        tag: 'New',
        tagClass: 'bg-green-100 text-green-700',
        hasDiscount: false
    },
    {
        id: 6,
        title: 'Set Quà An Khang',
        description: 'Hộp quà thiết kế hiện đại gồm các loại hạt dinh dưỡng, trà hoa và mứt Tết chất lượng cao.',
        originalPrice: '650.000đ',
        price: '650.000đ',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAsVos6btThk4HuS8Q3R-pU48tvFdMefwOMGtO2s69Ke6EUZF90Il2tV7EZrtDUEXyYEYUs97qZYCfteEbiRvHS2tmz8TnkutvirHPHtcaiqZyIwT70SXarz9zHSm-AExIV_CgkWk2agQ4og3Zt0Iyz2K0hHiXHRg9ncAA4Dhk4FSOLVBvqceW5UzG8Pjs-uEJEq9MW-xea6FdhnLIFcBaT9sPvfoqdeaBtTw6zjJXXxxnaXvc_JvO22uxAk4ah5utulqwd5yFZfEw',
        tag: 'Phổ thông',
        tagClass: 'bg-purple-100 text-purple-700',
        hasDiscount: false
    }
]
</script>

<template>
    <div class="flex-1">
        <div
            class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4 bg-white dark:bg-[#1a0f0f] p-4 rounded-lg border border-gray-100 dark:border-[#3a2828] shadow-sm">
            <p class="text-base text-gray-500">Hiển thị <span class="font-bold text-[#181111] dark:text-white">{{
                products.length }}</span> sản phẩm phù hợp</p>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500 whitespace-nowrap">Sắp xếp theo:</span>
                <select
                    class="form-select bg-gray-50 dark:bg-[#2a1a1a] border-gray-200 dark:border-[#3a2828] rounded-lg text-sm focus:ring-primary focus:border-primary py-2 pl-3 pr-10 cursor-pointer outline-none">
                    <option>Mới nhất</option>
                    <option>Bán chạy nhất</option>
                    <option>Giá: Thấp đến Cao</option>
                    <option>Giá: Cao đến Thấp</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="product in products" :key="product.id"
                class="group flex flex-col bg-white dark:bg-[#1a0f0f] rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-[#3a2828] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="relative aspect-[4/3] overflow-hidden">
                    <div class="w-full h-full bg-cover bg-center transition-transform duration-700"
                        :style="{ backgroundImage: `url('${product.image}')` }"></div>
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                    <span
                        :class="[product.tagClass, 'absolute top-3 left-3 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm']">{{
                            product.tag }}</span>
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <h3
                        class="text-lg font-bold text-[#181111] dark:text-white mb-2 leading-tight group-hover:text-primary transition-colors">
                        {{ product.title }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">{{
                        product.description }}</p>
                    <div
                        class="mt-auto pt-4 border-t border-gray-50 dark:border-[#2a1a1a] flex items-center justify-between">
                        <div v-if="product.hasDiscount" class="flex flex-col">
                            <span class="text-xs text-gray-400 line-through">{{ product.originalPrice }}</span>
                            <span class="text-lg font-bold text-primary">{{ product.price }}</span>
                        </div>
                        <span v-else class="text-lg font-bold text-primary">{{ product.price }}</span>
                        <button
                            class="flex items-center gap-1 text-xs font-bold bg-[#181111] dark:bg-white text-white dark:text-[#181111] px-4 py-2.5 rounded-lg hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all shadow-md hover:shadow-lg">
                            Thêm vào giỏ
                        </button>
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
</template>
