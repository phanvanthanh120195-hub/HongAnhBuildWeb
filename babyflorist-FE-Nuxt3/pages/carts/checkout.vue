<template>
    <div class="flex-1 flex flex-col items-center w-full min-h-[92vh]">
        <div class="max-w-[1400px] w-full px-6 lg:px-14 py-8">
            <nav class="flex flex-wrap gap-2 py-4 mb-8">
                <NuxtLink to="/courses" class="text-[#9a4c52] dark:text-[#c08287] text-sm font-medium hover:underline">
                    Khóa học</NuxtLink>
                <span class="text-[#9a4c52] dark:text-[#c08287] text-sm font-medium">/</span>
                <span class="text-[#1b0d0f] dark:text-white text-sm font-medium">Thanh toán</span>
            </nav>

            <!-- Loading State -->
            <div v-if="loading" class="flex justify-center items-center py-20">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
            </div>

            <!-- No Course Selected -->
            <div v-else-if="!course" class="text-center py-20">
                <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">error_outline</span>
                <p class="text-gray-500">Không tìm thấy khóa học. Vui lòng chọn lại.</p>
                <NuxtLink to="/courses"
                    class="inline-block mt-4 px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90">
                    Quay lại danh sách khóa học
                </NuxtLink>
            </div>

            <!-- Checkout Form -->
            <div v-else class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <div class="lg:col-span-8 space-y-8">
                    <div
                        class="bg-white dark:bg-[#2d1b1d] p-8 rounded-xl border border-[#e7cfd1] dark:border-[#3d2a2c] shadow-sm">
                        <h2 class="text-2xl font-black text-[#1b0d0f] dark:text-white mb-8">Thông tin thanh toán
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-[#1b0d0f] dark:text-white mb-2">Họ và tên
                                    <span class="text-red-500">*</span></label>
                                <input v-model="form.name"
                                    class="w-full rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary"
                                    placeholder="Nhập họ và tên của bạn" type="text" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1b0d0f] dark:text-white mb-2">Số điện
                                    thoại <span class="text-red-500">*</span></label>
                                <input v-model="form.phone"
                                    class="w-full rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary"
                                    placeholder="09xxxxxxxx" type="tel" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1b0d0f] dark:text-white mb-2">Email (Để
                                    nhận thông tin khóa học)</label>
                                <input v-model="form.email"
                                    class="w-full rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary"
                                    placeholder="email@example.com" type="email" />
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-[#1b0d0f] dark:text-white mb-2">Địa chỉ
                                    chi tiết</label>
                                <textarea v-model="form.address"
                                    class="w-full rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary"
                                    placeholder="Số nhà, tên đường, phường/xã, quận/huyện..." rows="3"></textarea>
                            </div>
                        </div>

                        <!-- Bank Selection -->
                        <div class="mt-12">
                            <h2 class="text-xl font-black text-[#1b0d0f] dark:text-white mb-6">Chọn ngân hàng chuyển
                                khoản</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div v-for="bank in banks" :key="bank.id" @click="selectedBank = bank.id" :class="[
                                    'rounded-xl p-5 relative cursor-pointer transition-all',
                                    selectedBank === bank.id
                                        ? 'border-2 border-primary bg-primary/5'
                                        : 'border-2 border-[#e7cfd1] dark:border-[#3d2a2c] hover:border-primary'
                                ]">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="size-12 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                            <span
                                                :class="['material-symbols-outlined text-3xl', selectedBank === bank.id ? 'text-primary' : 'text-gray-400']">account_balance</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg text-[#1b0d0f] dark:text-white">{{
                                                bank.bank_name }}
                                            </p>
                                            <p
                                                :class="['text-sm font-bold', selectedBank === bank.id ? 'text-primary' : 'text-[#1b0d0f] dark:text-white']">
                                                {{ bank.account_name }}</p>
                                            <p class="text-sm text-[#9a4c52] dark:text-[#c08287]">{{
                                                bank.account_number }}</p>
                                        </div>
                                    </div>
                                    <div v-if="selectedBank === bank.id" class="absolute top-4 right-4 text-primary">
                                        <span class="material-symbols-outlined text-xl">check_circle</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-4 space-y-6">
                    <div
                        class="bg-white dark:bg-[#2d1b1d] p-6 rounded-xl border border-[#e7cfd1] dark:border-[#3d2a2c] shadow-sm">
                        <h2
                            class="text-xl font-black text-[#1b0d0f] dark:text-white border-b border-[#e7cfd1] dark:border-[#3d2a2c] pb-4 mb-6">
                            Đơn hàng của bạn</h2>
                        <div class="space-y-4 mb-8">
                            <div class="flex gap-4">
                                <div class="w-[100px] h-[100px] rounded-lg bg-cover bg-center shrink-0 border border-[#e7cfd1]"
                                    :style="`background-image: url('${thumbnailUrl}');`">
                                </div>
                                <div class="flex flex-col justify-center flex-1">
                                    <h4 class="text-sm font-bold text-[#1b0d0f] dark:text-white line-clamp-2">{{
                                        course.name }}</h4>
                                    <p class="text-sm font-bold text-primary mt-1">{{ formatPrice(unitPrice) }}</p>
                                    <!-- Quantity Control -->
                                    <div class="mt-2 flex items-center gap-2">
                                        <button @click="decreaseQty"
                                            class="w-8 h-8 rounded border border-[#e7cfd1] dark:border-[#3d2a2c] flex items-center justify-center hover:bg-gray-100 dark:hover:bg-[#3d2a2c] transition-colors">
                                            <span class="material-symbols-outlined text-sm">remove</span>
                                        </button>
                                        <input v-model.number="quantity" type="number" min="1" @change="saveToStorage"
                                            @input="validateQuantity"
                                            class="w-[70px] text-center font-bold text-[#1b0d0f] dark:text-white bg-transparent border border-[#e7cfd1] dark:border-[#3d2a2c] focus:ring-0 p-0 [&::-webkit-inner-spin-button]:appearance-none" />
                                        <button @click="increaseQty"
                                            class="w-8 h-8 rounded border border-[#e7cfd1] dark:border-[#3d2a2c] flex items-center justify-center hover:bg-gray-100 dark:hover:bg-[#3d2a2c] transition-colors">
                                            <span class="material-symbols-outlined text-sm">add</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4 border-t border-[#e7cfd1] dark:border-[#3d2a2c] pt-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-[#9a4c52] dark:text-[#c08287]">Tạm tính:</span>
                                <span class="text-[#1b0d0f] dark:text-white font-semibold">{{ formatPrice(subtotal)
                                }}</span>
                            </div>

                            <!-- Discount Code -->
                            <div>
                                <div class="flex gap-2">
                                    <input v-model="voucherCode"
                                        class="form-input flex-1 rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark text-sm px-4 focus:ring-primary focus:border-primary disabled:opacity-50"
                                        placeholder="Nhập mã giảm giá..." type="text" />
                                    <button @click="applyVoucher" :disabled="applyingVoucher"
                                        class="bg-[#1b0d0f] dark:bg-black text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-black/80 transition-colors uppercase disabled:opacity-50">
                                        {{ applyingVoucher ? '...' : 'Áp dụng' }}
                                    </button>
                                    <!-- <button v-else @click="removeVoucher"
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-600 transition-colors">
                                        <span class="material-symbols-outlined text-sm">close</span>
                                    </button> -->
                                </div>
                                <p v-if="voucherError" class="text-red-500 text-xs mt-1">{{ voucherError }}</p>
                                <p v-if="appliedVoucher" class="text-green-600 text-xs mt-1">
                                    Đã áp dụng mã giảm giá thành công (-{{ appliedVoucher.discount_percentage }}%)
                                </p>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="text-[#9a4c52] dark:text-[#c08287]">Giảm giá:</span>
                                <span class="text-green-600 font-semibold">- {{ formatPrice(discountAmount) }}</span>
                            </div>

                            <div class="border-t border-[#e7cfd1] dark:border-[#3d2a2c] pt-6 mt-6">
                                <div class="flex justify-between items-center mb-8">
                                    <span class="text-[#1b0d0f] dark:text-white text-xl font-black">Tổng
                                        cộng:</span>
                                    <span class="text-primary text-2xl font-black">{{ formatPrice(totalAmount) }}</span>
                                </div>
                                <button @click="handlePayment" :disabled="!isCourseOpen" :class="[
                                    'w-full py-4 rounded-xl font-bold text-lg shadow-lg transition-all flex items-center justify-center gap-3 uppercase tracking-widest',
                                    isCourseOpen
                                        ? 'bg-primary hover:bg-[#b80e1c] text-white shadow-primary/20'
                                        : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed shadow-none'
                                ]">
                                    {{ isCourseOpen ? 'THANH TOÁN NGAY' : 'CHƯA MỞ ĐĂNG KÝ' }}
                                    <span class="material-symbols-outlined">{{ isCourseOpen ? 'payments' : 'block'
                                    }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-2 p-4 text-[#9a4c52] dark:text-[#c08287]">
                        <span class="material-symbols-outlined text-green-600">verified_user</span>
                        <span class="text-xs uppercase font-bold tracking-widest">Thanh toán bảo mật 100%</span>
                    </div>
                </div>
            </div>
        </div>
        <PaymentPopup v-if="showPayment" :bank="selectedBankData" :amount="totalAmount" :content="transferContent"
            @close="showPayment = false" @confirm="onPaymentConfirm" />
        <AuthPopup v-if="showAuthPopup" @close="onAuthClose" />
    </div>
</template>

<script setup lang="ts">
import PaymentPopup from '~/components/checkout/PaymentPopup.vue'
import AuthPopup from '~/components/auth/AuthPopup.vue'

useHead({
    title: 'Thanh toán - Hoa Tết Art'
})

const config = useRuntimeConfig()
const route = useRoute()
const { user } = useAuth()

const STORAGE_KEY = 'checkout_data'

// State
const loading = ref(true)
const showPayment = ref(false)
const course = ref<any>(null)
const banks = ref<any[]>([])
const selectedBank = ref<number | null>(null)
const quantity = ref(1)

// Voucher state
const voucherCode = ref('')
const appliedVoucher = ref<any>(null)
const voucherError = ref('')
const applyingVoucher = ref(false)

// Form data
const form = ref({
    name: '',
    phone: '',
    email: '',
    address: ''
})

// Computed
const thumbnailUrl = computed(() => {
    if (!course.value?.thumbnail) return 'https://placehold.co/200x200'
    return course.value.thumbnail.startsWith('http')
        ? course.value.thumbnail
        : `${config.public.apiBase}/storage/${course.value.thumbnail}`
})

const unitPrice = computed(() => course.value?.sale_price || course.value?.price || 0)
const subtotal = computed(() => unitPrice.value * quantity.value)
const discountAmount = computed(() => {
    if (!appliedVoucher.value) return 0
    return Math.round(subtotal.value * appliedVoucher.value.discount_percentage / 100)
})
const totalAmount = computed(() => Math.max(0, subtotal.value - discountAmount.value))

// Format price helper
const formatPrice = (price: number) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price || 0)
}

