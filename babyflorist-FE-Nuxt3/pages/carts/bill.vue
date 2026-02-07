<script setup>
definePageMeta({
    layout: false,
    middleware: 'auth'
})

const route = useRoute();
const config = useRuntimeConfig();
const order = ref(null);
const loading = ref(true);

useHead({
    title: 'Hóa Đơn Thanh Toán | Workshop Hoa Tết',
    link: [
        { rel: 'preconnect', href: 'https://fonts.googleapis.com' },
        { rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: '' },
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap' },
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap' }
    ]
})

const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price || 0).replace('₫', 'đ');
}

const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString('vi-VN', { day: '2-digit', month: 'long', year: 'numeric' });
}

const fetchOrder = async () => {
    const orderId = route.query.orderId;
    if (!orderId) {
        loading.value = false;
        return;
    }

    try {
        const response = await $fetch(`${config.public.apiBase}/api/orders/${orderId}`, {
            headers: {
                Authorization: `Bearer ${useCookie('auth_token').value}`
            }
        });

        if (response && response.success) {
            order.value = response.data;
        }
    } catch (e) {
        console.error('Failed to fetch order', e);
    } finally {
        loading.value = false;
    }
}

onMounted(() => {
    fetchOrder();
})
</script>

<template>
    <div class="text-slate-800 bg-stone-100 min-h-screen">
        <div class="max-w-[210mm] mx-auto mt-8 flex justify-between items-center no-print pt-8 px-10">
            <a class="flex items-center gap-2 text-stone-500 hover:text-primary transition-colors font-medium" href="#"
                @click.prevent="$router.back()">
                <span class="material-symbols-outlined">arrow_back</span>
                Quay lại Lịch sử đơn hàng
            </a>
            <button
                class="bg-primary text-white px-6 py-2.5 rounded-full font-bold flex items-center gap-2 shadow-lg hover:bg-red-800 transition-all"
                onclick="window.print()">
                <span class="material-symbols-outlined text-xl">print</span>
                In Hóa Đơn
            </button>
        </div>
        <div class="invoice-container">
            <header class="flex justify-between items-start mb-12">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-4xl">local_florist</span>
                    <div>
                        <h1 class="display-font text-2xl font-bold tracking-tight text-primary uppercase">Workshop Hoa
                            Tết
                        </h1>
                        <p class="text-[10px] text-stone-400 font-medium tracking-widest mt-1">Nghệ thuật &amp; Truyền
                            thống
                        </p>
                    </div>
                </div>
                <div class="text-right text-xs text-stone-500 space-y-1">
                    <p class="font-bold text-stone-800 uppercase">Thông tin cửa hàng</p>
                    <p>123 Đường Xuân, Quận 1, TP. Hồ Chí Minh</p>
                    <p>Hotline: 090 123 4567</p>
                    <p>Email: lienhe@workshoptet.vn</p>
                </div>
            </header>
            <div class="text-center mb-12 relative">
                <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 border-t border-stone-200 z-0"></div>
                <h2
                    class="display-font text-4xl font-bold text-primary relative z-10 bg-white inline-px px-10 uppercase tracking-widest">
                    Hóa Đơn Bán Hàng
                </h2>
            </div>
            <div v-if="order" class="grid grid-cols-2 gap-12 mb-12">
                <div class="space-y-3">
                    <div class="flex border-b border-stone-50 pb-2">
                        <span class="w-32 text-xs font-semibold text-stone-400 uppercase">Mã hóa đơn:</span>
                        <span class="text-sm font-bold text-stone-800">#{{ order.order_number }}</span>
                    </div>
                    <div class="flex border-b border-stone-50 pb-2">
                        <span class="w-32 text-xs font-semibold text-stone-400 uppercase">Ngày lập:</span>
                        <span class="text-sm text-stone-700">{{ formatDate(order.created_at) }}</span>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex border-b border-stone-50 pb-2">
                        <span class="w-32 text-xs font-semibold text-stone-400 uppercase">Khách hàng:</span>
                        <span class="text-sm font-bold text-stone-800">{{ order.shipping_name }}</span>
                    </div>
                    <div class="flex border-b border-stone-50 pb-2">
                        <span class="w-32 text-xs font-semibold text-stone-400 uppercase">Số điện thoại:</span>
                        <span class="text-sm text-stone-700">{{ order.shipping_phone }}</span>
                    </div>
                    <div class="flex border-b border-stone-50 pb-2">
                        <span class="w-32 text-xs font-semibold text-stone-400 uppercase">Địa chỉ nhận:</span>
                        <span class="text-sm text-stone-700">{{ order.shipping_address || 'N/A' }}</span>
                    </div>
                </div>
            </div>
            <div class="mb-12">
                <table>
                    <thead>
                        <tr>
                            <th class="w-12 text-center">STT</th>
                            <th class="text-left">Tên sản phẩm / Khóa học</th>
                            <th class="text-center">Đơn vị</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-right">Đơn giá</th>
                            <th class="text-right">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody v-if="order">
                        <tr v-for="(item, index) in order.items" :key="item.id">
                            <td class="text-center">{{ String(index + 1).padStart(2, '0') }}</td>
                            <td>
                                <p class="font-semibold text-stone-800">{{ item.item_name }}</p>
                                <p class="text-[11px] text-stone-400">{{ item.item_type === 'course' ? 'Khóa học' :
                                    'Sản phẩm' }}</p>
                            </td>
                            <td class="text-center">{{ item.item_type === 'course' ? 'Buổi' : 'Cái' }}</td>
                            <td class="text-center">{{ String(item.quantity).padStart(2, '0') }}</td>
                            <td class="text-right">{{ formatPrice(item.item_price) }}</td>
                            <td class="text-right font-medium">{{ formatPrice(item.subtotal) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-if="order" class="flex justify-end mb-20">
                <div class="w-72 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-stone-500">Tạm tính:</span>
                        <span class="font-medium">{{ formatPrice(order.total_amount) }}</span>
                    </div>
                    <div v-if="order.discount_amount > 0" class="flex justify-between text-sm">
                        <span class="text-stone-500">Giảm giá {{ order.voucher_code ? `(${order.voucher_code})` : ''
                            }}:</span>
                        <span class="text-green-600">-{{ formatPrice(order.discount_amount) }}</span>
                    </div>
                    <div class="pt-4 border-t-2 border-primary/20 flex justify-between items-center">
                        <span class="font-bold text-stone-900">TỔNG CỘNG:</span>
                        <span class="text-2xl font-bold text-primary">{{ formatPrice(order.final_amount) }}</span>
                    </div>
                </div>
            </div>
            <footer class="mt-auto">
                <div class="grid grid-cols-2 gap-8 text-center">
                    <div class="space-y-24">
                        <div>
                            <p class="font-bold uppercase text-xs tracking-widest mb-1">Người Mua Hàng</p>
                            <p class="text-[10px] text-stone-400 italic">(Ký và ghi rõ họ tên)</p>
                        </div>
                        <div class="text-stone-300">................................................</div>
                    </div>
                    <div class="space-y-24">
                        <div>
                            <p class="font-bold uppercase text-xs tracking-widest mb-1 text-primary">Người Bán Hàng</p>
                            <p class="text-[10px] text-stone-400 italic">(Ký và ghi rõ họ tên)</p>
                        </div>
                        <div class="text-stone-800 font-display italic text-lg opacity-80">Babyflorist</div>
                    </div>
                </div>
            </footer>
        </div>
        <div class="h-20 no-print"></div>
    </div>
</template>

<style scoped>
@media print {
    .no-print {
        display: none !important;
    }

    body {
        background-color: white;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .invoice-container {
        box-shadow: none !important;
        border: none !important;
        margin: 0 !important;
        padding: 20px !important;
        width: 100% !important;
        min-height: auto !important;
        page-break-inside: avoid;
    }

    /* Remove page break after container */
    .invoice-container::after {
        display: none;
    }
}

.invoice-container {
    width: 210mm;
    min-height: 297mm;
    margin: 2rem auto;
    background: white;
    padding: 40px;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    position: relative;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    @apply text-stone-600 font-semibold text-xs uppercase tracking-wider py-3 border-b border-stone-200;
}

td {
    @apply py-4 border-b border-stone-100 text-sm text-stone-700;
}

.display-font {
    font-family: 'Playfair Display', serif;
}

.font-sans {
    font-family: 'Inter', sans-serif;
}
</style>
