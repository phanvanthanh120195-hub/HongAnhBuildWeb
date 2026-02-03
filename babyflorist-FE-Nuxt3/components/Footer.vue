<script setup lang="ts">
const email = ref('')
</script>

<template>
    <footer class="bg-[#1a0f0f] text-white/80 pt-24 pb-12 border-t border-white/5">
        <div class="max-w-[1600px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-20">
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-6 text-white">
                        <div class="size-10 bg-primary flex items-center justify-center rounded-lg">
                            <span class="material-symbols-outlined text-3xl">local_florist</span>
                        </div>
                        <h3 class="font-black text-2xl tracking-tighter">Baby <span class="text-gold">Florist</span>
                        </h3>
                    </div>
                    <p class="text-white/60 leading-relaxed mb-8 max-w-sm">
                        Lan tỏa vẻ đẹp hoa Việt, gìn giữ nét xuân truyền thống qua từng tác phẩm nghệ thuật đương
                        đại.
                    </p>
                    <div class="flex gap-4">
                        <a class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary transition-all group"
                            href="#">
                            <svg class="w-6 h-6 fill-current group-hover:scale-110 transition-transform"
                                viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z">
                                </path>
                            </svg>
                        </a>
                        <a class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary transition-all group"
                            href="#">
                            <svg class="w-6 h-6 fill-current group-hover:scale-110 transition-transform"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z">
                                </path>
                            </svg>
                        </a>
                        <a class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary transition-all group"
                            href="#">
                            <svg class="w-6 h-6 fill-current group-hover:scale-110 transition-transform"
                                viewBox="0 0 24 24">
                                <path
                                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 4-8 4z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="font-black text-white uppercase tracking-widest text-sm mb-8">Liên kết nhanh</h4>
                    <ul class="flex flex-col gap-4 text-sm font-medium">
                        <li><a class="hover:text-gold transition-colors" href="#">Trang chủ</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Tất cả khóa học</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Sản phẩm quà tặng</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Tin tức &amp; Sự kiện</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Thư viện hình ảnh</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-black text-white uppercase tracking-widest text-sm mb-8">Chính sách</h4>
                    <ul class="flex flex-col gap-4 text-sm font-medium">
                        <li><a class="hover:text-gold transition-colors" href="#">Chính sách bảo mật</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Điều khoản sử dụng</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Chính sách đổi trả</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Chính sách vận chuyển</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Chương trình thành viên</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-black text-white uppercase tracking-widest text-sm mb-8">Đăng ký nhận tin</h4>
                    <p class="text-xs mb-6 text-white/50">Nhận thông tin về các buổi workshop mới nhất và mã giảm
                        giá sớm nhất.</p>
                    <div class="flex flex-col gap-3">
                        <input
                            class="bg-white/5 border border-white/10 rounded-full px-5 py-3 text-sm w-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Email của bạn" type="email" />
                        <button
                            class="bg-primary hover:bg-red-700 text-white rounded-full px-5 py-3 text-sm font-black transition-colors uppercase tracking-widest">Gửi
                            ngay</button>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-col md:flex-row justify-between items-center pt-10 border-t border-white/5 text-xs font-bold text-white/40 tracking-widest uppercase">
                <p>© 2026 Baby Florist. ALL RIGHTS RESERVED.</p>
                <p class="mt-4 md:mt-0">DESIGNED & CODED BY PHAN VĂN THÀNH</p>
            </div>
        </div>
    </footer>
</template>