// Quantity controls
const increaseQty = () => {
    quantity.value++
    saveToStorage()
}
const decreaseQty = () => {
    if (quantity.value > 1) {
        quantity.value--
        saveToStorage()
    }
}

const validateQuantity = () => {
    if (quantity.value < 1) {
        quantity.value = 1
    }
}

// Save checkout state to localStorage (quantity and bank only)
const saveToStorage = () => {
    if (import.meta.client) {
        const data = {
            quantity: quantity.value,
            selectedBank: selectedBank.value,
            courseSlug: route.query.course
        }
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data))
    }
}

// Load checkout state from localStorage
const loadFromStorage = () => {
    if (import.meta.client) {
        const saved = localStorage.getItem(STORAGE_KEY)
        if (saved) {
            try {
                const parsed = JSON.parse(saved)
                if (parsed.quantity) quantity.value = parsed.quantity
                if (parsed.selectedBank) selectedBank.value = parsed.selectedBank
            } catch (e) {
                console.error('Failed to parse saved data:', e)
            }
        }
    }
}

// Watch for bank selection changes
watch(selectedBank, () => {
    saveToStorage()
})

// Voucher functions
const applyVoucher = async () => {
    if (!voucherCode.value.trim()) {
        voucherError.value = 'Vui lòng nhập mã giảm giá'
        return
    }

    applyingVoucher.value = true
    voucherError.value = ''

    try {
        const res: any = await $fetch(`${config.public.apiBase}/api/vouchers/check`, {
            method: 'POST',
            body: { code: voucherCode.value.trim() }
        })

        if (res.success && res.data) {
            // Check if voucher applies to courses
            if (res.data.apply_to && res.data.apply_to !== 'course') {
                voucherError.value = 'Mã giảm giá này không áp dụng cho khóa học'
                return
            }
            appliedVoucher.value = res.data
            voucherError.value = ''
        }
    } catch (e: any) {
        voucherError.value = e.data?.message || e.response?._data?.message || 'Mã giảm giá không hợp lệ'
    } finally {
        applyingVoucher.value = false
    }
}

