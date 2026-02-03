<script setup lang="ts">
const isCartOpen = useIsCartOpen()

const closeCart = () => {
    isCartOpen.value = false
}
</script>

<template>
    <Teleport to="body">
        <Transition name="cart">
            <div v-if="isCartOpen" class="fixed inset-0 z-[100] flex justify-end side-cart-overlay"
                @click.self="closeCart">
                <div class="w-full max-w-md bg-white h-full shadow-2xl flex flex-col drawer-content">
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <h2 class="text-xl font-black text-primary tracking-tight">GIỎ HÀNG CỦA BẠN</h2>
                            <span class="bg-primary text-white text-xs font-bold px-2 py-0.5 rounded-full">2</span>
                        </div>
                        <button @click="closeCart" class="transition-colors">
                            <span class="material-symbols-outlined text-gray-400">close</span>
                        </button>
                    </div>
                    <div class="flex-1 overflow-y-auto p-6 space-y-6">
                        <div class="flex gap-4 items-start pb-6 border-b border-gray-50">
                            <div class="size-24 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                                <img alt="Product" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBaee97iKtrgVmBnYPIJ_J5OxsVuez0NdQ5ZTMvVqd7sBy5YY_iFCsUbrDqWJVaQ46ek05zIqLqKTnEHPVaqT_KmQTbaOQf_wa24ELH2vf2r2A1Fmy7Aak5H6R-Ofkr8YNqltoRJ5qfsVacsyi4p2SoPiolSNjCjTbLozmPxndq_ei27aY-m1mp4JVmv1Qot1lqvIZO487ogMsvc0tkLUlsmu3AZ3ek0ZSxlVScf4PRM-nI5l0emDoAywjWdCSJLx1pfWzuVLJYeyQ" />
                            </div>
                            <div class="flex-1 flex flex-col h-full justify-between">
                                <div>
                                    <div class="flex justify-between items-start gap-2">
                                        <h3 class="font-bold text-sm text-[#181111] mb-1 leading-snug uppercase">Khóa
                                            học Cắm
                                            Hoa Tết Cơ Bản</h3>
                                        <button class="text-gray-300 hover:text-red-500 transition-colors shrink-0">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </div>
                                    <span class="text-primary font-bold text-sm">500.000đ</span>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="qty-control">
                                        <button class="qty-btn">
                                            <span class="material-symbols-outlined text-sm">remove</span>
                                        </button>
                                        <span class="qty-val">1</span>
                                        <button class="qty-btn">
                                            <span class="material-symbols-outlined text-sm">add</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start pb-6 border-b border-gray-50">
                            <div class="size-24 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                                <img alt="Product" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDPoG5HpHCkiS4qn4QQq5Iw45BVlgXbiN0zEjoPYg5w9w1MBzOw_MI3MKhcgl-kzNR_szCvpsYV7u1mObMLzz0XIjXPsoHojeD8EcryyM-l7utn9S4-edgTuBlMjU7Qa7DLOAtbtA1WKtUBn4Bs3MKvxe90KyqMyiSmd8BgTpBX7fPN8G4bpKW3BqYRNTLf4xL7xkj3JhJGg66s48zcTvWR0qKqe49ABPsqtF7gtk1HowLjsC74HsR--z5IPxAsAbbzmiv2t9Hj6N4" />
                            </div>
                            <div class="flex-1 flex flex-col h-full justify-between">
                                <div>
                                    <div class="flex justify-between items-start gap-2">
                                        <h3 class="font-bold text-sm text-[#181111] mb-1 leading-snug uppercase">Lan Hồ
                                            Điệp Phú
                                            Quý (Bản Đẹp)</h3>
                                        <button class="text-gray-300 hover:text-red-500 transition-colors shrink-0">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </div>
                                    <span class="text-primary font-bold text-sm">2.500.000đ</span>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="qty-control">
                                        <button class="qty-btn">
                                            <span class="material-symbols-outlined text-sm">remove</span>
                                        </button>
                                        <span class="qty-val">1</span>
                                        <button class="qty-btn">
                                            <span class="material-symbols-outlined text-sm">add</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 border-t border-gray-100 space-y-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-500 font-bold uppercase text-xs tracking-widest">Tạm tính:</span>
                            <span class="text-2xl font-black text-primary">3.000.000đ</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <NuxtLink to="/cart" @click="closeCart"
                                class="w-full py-4 border-2 border-primary text-primary font-black text-xs uppercase tracking-widest rounded-full hover:bg-primary/5 transition-colors text-center block">
                                XEM GIỎ HÀNG
                            </NuxtLink>
                            <NuxtLink to="/checkout" @click="closeCart"
                                class="w-full py-4 bg-primary text-white font-black text-xs uppercase tracking-widest rounded-full hover:bg-[#5a252b] transition-colors shadow-lg shadow-red-100 text-center block">
                                THANH TOÁN
                            </NuxtLink>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<style scoped>
.side-cart-overlay {
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    transition: opacity 0.3s ease;
}

.drawer-content {
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

/* Transitions */
.cart-enter-from,
.cart-leave-to {
    opacity: 0;
}

.cart-enter-from .drawer-content,
.cart-leave-to .drawer-content {
    transform: translateX(100%);
}
</style>
