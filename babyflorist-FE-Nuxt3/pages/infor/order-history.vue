<script setup>
import asideLeft from './aside-left.vue';
const isDrawerOpen = ref(false);
const config = useRuntimeConfig();
const { user } = useAuth();
const orders = ref([]);
const loading = ref(true);
const selectedOrder = ref(null);

definePageMeta({
    middleware: 'auth'
})

// Fetch orders
const fetchOrders = async () => {
    try {
        const response = await $fetch(`${config.public.apiBase}/api/orders`, {
            headers: {
                Authorization: `Bearer ${useCookie('auth_token').value}`
            }
        });

        if (response && response.success) {
            orders.value = response.data;
        }
    } catch (e) {
        console.error('Failed to fetch orders', e);
    } finally {
        loading.value = false;
    }
}

onMounted(() => {
    fetchOrders();
})

// Helpers
const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price || 0);
}

const formatDate = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString('vi-VN');
}

const formatDateTime = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleString('vi-VN');
}

const getStatusLabel = (status) => {
    const map = {
        'pending': 'Chờ xử lý',
        'paid': 'Đã thanh toán',
        'processing': 'Đang xử lý',
        'shipping': 'Đang vận chuyển',
        'completed': 'Hoàn thành',
        'cancelled': 'Đã hủy',
        'refunded': 'Đã hoàn tiền'
    };
    return map[status] || status;
}

const getStatusColorClass = (status) => {
    const map = {
        'pending': 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
        'paid': 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
        'processing': 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
        'shipping': 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400',
        'completed': 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
        'cancelled': 'bg-stone-100 text-stone-600 dark:bg-stone-800 dark:text-stone-400',
        'refunded': 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'
    };
    return map[status] || 'bg-gray-100 text-gray-600';
}

const openDrawer = (order) => {
    selectedOrder.value = order;
    isDrawerOpen.value = true;
}

const getThumbnail = (item) => {
    // Priority: Course thumbnail > Product thumbnail > Placehold
    if (item.item_type === 'course' && item.course?.thumbnail) {
        return item.course.thumbnail.startsWith('http') ? item.course.thumbnail : `${config.public.apiBase}/storage/${item.course.thumbnail}`;
    }
    if (item.item_type === 'product' && item.product?.thumbnail) {
        return item.product.thumbnail.startsWith('http') ? item.product.thumbnail : `${config.public.apiBase}/storage/${item.product.thumbnail}`;
    }
    return 'https://placehold.co/100x100?text=No+Image';
}

const getTimelineSteps = computed(() => {
    if (!selectedOrder.value) return [];

    // Base steps for all orders
    const steps = [
        {
            label: 'Đặt hàng',
            time: formatDateTime(selectedOrder.value.created_at),
            active: true
        },
        {
            label: 'Thanh toán hoàn tất',
            time: selectedOrder.value.payment_status === 'paid' ? 'Đã thanh toán' : 'Chờ thanh toán',
            active: selectedOrder.value.payment_status === 'paid',
            current: selectedOrder.value.payment_status === 'pending'
        }
    ];

    if (selectedOrder.value.order_type === 'product') {
        // Product specific steps
        const isPreparing = ['preparing', 'shipping', 'completed'].includes(selectedOrder.value.order_status);
        const isShipping = ['shipping', 'completed'].includes(selectedOrder.value.order_status);
        const isCompleted = selectedOrder.value.order_status === 'completed';

        steps.push(
            {
                label: 'Đang chuẩn bị',
                active: isPreparing,
                current: selectedOrder.value.order_status === 'preparing'
            },
            {
                label: 'Đang giao hàng',
                active: isShipping,
                current: selectedOrder.value.order_status === 'shipping'
            }
        );

        if (selectedOrder.value.order_status === 'cancelled') {
            steps.push({
                label: 'Đã hủy',
                active: true,
                error: true
            });
        } else {
            steps.push({
                label: 'Hoàn thành',
                active: isCompleted,
                current: false
            });
        }
    } else {
        // Course specific steps
        const isCompleted = selectedOrder.value.order_status === 'completed';

        if (selectedOrder.value.order_status === 'cancelled') {
            steps.push({
                label: 'Đã hủy',
                active: true,
                error: true
            });
        } else {
            steps.push({
                label: 'Hoàn thành',
                active: isCompleted,
                current: false
            });
        }
    }

    return steps;
});
</script>

