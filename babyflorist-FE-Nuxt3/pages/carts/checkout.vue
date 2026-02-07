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
                                <input v-model="form.name" @input="clearError('name')"
                                    :class="['w-full rounded-lg bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary', errors.name ? 'border-red-500' : 'border-[#e7cfd1] dark:border-[#3d2a2c]']"
                                    placeholder="Nhập họ và tên của bạn" type="text" />
                                <span v-if="errors.name" class="text-red-500 text-xs mt-1 block">{{ errors.name
                                    }}</span>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1b0d0f] dark:text-white mb-2">Số điện
                                    thoại <span class="text-red-500">*</span></label>
                                <input v-model="form.phone" @input="clearError('phone')"
                                    :class="['w-full rounded-lg bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary', errors.phone ? 'border-red-500' : 'border-[#e7cfd1] dark:border-[#3d2a2c]']"
                                    placeholder="09xxxxxxxx" type="tel" />
                                <span v-if="errors.phone" class="text-red-500 text-xs mt-1 block">{{ errors.phone
                                    }}</span>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1b0d0f] dark:text-white mb-2">Email (Để
                                    nhận thông tin khóa học)</label>
                                <input v-model="form.email"
                                    class="w-full rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary"
                                    placeholder="email@example.com" type="email" />
                            </div>
                            <div class="md:col-span-2 space-y-4">
                                <h3 class="font-bold text-[#1b0d0f] dark:text-white">Địa chỉ nhận hàng</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-stone-500 mb-1">Tỉnh/Thành
                                            phố</label>
                                        <SearchableSelect v-model="form.province" :options="provinces"
                                            placeholder="Chọn Tỉnh/Thành" />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-stone-500 mb-1">Quận/Huyện</label>
                                        <SearchableSelect v-model="form.district" :options="districts"
                                            placeholder="Chọn Quận/Huyện" :disabled="!form.province" />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-stone-500 mb-1">Phường/Xã</label>
                                        <SearchableSelect v-model="form.ward" :options="wards"
                                            placeholder="Chọn Phường/Xã" :disabled="!form.district" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-stone-500 mb-1">Địa chỉ cụ thể</label>
                                    <textarea v-model="form.address"
                                        class="w-full rounded-lg border-[#e7cfd1] dark:border-[#3d2a2c] bg-background-light dark:bg-background-dark px-4 py-3 focus:ring-primary focus:border-primary"
                                        placeholder="Số nhà, tên đường..." rows="2"></textarea>
                                </div>
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
            @close="onPaymentClose" @confirm="onPaymentConfirm" />
        <AuthPopup v-if="showAuthPopup" @close="onAuthClose" />
    </div>
</template>

<script setup lang="ts">
import PaymentPopup from '~/components/checkout/PaymentPopup.vue'
import AuthPopup from '~/components/auth/AuthPopup.vue'
import SearchableSelect from '~/components/common/SearchableSelect.vue'

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

// Address Data
const provinces = ref<any[]>([])
const districts = ref<any[]>([])
const wards = ref<any[]>([])

// Voucher state
const voucherCode = ref('')
const appliedVoucher = ref<any>(null)
const voucherError = ref('')
const applyingVoucher = ref(false)

// Form data
const form = ref<any>({
    name: '',
    phone: '',
    email: '',
    province: null,
    district: null,
    ward: null,
    address: ''
})

const errors = ref({
    name: '',
    phone: ''
})

const clearError = (field: string) => {
    if (field === 'name') errors.value.name = ''
    if (field === 'phone') errors.value.phone = ''
}

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

// Address API calls
const fetchProvinces = async () => {
    try {
        const res: any = await $fetch(`${config.public.apiBase}/api/addresses/provinces`)
        if (res.success) provinces.value = res.data
    } catch (e) {
        console.error(e)
    }
}

const fetchDistricts = async (provinceId: any) => {
    try {
        const res: any = await $fetch(`${config.public.apiBase}/api/addresses/districts/${provinceId}`)
        if (res.success) districts.value = res.data
    } catch (e) {
        console.error(e)
    }
}

const fetchWards = async (districtId: any) => {
    try {
        const res: any = await $fetch(`${config.public.apiBase}/api/addresses/wards/${districtId}`)
        if (res.success) wards.value = res.data
    } catch (e) {
        console.error(e)
    }
}