const removeVoucher = () => {
    appliedVoucher.value = null
    voucherCode.value = ''
    voucherError.value = ''
}
// Watch for user changes to populate form
watch(user, (newUser) => {
    if (newUser) {
        form.value.name = newUser.name || ''
        form.value.phone = newUser.phone || ''
        form.value.email = newUser.email || ''
        form.value.address = newUser.address || ''
    } else {
        // Clear form on logout
        form.value.name = ''
        form.value.phone = ''
        form.value.email = ''
        form.value.address = ''
    }
}, { immediate: true })

// Payment & Auth Logic
const showAuthPopup = ref(false)
const orderCode = ref('DH' + Math.floor(Math.random() * 900000 + 100000))

const selectedBankData = computed(() => {
    return banks.value.find(b => b.id === selectedBank.value) || null
})

const transferContent = computed(() => {
    // KH [Phone] [OrderCode]
    const phone = user.value?.phone || form.value.phone || 'SDT'
    return `KH ${phone} ${orderCode.value}`
})

const handlePayment = () => {
    if (!user.value) {
        showAuthPopup.value = true
        return
    }
    // Generate new order code for each payment attempt
    orderCode.value = 'DH' + Math.floor(Math.random() * 900000 + 100000)
    showPayment.value = true
}

const onAuthClose = () => {
    showAuthPopup.value = false
    if (user.value) {
        showPayment.value = true
    }
}