<template>
    <main class="max-w-[1400px] mx-auto px-6 py-12 min-h-[60vh]">
        <div class="flex flex-col lg:flex-row gap-8">
            <asideLeft />
            <section class="w-full lg:w-3/4">
                <div class="flex items-center justify-between mb-2 min-w-[1000px]">
                    <h2 class="display-font text-3xl font-bold flex items-center gap-3">
                        <span class="w-10 h-[2px] bg-primary"></span>
                        Lịch sử đơn hàng
                    </h2>
                    <span class="text-stone-500 text-sm">{{ orders.length }} đơn hàng gần đây</span>
                </div>

                <div v-if="loading" class="flex justify-center py-10">
                    <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-primary"></div>
                </div>

                <div v-else-if="orders.length === 0" class="text-center py-10 text-stone-500">
                    Bạn chưa có đơn hàng nào.
                </div>

                <div v-else class="space-y-6 mt-6">
                    <div v-for="order in orders" :key="order.id" class="order-card transition-all hover:shadow-md"
                        :class="{ 'opacity-75 grayscale-[0.3]': order.order_status === 'cancelled' }">
                        <div
                            class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-stone-100 dark:border-stone-800">
                            <div class="flex items-center gap-8">
                                <div>
                                    <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Mã đơn
                                        hàng</p>
                                    <p class="font-bold text-stone-900 dark:text-stone-100">#{{ order.order_number }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Ngày
                                        mua</p>
                                    <p class="font-medium">{{ formatDate(order.created_at) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider mb-1">Tổng
                                        tiền</p>
                                    <p class="font-bold text-primary">{{ formatPrice(order.final_amount) }}</p>
                                </div>
                            </div>
                            <div>
                                <span class="px-3 py-1 text-xs font-bold rounded-full uppercase tracking-wide"
                                    :class="getStatusColorClass(order.order_status === 'pending' && order.payment_status === 'paid' ? 'paid' : (order.order_status === 'cancelled' ? 'cancelled' : order.payment_status))">
                                    {{ getStatusLabel(order.order_status === 'cancelled' ? 'cancelled' :
                                        order.payment_status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Order Items Preview (First 2 items) -->
                        <div class="py-6 space-y-4">
                            <div v-for="item in order.items.slice(0, 2)" :key="item.id" class="flex items-center gap-4">
                                <div
                                    class="w-20 h-20 rounded-lg overflow-hidden bg-stone-100 border border-stone-200 dark:border-stone-700 shrink-0">
                                    <img :src="getThumbnail(item)" :alt="item.item_name"
                                        class="w-full h-full object-cover" />
                                </div>
                                <div class="flex-grow">
                                    <h3 class="font-semibold text-lg text-stone-800 dark:text-stone-200">{{
                                        item.item_name }}</h3>
                                    <p class="text-sm text-stone-500">{{ item.item_type === 'course' ? 'Khóa học' :
                                        'Sản phẩm' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold">{{ formatPrice(item.item_price) }}</p>
                                    <p class="text-xs text-stone-400">SL: {{ item.quantity }}</p>
                                </div>
                            </div>
                            <div v-if="order.items.length > 2" class="text-center text-sm text-stone-500">
                                ... và {{ order.items.length - 2 }} sản phẩm khác
                            </div>
                        </div>

                        <div class="pt-4 border-t border-stone-100 dark:border-stone-800 flex justify-end">
                            <button class="flex items-center gap-2 text-primary font-bold text-sm group"
                                @click="openDrawer(order)">
                                <span class="group-hover:underline decoration-2 underline-offset-4">XEM CHI TIẾT</span>
                                <span class="material-symbols-outlined text-base">arrow_forward</span>
                            </button>
                        </div>
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
        <div v-if="isDrawerOpen && selectedOrder"
            class="fixed inset-y-0 right-0 w-full max-w-md h-full bg-white dark:bg-stone-900 shadow-2xl z-50 flex flex-col border-l border-stone-200 dark:border-stone-800">
            <div
                class="p-6 border-b border-stone-100 dark:border-stone-800 flex items-center justify-between bg-stone-50 dark:bg-stone-900">
                <div>
                    <h2 class="display-font text-2xl font-bold text-primary mb-1">Chi tiết đơn hàng</h2>
                    <p class="text-stone-500 text-sm font-medium">#{{ selectedOrder.order_number }}</p>
                </div>
                <button @click="isDrawerOpen = false"
                    class="rounded-full transition-colors text-stone-500 hover:bg-stone-100 dark:hover:bg-stone-800 p-2">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto drawer-content p-6 space-y-8">
                <!-- Timeline/Status (Simplified for now) -->
                <!-- Timeline -->
                <div class="relative pl-4 border-l-2 border-stone-200 dark:border-stone-800 space-y-6">
                    <div v-for="(step, index) in getTimelineSteps" :key="index" class="relative"
                        :class="{ 'opacity-50': !step.active && !step.current }">
                        <div class="absolute -left-[21px] w-4 h-4 rounded-full border-4 border-white dark:border-stone-900"
                            :class="[
                                step.error ? 'bg-red-500' :
                                    (step.current ? 'bg-amber-500 animate-pulse' :
                                        (step.active ? 'bg-primary' : 'bg-stone-300 dark:bg-stone-700'))
                            ]">
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold" :class="[
                                step.error ? 'text-red-500' :
                                    (step.current ? 'text-amber-500' :
                                        (step.active ? 'text-stone-900 dark:text-stone-100' : 'text-stone-400'))
                            ]">
                                {{ step.label }}
                            </p>
                            <p v-if="step.time" class="text-xs"
                                :class="step.active ? 'text-stone-500' : 'text-stone-400'">
                                {{ step.time }}
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-stone-800 dark:text-stone-200 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg text-primary">shopping_bag</span>
                        Sản phẩm
                    </h3>
                    <div class="space-y-4">
                        <div v-for="item in selectedOrder.items" :key="item.id"
                            class="flex gap-4 p-3 rounded-xl bg-stone-50 dark:bg-stone-800/50 border border-stone-100 dark:border-stone-800">
                            <div
                                class="w-16 h-16 rounded-lg overflow-hidden border border-stone-200 dark:border-stone-700 shrink-0">
                                <img :src="getThumbnail(item)" :alt="item.item_name"
                                    class="w-full h-full object-cover" />
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-stone-800 dark:text-stone-200 line-clamp-2">
                                    {{ item.item_name }}</h4>
                                <div class="flex justify-between items-center text-xs mt-1">
                                    <span class="text-stone-600 dark:text-stone-400">x{{ item.quantity }}</span>
                                    <span class="font-bold text-stone-900 dark:text-stone-100">{{
                                        formatPrice(item.subtotal) }}</span>
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
                            <span>{{ formatPrice(selectedOrder.total_amount) }}</span>
                        </div>
                        <div v-if="selectedOrder.discount_amount > 0"
                            class="flex justify-between text-stone-600 dark:text-stone-400">
                            <span>Giảm giá</span>
                            <span class="text-green-600">-{{ formatPrice(selectedOrder.discount_amount) }}</span>
                        </div>
                        <div
                            class="pt-3 border-t border-dashed border-stone-200 dark:border-stone-700 flex justify-between items-center">
                            <span class="font-bold text-stone-900 dark:text-stone-100">Tổng cộng</span>
                            <span class="font-bold text-xl text-primary">{{ formatPrice(selectedOrder.final_amount)
                                }}</span>
                        </div>
                        <div class="flex justify-between text-stone-600 dark:text-stone-400 pt-2">
                            <span>Phương thức</span>
                            <span class="uppercase font-bold">{{ selectedOrder.payment_method === 'qr_code' ?
                                'Chuyển khoản QR' : selectedOrder.payment_method }}</span>
                        </div>
                        <div class="flex justify-between text-stone-600 dark:text-stone-400">
                            <span>Trạng thái</span>
                            <span
                                :class="getStatusColorClass(selectedOrder.payment_status === 'paid' ? 'paid' : (selectedOrder.order_status === 'cancelled' ? 'cancelled' : selectedOrder.payment_status))"
                                class="px-2 py-0.5 rounded text-xs font-bold uppercase">
                                {{ getStatusLabel(selectedOrder.order_status === 'cancelled' ? 'cancelled' :
                                    selectedOrder.payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-stone-100 dark:border-stone-800 bg-stone-50 dark:bg-stone-900">
                <button v-if="selectedOrder.payment_status === 'paid'"
                    @click="navigateTo(`/carts/bill?orderId=${selectedOrder.id}`)"
                    class="w-full bg-stone-900 dark:bg-stone-100 hover:bg-stone-800 dark:hover:bg-stone-200 text-white dark:text-stone-900 py-3 rounded-xl font-medium transition-colors flex items-center justify-center gap-2 mb-3 shadow-lg">
                    <span class="material-symbols-outlined text-xl">download</span>
                    Tải Hóa Đơn
                </button>
                <div v-else class="text-center text-sm text-stone-500 mb-3 italic">
                    Hóa đơn chỉ có sẵn sau khi thanh toán thành công
                </div>
                <button
                    class="w-full text-stone-500 hover:text-stone-800 dark:hover:text-stone-200 text-sm font-medium transition-colors">
                    Cần trợ giúp? Liên hệ CSKH
                </button>
            </div>
        </div>
    </Transition>
</template>