// Watchers for cascading dropdowns
watch(() => form.value.province, (newVal) => {
    districts.value = []
    wards.value = []
    if (newVal) fetchDistricts(newVal)
})

watch(() => form.value.district, (newVal) => {
    wards.value = []
    if (newVal) fetchWards(newVal)
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
            // Check if voucher applies to courses or all orders
            const validApplies = ['course', 'all_orders']
            if (res.data.apply_to && !validApplies.includes(res.data.apply_to)) {
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

const tempOrderId = ref<number | null>(null)

const handlePayment = async () => {
    if (!user.value) {
        showAuthPopup.value = true
        return
    }

    // Reset errors
    errors.value = { name: '', phone: '' }
    let hasError = false

    if (!form.value.name) {
        errors.value.name = 'Vui lòng nhập họ và tên'
        hasError = true
    }

    if (!form.value.phone) {
        errors.value.phone = 'Vui lòng nhập số điện thoại'
        hasError = true
    } else {
        const phoneRegex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/
        if (!phoneRegex.test(form.value.phone)) {
            errors.value.phone = 'Số điện thoại không hợp lệ'
            hasError = true
        }
    }

    if (hasError) return

    // Resolve names for full address
    const provinceName = (form.value.province && Array.isArray(provinces.value))
        ? (provinces.value.find(p => p.id == form.value.province)?.name || '')
        : ''

    const districtName = (form.value.district && Array.isArray(districts.value))
        ? (districts.value.find(d => d.id == form.value.district)?.name || '')
        : ''

    const wardName = (form.value.ward && Array.isArray(wards.value))
        ? (wards.value.find(w => w.id == form.value.ward)?.name || '')
        : ''

    // Construct address from available parts
    const addressParts = [
        form.value.address,
        wardName,
        districtName,
        provinceName
    ].filter(part => part && part.trim() !== '')

    const fullAddress = addressParts.length > 0 ? addressParts.join(', ') : 'N/A'

    loading.value = true
    try {
        // Create order IMMEDIATELY
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
                address: fullAddress,
                course_id: course.value?.id,
                bank_id: selectedBank.value,
                voucher_code: appliedVoucher.value?.code || null,
                payment_method: 'qr_code'
            }
        })

        if (response.success && response.data) {
            tempOrderId.value = response.data.order_id
            orderCode.value = response.data.order_number // Use real order number
            showPayment.value = true
        } else {
            alert(response.message || 'Có lỗi xảy ra khi tạo đơn hàng')
        }
    } catch (error: any) {
        console.error('Order creation error:', error)
        alert(error.data?.message || 'Có lỗi xảy ra. Vui lòng thử lại.')
    } finally {
        loading.value = false
    }
}

const onAuthClose = () => {
    showAuthPopup.value = false
    // Do not auto-show payment, user needs to click pay again to ensure flow
}

// Handle payment confirmation - confirm order and redirect
const onPaymentConfirm = async () => {
    if (!tempOrderId.value) return

    try {
        // Confirm transfer
        await $fetch(`${config.public.apiBase}/api/orders/${tempOrderId.value}/confirm`, {
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
                order: orderCode.value,
                total: totalAmount.value,
                course: course.value?.name || 'Khóa học'
            }
        })
    } catch (error: any) {
        console.error('Order confirm error:', error)
        alert(error.data?.message || 'Có lỗi xảy ra khi xác nhận.')
    }
}

const onPaymentClose = async () => {
    if (tempOrderId.value) {
        try {
            await $fetch(`${config.public.apiBase}/api/orders/${tempOrderId.value}/cancel`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${useCookie('auth_token').value}`
                }
            })
        } catch (error) {
            console.error('Failed to cancel order:', error)
        }
    }
    showPayment.value = false
    tempOrderId.value = null
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

    // Fetch Initial Address Data
    await fetchProvinces()

    // Populate from user if logged in
    if (user.value) {
        if (user.value.province) form.value.province = user.value.province
        if (user.value.district) form.value.district = user.value.district
        if (user.value.ward) form.value.ward = user.value.ward

        // Trigger cascading fetches
        if (form.value.province) await fetchDistricts(form.value.province)
        if (form.value.district) await fetchWards(form.value.district)
    }



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
