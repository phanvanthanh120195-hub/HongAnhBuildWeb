<template>
    <section class="bg-white py-24">
        <div class="max-w-[1400px] mx-auto px-6 md:px-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-4xl font-black text-[#722F37]">Khóa Học</h2>
                    <p class="text-gray-500 mt-2 text-lg">Học viên thực hành trực tiếp dưới sự hướng dẫn tỉ mỉ
                    </p>
                </div>
                <a class="text-primary font-bold flex items-center gap-2 group" href="#">
                    <span class="group-hover:underline">Xem tất cả khóa học</span> <span
                        class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-3xl mb-6">
                        <div class="aspect-[4/3] bg-center bg-cover transition-transform duration-700 group-hover:scale-110"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBaee97iKtrgVmBnYPIJ_J5OxsVuez0NdQ5ZTMvVqd7sBy5YY_iFCsUbrDqWJVaQ46ek05zIqLqKTnEHPVaqT_KmQTbaOQf_wa24ELH2vf2r2A1Fmy7Aak5H6R-Ofkr8YNqltoRJ5qfsVacsyi4p2SoPiolSNjCjTbLozmPxndq_ei27aY-m1mp4JVmv1Qot1lqvIZO487ogMsvc0tkLUlsmu3AZ3ek0ZSxlVScf4PRM-nI5l0emDoAywjWdCSJLx1pfWzuVLJYeyQ");'>
                        </div>
                        <span
                            class="absolute top-3 left-3 bg-yellow-100 text-yellow-700 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">Workshop</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-3 text-gray-400 text-sm font-medium">
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-sm">calendar_today</span>
                                20/01/2024</span>
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-sm">schedule</span> 3 tiếng</span>
                        </div>
                        <h3 class="text-2xl font-black group-hover:text-primary transition-colors">Cắm Hoa Tết
                            Cơ Bản</h3>
                        <p class="text-gray-500 line-clamp-2">Làm quen với các loại hoa Tết truyền thống và kỹ
                            thuật giữ hoa tươi lâu.</p>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-2xl font-black text-primary">500.000đ</span>
                        </div>
                    </div>
                </div>
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-3xl mb-6">
                        <div class="aspect-[4/3] bg-center bg-cover transition-transform duration-700 group-hover:scale-110"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA8JT3jnMZpG0tsvh_cUVEEd5T03_eL6ZWdNV_oX55OcqBSSJ1inDR2dfPdix2APPdv9CxSQJb3a3BWgJpOykyQFkmw6Zs_ZfrYI2o1EqMJ_vZV_ZVqY4f29VhIKbTMENJnsufkuM6VyYvUn9TnCvgX9f7UPUQNneEZp4WKrJXDwWU6lTYLQ9O8C5uBEJeMjdcrbsB6sdn-2p-C58F5mzeNg1uJZcDb5IGVXmCoL5Eg1w-CRHrBEEmkxxrm88GYLSYeyW-fa0KysYk");'>
                        </div>
                        <span
                            class="absolute top-3 left-3 bg-yellow-100 text-yellow-700 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">Workshop</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-3 text-gray-400 text-sm font-medium">
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-sm">calendar_today</span>
                                22/01/2024</span>
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-sm">schedule</span> 4 tiếng</span>
                        </div>
                        <h3 class="text-2xl font-black group-hover:text-primary transition-colors">Workshop Giỏ
                            Quà Tết</h3>
                        <p class="text-gray-500 line-clamp-2">Thiết kế giỏ quà tặng cao cấp kết hợp hoa tươi và
                            các sản phẩm đặc sản.</p>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-2xl font-black text-primary">850.000đ</span>
                        </div>
                    </div>
                </div>
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-3xl mb-6">
                        <div class="aspect-[4/3] bg-center bg-cover transition-transform duration-700 group-hover:scale-110"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCjQSlXA3jSdaISmv-8CVwU_Hyrv-TaHxxYuT_yOGlMf83XqdIpcy1Jc8uq8ejLR10oQ2qmkCx9NbXddS2e6diRAeiu6cSjvgZ_Swo-HqPc6fcmS3bk2_ZqNiwQf1hcU2a502jAS8KF01RSzDOkOMojU3ajO6w26cbFHRgV21ZTzmgQIDCa4XwxD34Esp2Qy4ZteJ1eT97Bzn-kzasYJIU0UegQ4EQB4bqTWdDjzmEn0sUbIg5I71nIGP--9-inhBkAMTwHj8M9wfE");'>
                        </div>
                        <span
                            class="absolute top-3 left-3 bg-yellow-100 text-yellow-700 text-[10px] font-black px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">Workshop</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-3 text-gray-400 text-sm font-medium">
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-sm">calendar_today</span>
                                25/01/2024</span>
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-sm">schedule</span> 5 tiếng</span>
                        </div>
                        <h3 class="text-2xl font-black group-hover:text-primary transition-colors">Nghệ Thuật
                            Bình Hoa Đào</h3>
                        <p class="text-gray-500 line-clamp-2">Kỹ thuật tạo hình bonsai cho đào rừng và đào phai
                            theo phong cách truyền thống.</p>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-2xl font-black text-primary">1.200.000đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