// Handle payment confirmation - create order and redirect
const onPaymentConfirm = async () => {
    try {
        // Create order via API
        const response = await $fetch<{ success: boolean; data?: { order_id: number; order_number: string; final_amount: number }; message?: string }>(`${config.public.apiBase}/api/orders`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${useCookie('auth_token').value}`,
                'Content-Type': 'application/json'
            },
            body: {
                name: form.value.name,
                phone: form.value.phone,
                email: form.value.email,
                address: form.value.address || 'N/A',
                course_id: course.value?.id,
                bank_id: selectedBank.value,
                voucher_code: appliedVoucher.value?.code || null,
                payment_method: 'qr_code'
            }
        })

        if (response.success && response.data) {
            // Confirm transfer
            await $fetch(`${config.public.apiBase}/api/orders/${response.data.order_id}/confirm`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${useCookie('auth_token').value}`
                }
            })

            // Clear localStorage
            localStorage.removeItem('checkout_quantity')
            localStorage.removeItem('checkout_bank')

            // Redirect to success page
            navigateTo({
                path: '/carts/payment-success',
                query: {
                    order: response.data.order_number,
                    total: response.data.final_amount,
                    course: course.value?.name || 'Khóa học'
                }
            })
        } else {
            alert(response.message || 'Có lỗi xảy ra khi tạo đơn hàng')
            showPayment.value = false
        }
    } catch (error: any) {
        console.error('Order creation error:', error)
        alert(error.data?.message || 'Có lỗi xảy ra. Vui lòng thử lại.')
        showPayment.value = false
    }
}

// Check if course is open for registration
const isCourseOpen = computed(() => {
    if (!course.value) return false
    // Require both dates to be set
    if (!course.value.sale_start || !course.value.sale_end) return false
    const now = new Date()
    const start = new Date(course.value.sale_start)
    const end = new Date(course.value.sale_end)
    return now >= start && now <= end
})

// Fetch data on mount
onMounted(async () => {
    const courseSlug = route.query.course as string

    // Load form from session first
    loadFromStorage()



    // Fetch banks
    try {
        const bankRes: any = await $fetch(`${config.public.apiBase}/api/banks`)
        if (bankRes.success && bankRes.data) {
            banks.value = bankRes.data
            if (banks.value.length > 0) {
                const currentBankExists = banks.value.some(b => b.id === selectedBank.value)
                if (!selectedBank.value || !currentBankExists) {
                    selectedBank.value = banks.value[0].id
                }
            }
        }
    } catch (e) {
        console.error('Failed to fetch banks:', e)
    }

    // Fetch course if slug provided
    if (courseSlug) {
        try {
            const courseRes: any = await $fetch(`${config.public.apiBase}/api/courses/${courseSlug}`)
            if (courseRes.success && courseRes.data) {
                course.value = courseRes.data
            }
        } catch (e) {
            console.error('Failed to fetch course:', e)
        }
    }

    loading.value = false
})
</script>
