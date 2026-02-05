<script setup lang="ts">
const route = useRoute()
const config = useRuntimeConfig()

// In the future, fetch product detailed data using route.params.id
// const { data: product } = await useFetch(`${config.public.apiBase}/api/products/${route.params.id}`)
</script>

<template>
    <div class="layout-container flex h-full grow flex-col">
        <main class="flex-1">
            <div class="mx-auto max-w-[1400px] px-4 py-6 lg:px-10">
                <!-- Breadcrumbs -->
                <div class="mb-8 flex flex-wrap items-center gap-2 text-sm">
                    <NuxtLink class="font-medium text-[#896168] hover:text-primary dark:text-gray-400" to="/">Trang chủ
                    </NuxtLink>
                    <span class="text-[#896168] dark:text-gray-500">/</span>
                    <NuxtLink class="font-medium text-[#896168] hover:text-primary dark:text-gray-400" to="/products">
                        Giỏ Quà Tết</NuxtLink>
                    <span class="text-[#896168] dark:text-gray-500">/</span>
                    <span class="font-medium text-[#181112] dark:text-white">Giỏ Quà Tết Phú Quý - Luxury Edition</span>
                </div>
                <!-- Product Main Section -->
                <div class="grid grid-cols-1 gap-12 lg:grid-cols-12">
                    <!-- Left: Images Gallery -->
                    <div class="lg:col-span-7">
                        <div class="flex flex-col gap-4">
                            <!-- Main Image -->
                            <div
                                class="group relative aspect-[4/3] w-full overflow-hidden rounded-xl bg-gray-100 dark:bg-[#3a2a2c]">
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                                    data-alt="Luxurious red Tet gift basket with wine and golden ornaments"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAWS8GKh-i53WsGvF6tbgjxpVOHvZJn6pfM5R1dfzjuPZ4XRslR0RLhqLfFk7hXS8K-H8qf4auiV99OBF9fGYshtZdGiER68iJ-3qje3gWrdDXeO3wmj9l85aXOlcoZcxwnH4WLYGiBb-b8csZ8PkNXchD9MPi285VAH_1uw-NfYDOhe58MP-HTI8Dq2W_zWwbou9NgJYwtwR0k-wB6QPyBTXA-8HTFq5BI0OBWn6HeXEpq0TwL0U2nd-g74E2TrFmoWceFyDo4Zb8");'>
                                </div>
                                <div
                                    class="absolute left-4 top-4 rounded-full bg-primary px-3 py-1 text-xs font-bold text-white shadow-lg">
                                    Best Seller
                                </div>
                            </div>
                            <!-- Thumbnails -->
                            <div class="grid grid-cols-4 gap-4">
                                <div
                                    class="aspect-square cursor-pointer overflow-hidden rounded-lg border-2 border-primary p-0.5">
                                    <div class="h-full w-full rounded bg-cover bg-center"
                                        data-alt="Thumbnail 1 main view"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDSMWlWs9flk1k16I6uEk7CI80PBkvtnTGJoctfaEeUiK7I39YQYAh4jh_M_qWeiDyAFqfAVfHNoLqcN_B_ojtJzz3Hd3gCOm-QZU8HoO-pSP2DB-_NwtojrI4I9g4l918gLSkXJtS2LiKyRa-jpSF4ttCueAFNl5SwiyozTIV0wXk7VdIKU1Ml8G9Em2DyLv7eE1qfVhXA0Em2Bp5T3TcbrOzQhDAgT0aSYf_s8M_OBV7ZLl_EjkK56caZsFqivEsGW2TsWDSxeZU");'>
                                    </div>
                                </div>
                                <div
                                    class="aspect-square cursor-pointer overflow-hidden rounded-lg border-2 border-transparent hover:border-primary/50">
                                    <div class="h-full w-full rounded bg-cover bg-center"
                                        data-alt="Thumbnail 2 wine detail"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD46RAKAEzRlST3RWkxknnnrjX9tLMrV7oItAF79H4X2S80gtt6PqZiweIr6DK18i_zFUznjODb0pz3XVhUR034d7qSZI1sweydPLlWCMjNFIbV3Wv11_8tkP_WGDzPlKcB4XCC5m8SupmiBCIX52knhmKNxUK8wAjLWOqHE6dJ6exEgMBUDgCATN6FcA8d2xSIfc-eJhZNQkJgfKAWdfHLkaXzdYjz2p8cXWeoWG7SCV9-B5EcatjH3UYjm2hM7OJmRlD3YfLrhIM");'>
                                    </div>
                                </div>
                                <div
                                    class="aspect-square cursor-pointer overflow-hidden rounded-lg border-2 border-transparent hover:border-primary/50">
                                    <div class="h-full w-full rounded bg-cover bg-center"
                                        data-alt="Thumbnail 3 nuts detail"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDiCpL656sbKARcMGPIblu5sAWB9UGOVrqNAk7nIVjGm5v_T4ZWkBqq-J4UIRQJKZ76gSkLijbn4mA3WsaAq1uhCRui-bTH-iQVvBgtAWXSeD0YsWY-0CljVsFujevR3KZ3Hm1hXaUTiGmw4NiDuhLsUVvV1VqdXaHj9k8sbrF0pqOoM_ZsbK5zq83tXMBsePWVuaxjMrZ2zQV57qYVl7lpGK-HNK-iW5X_yC4JVxRFb82K29hOWi-dqZaZ75_kRh63Kku0NNSg1f0");'>
                                    </div>
                                </div>
                                <div
                                    class="aspect-square cursor-pointer overflow-hidden rounded-lg border-2 border-transparent hover:border-primary/50">
                                    <div class="h-full w-full rounded bg-cover bg-center"
                                        data-alt="Thumbnail 4 packaging detail"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDmfh2ZtntHLxEQxHqqSH4SByQvPZSutZ_gkItBJoO2JiqQT1rhm11NyWP5ug3OFOM2QbvcEF-FlE9t7FMZoB9XILDuHtQ1zHt-xqooWOhx-vlckRs0VkNG_v95dB2eO81_FxaussJTIC8_yi8TnQENR5Cx0I3C2dtOJ_aG3BMk0Xt4Zjkfb1cZmZxJk5oFU5jsWIr2cnvFU2T6bmBz6YdmILSDayD4sOq-_irbn1n80xHDw57yhoIf6nT56-qn7nynwHd04e2cWJE");'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right: Product Info -->
                    <div class="flex flex-col gap-6 lg:col-span-5">
                        <div>
                            <div
                                class="mb-2 inline-flex items-center gap-1 rounded bg-[#b49b56]/20 px-2 py-1 text-xs font-bold text-[#b49b56]">
                                <span class="material-symbols-outlined text-[14px]">workspace_premium</span>
                                QUÀ TẶNG CAO CẤP
                            </div>
                            <h1
                                class="font-display text-3xl font-bold leading-tight text-[#181112] dark:text-white lg:text-4xl">
                                Giỏ Quà Tết Phú Quý - Phiên Bản Rồng Vàng
                            </h1>

                            <div class="flex items-center gap-2 mt-2">
                                <div class="flex text-gold text-sm">
                                    <span class="material-symbols-outlined text-[18px] fill-1">star</span>
                                    <span class="material-symbols-outlined text-[18px] fill-1">star</span>
                                    <span class="material-symbols-outlined text-[18px] fill-1">star</span>
                                    <span class="material-symbols-outlined text-[18px] fill-1">star</span>
                                    <span class="material-symbols-outlined text-[18px] fill-1">star_half</span>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">(45 đánh giá)</span>
                            </div>
                            <div class="flex items-end mt-6 gap-3 border-b border-gray-100 dark:border-white/10">
                                <span class="text-primary text-3xl md:text-4xl font-bold">1.850.000₫</span>
                                <span class="text-gray-400 text-lg line-through mb-1">2.200.000₫</span>
                                <span class="text-xs font-bold text-white bg-primary px-2 py-1 rounded mb-2">-15%</span>
                            </div>
                        </div>
                        <div class="h-px w-full bg-[#f4f0f1] dark:bg-[#3a2a2c]"></div>
                        <p class="text-base leading-relaxed text-[#5e4a4e] dark:text-gray-300">
                            Món quà thượng hạng gửi gắm lời chúc An Khang - Thịnh Vượng. Sự kết hợp tinh tế giữa rượu
                            vang đỏ cao cấp nhập khẩu và các loại hạt dinh dưỡng tuyển chọn, được đóng gói trong hộp da
                            thủ công sang trọng.
                        </p>
                        <!-- Specifications -->
                        <div
                            class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-[#f4f0f1] dark:bg-[#2c181b] dark:ring-[#3a2a2c]">
                            <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-[#181112] dark:text-white">
                                Thông số sản phẩm</h3>
                            <div class="flex flex-col gap-3">
                                <div
                                    class="flex justify-between border-b border-dashed border-[#f4f0f1] pb-2 dark:border-[#3a2a2c]">
                                    <span class="text-sm text-[#896168] dark:text-gray-400">Kích thước</span>
                                    <span class="text-sm font-medium text-[#181112] dark:text-white">42 x 35 x 18
                                        cm</span>
                                </div>
                                <div
                                    class="flex justify-between border-b border-dashed border-[#f4f0f1] pb-2 dark:border-[#3a2a2c]">
                                    <span class="text-sm text-[#896168] dark:text-gray-400">Xuất xứ rượu</span>
                                    <span class="text-sm font-medium text-[#181112] dark:text-white">Chile / Pháp</span>
                                </div>
                                <div
                                    class="flex justify-between border-b border-dashed border-[#f4f0f1] pb-2 dark:border-[#3a2a2c]">
                                    <span class="text-sm text-[#896168] dark:text-gray-400">Thành phần</span>
                                    <span class="text-sm font-medium text-[#181112] dark:text-white">Rượu vang, Hạt
                                        Macca, Hạnh nhân...</span>
                                </div>
                                <div class="flex justify-between pt-1">
                                    <span class="text-sm text-[#896168] dark:text-gray-400">Hạn sử dụng</span>
                                    <span class="text-sm font-medium text-[#181112] dark:text-white">12 tháng</span>
                                </div>
                            </div>
                        </div>
                        <!-- Quantity & Actions -->
                        <div class="mt-4 flex flex-col gap-4">
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-medium text-[#181112] dark:text-white">Số lượng:</span>
                                <div
                                    class="flex h-10 w-32 items-center rounded-lg border border-[#e5e0e1] dark:border-[#3a2a2c]">
                                    <button
                                        class="flex h-full w-10 items-center justify-center text-[#181112] hover:bg-gray-100 dark:text-white dark:hover:bg-[#3a2a2c]">
                                        <span class="material-symbols-outlined text-sm">remove</span>
                                    </button>
                                    <input
                                        class="h-full w-12 border-none bg-transparent text-center text-sm font-medium text-[#181112] focus:ring-0 dark:text-white"
                                        type="text" value="1" />
                                    <button
                                        class="flex h-full w-10 items-center justify-center text-[#181112] hover:bg-gray-100 dark:text-white dark:hover:bg-[#3a2a2c]">
                                        <span class="material-symbols-outlined text-sm">add</span>
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <button
                                    class="flex h-12 items-center justify-center gap-2 rounded-lg border border-primary bg-white text-base font-bold text-primary transition-colors hover:bg-primary/5 dark:bg-transparent">
                                    <span class="material-symbols-outlined">add_shopping_cart</span>
                                    Thêm vào giỏ
                                </button>
                                <button
                                    class="flex h-12 items-center justify-center gap-2 rounded-lg bg-primary text-base font-bold text-white shadow-lg shadow-primary/30 transition-colors hover:bg-primary/90">
                                    Mua ngay
                                </button>
                            </div>
                            <!-- Trust Badges -->
                            <div
                                class="mt-4 flex items-center justify-center gap-6 text-xs text-[#896168] dark:text-gray-400">
                                <div class="flex items-center gap-1">
                                    <span
                                        class="material-symbols-outlined text-[18px] text-green-600">verified_user</span>
                                    <span>Chính hãng 100%</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span
                                        class="material-symbols-outlined text-[18px] text-blue-600">local_shipping</span>
                                    <span>Giao hàng toàn quốc</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tabs Section -->
                <div class="mt-20">
                    <div class="border-b border-[#e5e0e1] dark:border-[#3a2a2c]">
                        <div class="flex gap-8 overflow-x-auto">
                            <button
                                class="border-b-2 border-primary pb-4 text-base font-bold text-primary transition-colors">
                                Chi tiết thành phần
                            </button>
                            <button
                                class="border-b-2 border-transparent pb-4 text-base font-medium text-[#896168] transition-colors hover:text-primary dark:text-gray-400">
                                Hướng dẫn bảo quản
                            </button>
                            <button
                                class="border-b-2 border-transparent pb-4 text-base font-medium text-[#896168] transition-colors hover:text-primary dark:text-gray-400">
                                Chính sách giao hàng Tết
                            </button>
                            <button
                                class="border-b-2 border-transparent pb-4 text-base font-medium text-[#896168] transition-colors hover:text-primary dark:text-gray-400">
                                Đánh giá (24)
                            </button>
                        </div>
                    </div>
                    <div class="py-8">
                        <!-- Tab Content Example -->
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-12">
                            <div class="prose max-w-none text-[#5e4a4e] dark:text-gray-300 md:col-span-7">
                                <p class="mb-4">Bộ quà tết Phú Quý được tuyển chọn từ những nguyên liệu thượng hạng
                                    nhất, đảm bảo vệ sinh an toàn thực phẩm và mang lại trải nghiệm ẩm thực tuyệt vời
                                    cho ngày Tết cổ truyền.</p>
                                <ul class="list-disc space-y-2 pl-5">
                                    <li><strong>Rượu Vang Đỏ Cabernet Sauvignon (750ml):</strong> Nhập khẩu nguyên chai
                                        từ Chile, hương vị đậm đà, chát nhẹ, phù hợp với các món ăn ngày Tết.</li>
                                    <li><strong>Hạt Macca Úc (250g):</strong> Hạt to, đều, nứt vỏ tự nhiên, giàu dinh
                                        dưỡng.</li>
                                    <li><strong>Hạnh Nhân Rang Bơ Mỹ (200g):</strong> Thơm béo, giòn tan.</li>
                                    <li><strong>Trà Oolong Cao Cấp (100g):</strong> Vị thanh, hậu ngọt, tốt cho sức
                                        khỏe.</li>
                                    <li><strong>Bánh Cookies Bơ Pháp (150g):</strong> Hộp thiếc sang trọng.</li>
                                </ul>
                                <div class="mt-6 p-4 bg-primary/5 rounded-lg border border-primary/10">
                                    <p class="text-sm italic">
                                        *Lưu ý: Mẫu mã trang trí (nơ, hoa lụa) có thể thay đổi nhẹ tùy theo từng đợt
                                        hàng
                                        nhưng vẫn đảm bảo tính thẩm mỹ và giá trị của giỏ quà.
                                    </p>
                                </div>
                            </div>
                            <div class="relative overflow-hidden rounded-2xl group min-h-[300px] md:col-span-5">
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDmfh2ZtntHLxEQxHqqSH4SByQvPZSutZ_gkItBJoO2JiqQT1rhm11NyWP5ug3OFOM2QbvcEF-FlE9t7FMZoB9XILDuHtQ1zHt-xqooWOhx-vlckRs0VkNG_v95dB2eO81_FxaussJTIC8_yi8TnQENR5Cx0I3C2dtOJ_aG3BMk0Xt4Zjkfb1cZmZxJk5oFU5jsWIr2cnvFU2T6bmBz6YdmILSDayD4sOq-_irbn1n80xHDw57yhoIf6nT56-qn7nynwHd04e2cWJE");'>
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                                </div>
                                <div
                                    class="absolute inset-0 flex flex-col items-center justify-end pb-10 px-8 text-center">
                                    <div class="w-12 h-[1px] bg-secondary mb-4 opacity-70"></div>
                                    <h4
                                        class="font-display text-2xl md:text-3xl font-bold text-white mb-2 italic tracking-wide">
                                        Nghệ thuật trong từng chi tiết
                                    </h4>
                                    <p class="text-secondary/90 text-sm font-medium tracking-widest uppercase">
                                        Trao gửi tâm tình trong từng món quà
                                    </p>
                                    <div class="w-12 h-[1px] bg-secondary mt-4 opacity-70"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Related Products -->
                    <div class="mt-12 border-t border-[#e5e0e1] pt-12 dark:border-[#3a2a2c]">
                        <div class="mb-8 flex items-center justify-between">
                            <h3 class="text-2xl font-bold text-[#181112] dark:text-white">Sản phẩm tương tự</h3>
                            <a class="flex items-center gap-1 text-sm font-bold text-primary hover:underline" href="#">
                                Xem tất cả
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                            <!-- Product Card 1 -->
                            <div
                                class="group flex flex-col gap-3 rounded-xl bg-white p-3 transition-shadow hover:shadow-lg dark:bg-[#2c181b]">
                                <div class="relative aspect-[4/3] w-full overflow-hidden rounded-lg bg-gray-100">
                                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                                        data-alt="Modern gift box with dried fruits"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDTEuzlCsA_m4lhLPa9Tz5EVk9IHicLau9WzKDtSfCIeZxufxB6xO8RU8OR8n1Da8HgXBA1EGnXasv_x3-uu1JCYKM5Va2cBEA8h_v5aSTQYHLVH8Bv2MSVT_lefaTRzHCfyWAZJRJUNuwZa1Q8rolAd3dHuOC1Q32832ylQGD-avvOZ4RCO1XsThGpAamXEy_NZYKaCMl-QKEBKfH8O9GhuW0UUO82bafruv42A1qt9MzGjI5h0guj4zIQhFcEE4M53r_yE2VbIuU");'>
                                    </div>
                                    <button
                                        class="absolute right-3 top-3 flex size-8 items-center justify-center rounded-full bg-white/80 text-[#181112] opacity-0 transition-opacity hover:bg-primary hover:text-white group-hover:opacity-100">
                                        <span class="material-symbols-outlined text-sm">favorite</span>
                                    </button>
                                </div>
                                <div class="flex flex-col gap-1 px-1">
                                    <h4
                                        class="line-clamp-2 text-base font-bold text-[#181112] group-hover:text-primary dark:text-white">
                                        Hộp Quà Tết An Khang - Mẫu 2024</h4>
                                    <span class="text-sm font-bold text-primary">1.850.000₫</span>
                                </div>
                                <button
                                    class="mt-2 w-full rounded-lg bg-[#f4f0f1] py-2 text-sm font-bold text-[#181112] transition-colors hover:bg-primary hover:text-white dark:bg-[#3a2a2c] dark:text-white dark:hover:bg-primary">
                                    Thêm vào giỏ
                                </button>
                            </div>
                            <!-- Product Card 2 -->
                            <div
                                class="group flex flex-col gap-3 rounded-xl bg-white p-3 transition-shadow hover:shadow-lg dark:bg-[#2c181b]">
                                <div class="relative aspect-[4/3] w-full overflow-hidden rounded-lg bg-gray-100">
                                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                                        data-alt="Elegant tea set gift box"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCXJ1quCLHbQbP-jzGF2gkbLxkah78LP-9kdI1eYGl2nJXIm-ve2LKIuuZXjL0hx5uFcg-SC5PKy5ksSBRFUh62IXy2ED9eryGOOLe98LdeqV6-118FqSf-3TnAK3OsGuMbuPC_UjFrJ-QrROazis0yddtTHfx2-Gv4dJooH8IY937oUKBU88n120iOPuL2kWAUXp-0UeeKfG4HOreJJPKJU5PekR6SGtxIXYImShV7KU0_fMK8fHbB0gnO-ry0ekBl5m73YbfIRcU");'>
                                    </div>
                                    <button
                                        class="absolute right-3 top-3 flex size-8 items-center justify-center rounded-full bg-white/80 text-[#181112] opacity-0 transition-opacity hover:bg-primary hover:text-white group-hover:opacity-100">
                                        <span class="material-symbols-outlined text-sm">favorite</span>
                                    </button>
                                </div>
                                <div class="flex flex-col gap-1 px-1">
                                    <h4
                                        class="line-clamp-2 text-base font-bold text-[#181112] group-hover:text-primary dark:text-white">
                                        Set Quà Trà Thảo Mộc Cung Đình</h4>
                                    <span class="text-sm font-bold text-primary">1.200.000₫</span>
                                </div>
                                <button
                                    class="mt-2 w-full rounded-lg bg-[#f4f0f1] py-2 text-sm font-bold text-[#181112] transition-colors hover:bg-primary hover:text-white dark:bg-[#3a2a2c] dark:text-white dark:hover:bg-primary">
                                    Thêm vào giỏ
                                </button>
                            </div>
                            <!-- Product Card 3 -->
                            <div
                                class="group flex flex-col gap-3 rounded-xl bg-white p-3 transition-shadow hover:shadow-lg dark:bg-[#2c181b]">
                                <div class="relative aspect-[4/3] w-full overflow-hidden rounded-lg bg-gray-100">
                                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                                        data-alt="Luxury skincare gift set"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA1JNl1aak_jC_KOew_zvy9DJ8ZfnJpFTO4a8d_JnaCdVYkaCJTa4ta2SmRINOtCh3vF6fPiCiHBHG4MURM8HNlMIAlsSktVCl4hGfZ-nxtqgO4XFIjWITTPse-cleM0w6al3JgUbbSJxsVPQBq1KyEGagzZvWu3IWe5B93R14N307GEWZu3N73u3xpwR0J_-vyoYf4Xc1_xU9IwYe9GpURfB9QoTsXWrFgqQKLt9R6-p0mzj1XRyoVH5wf6w3GjDGOjLgxy2HCTNg");'>
                                    </div>
                                    <button
                                        class="absolute right-3 top-3 flex size-8 items-center justify-center rounded-full bg-white/80 text-[#181112] opacity-0 transition-opacity hover:bg-primary hover:text-white group-hover:opacity-100">
                                        <span class="material-symbols-outlined text-sm">favorite</span>
                                    </button>
                                </div>
                                <div class="flex flex-col gap-1 px-1">
                                    <h4
                                        class="line-clamp-2 text-base font-bold text-[#181112] group-hover:text-primary dark:text-white">
                                        Giỏ Quà Sức Khỏe - Yến Sào Cao Cấp</h4>
                                    <span class="text-sm font-bold text-primary">3.500.000₫</span>
                                </div>
                                <button
                                    class="mt-2 w-full rounded-lg bg-[#f4f0f1] py-2 text-sm font-bold text-[#181112] transition-colors hover:bg-primary hover:text-white dark:bg-[#3a2a2c] dark:text-white dark:hover:bg-primary">
                                    Thêm vào giỏ
                                </button>
                            </div>
                            <!-- Product Card 4 -->
                            <div
                                class="group flex flex-col gap-3 rounded-xl bg-white p-3 transition-shadow hover:shadow-lg dark:bg-[#2c181b]">
                                <div class="relative aspect-[4/3] w-full overflow-hidden rounded-lg bg-gray-100">
                                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                                        data-alt="Golden wrapped chocolate box"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAzStGGFV4_2uMD1utwln3MqqpqTPwj-W2JiSwrSKOdCzvpP1FCvj43ilqIH8NNgl0aV825E-q8T9QO2m4Dq8ptAx3hQwW8DuWw9cn9TXgT6vBYHKVLOCs8nXTsUjv-9BX-eROKS30-3ZuWOIYBuV1GcqdkC5sLIUo09CgIOR9tjzh6nsWVyQu9_RYd17k3OYl3iiIIXel5IRd1IR8Qsgh66jq9ZWPTD1PJo4aAWof5uAZk4hNTmF8mQ6jxvbM_d3ADYBgKLDWcYlQ");'>
                                    </div>
                                    <button
                                        class="absolute right-3 top-3 flex size-8 items-center justify-center rounded-full bg-white/80 text-[#181112] opacity-0 transition-opacity hover:bg-primary hover:text-white group-hover:opacity-100">
                                        <span class="material-symbols-outlined text-sm">favorite</span>
                                    </button>
                                </div>
                                <div class="flex flex-col gap-1 px-1">
                                    <h4
                                        class="line-clamp-2 text-base font-bold text-[#181112] group-hover:text-primary dark:text-white">
                                        Hộp Quà Socola Bỉ - Golden Edition</h4>
                                    <span class="text-sm font-bold text-primary">950.000₫</span>
                                </div>
                                <button
                                    class="mt-2 w-full rounded-lg bg-[#f4f0f1] py-2 text-sm font-bold text-[#181112] transition-colors hover:bg-primary hover:text-white dark:bg-[#3a2a2c] dark:text-white dark:hover:bg-primary">
                                    Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
