<template>
  <div class="checkout-page">
    <div class="container">
      <div class="row">
        <!-- Left Column: Information -->
        <div class="col-lg-8 col-md-8">            
            <div class="checkout-form">
                <h2 class="section-title">Thông tin thanh toán</h2>
                <div class="form-group">
                    <label>Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" v-model="form.name" class="form-control" placeholder="Nhập họ tên của bạn">
                </div>
                
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" v-model="form.phone" class="form-control" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Email</label>
                        <input type="email" v-model="form.email" class="form-control" placeholder="Nhập email">
                    </div>
                </div>

                <div class="form-group">
                    <label>Địa chỉ giao hàng <span class="text-danger">*</span></label>
                    <textarea v-model="form.address" class="form-control" rows="3" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành..."></textarea>
                </div>

                <h2 class="section-title mt-4 mb-2">Phương thức thanh toán</h2>
                <div class="payment-methods mb-3">
                    <div class="payment-option" :class="{ active: paymentMethod === 'bank' }" @click="paymentMethod = 'bank'">
                        <i class="fas fa-qrcode"></i>
                        <span>Chuyển khoản / QR Code</span>
                    </div>
                    <div class="payment-option" :class="{ active: paymentMethod === 'cod' }" @click="paymentMethod = 'cod'">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Thanh toán khi nhận hàng (COD)</span>
                    </div>
                </div>

                <div v-if="paymentMethod === 'bank'">
                    <h4 class="mb-3">Chọn ngân hàng</h4>
                    <div class="bank-list">
                        <div 
                            v-for="bank in banks" 
                            :key="bank.id" 
                            class="bank-item" 
                            :class="{ active: form.bank_id === bank.id }"
                            @click="selectBank(bank)"
                        >
                            <div class="bank-logo">
                                <i class="fas fa-university fa-2x"></i>
                            </div>
                            <div class="bank-info">
                                <strong>{{ bank.bank_name }}</strong>
                                <br>
                                <span>{{ bank.account_number }}</span>
                            </div>
                            <div class="check-icon" v-if="form.bank_id === bank.id"><i class="fas fa-check-circle"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="col-lg-4 col-md-4">
            <div class="order-summary-card">
                <h2 class="section-title">Đơn hàng của bạn</h2>
                
                <div v-if="cartStore.items.length === 0" class="text-muted text-center py-4">
                    Giỏ hàng trống
                </div>
                
                <div v-else>
                    <div class="cart-items-list">
                        <div v-for="(item, index) in cartStore.items" :key="index" class="cart-item-row">
                            <div class="item-img">
                                <img :src="item.image" :alt="item.name" />
                            </div>
                            <div class="item-info">
                                <h5>{{ item.name }}</h5>
                                <span class="text-muted">x{{ item.quantity }}</span>
                            </div>
                            <div class="item-price">
                                {{ formatPrice(item.price * item.quantity) }} đ
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Voucher Input -->
                    <div class="voucher-input mb-3">
                        <input type="text" class="form-control" v-model="voucherCode" placeholder="Nhập mã giảm giá">
                        <small class="text-danger d-block mt-1" v-if="voucherError">{{ voucherError }}</small>
                        <small class="text-success d-block mt-1" v-if="appliedVoucher">Đã áp dụng mã giảm {{ appliedVoucher.discount_percentage }}%</small>
                    </div>
                    
                    <div class="summary-row">
                        <span>Tạm tính</span>
                        <span>{{ formatPrice(cartStore.subtotal) }} đ</span>
                    </div>
                    <div class="summary-row">
                        <span>Giảm giá</span>
                        <span>- {{ formatPrice(discountAmount) }} đ</span>
                    </div>
                    <hr>
                    <div class="summary-row total">
                        <span>Tổng cộng</span>
                        <span class="text-primary">{{ formatPrice(finalPrice) }} đ</span>
                    </div>

                    <button class="btn-checkout mt-3" @click="processPayment" :disabled="loading || !isValid">
                        <span v-if="loading">Đang xử lý...</span>
                        <span v-else>ĐẶT HÀNG NGAY</span>
                    </button>
                </div>
            </div>
        </div>
      </div>
    </div>

    <!-- Payment Modal -->
    <div class="payment-modal-overlay" v-if="showPaymentInfo" @click="closePaymentModal">
        <div class="payment-modal" @click.stop>
            <div class="modal-header">
                <h3>Quét mã để thanh toán</h3>
                <button @click="closePaymentModal" class="close-btn">&times;</button>
            </div>
            <div class="modal-body text-center">
                <template v-if="!paymentExpired">
                    <p class="text-muted mb-2">Vui lòng quét mã QR hoặc chuyển khoản theo thông tin bên dưới.</p>
                    
                    <div class="timer-countdown mb-3 text-danger fw-bold fs-5">
                        <i class="fas fa-clock"></i> Thời gian còn lại: {{ timerDisplay }}
                    </div>

                    <div class="qr-placeholder mb-3">
                        <img :src="qrCodeUrl" alt="VietQR" style="max-width: 200px;">
                    </div>

                    <div class="transfer-details text-start bg-light p-3 rounded">
                        <p><strong>Ngân hàng:</strong> {{ selectedBank?.bank_name }}</p>
                        <p><strong>Số tài khoản:</strong> <span class="text-primary">{{ selectedBank?.account_number }}</span></p>
                        <p><strong>Chủ tài khoản:</strong> {{ selectedBank?.account_name }}</p>
                        <p><strong>Số tiền:</strong> <span class="text-danger fw-bold">{{ formatPrice(finalPrice) }} đ</span></p>
                        <p><strong>Nội dung CK:</strong> <span class="badge bg-warning text-dark fs-6">{{ transferContent }}</span></p>
                    </div>
                </template>
                
                <template v-else>
                    <div class="expired-state py-4">
                        <div class="text-danger mb-3" style="font-size: 3rem;"><i class="fas fa-times-circle"></i></div>
                        <h4>Mã thanh toán đã hết hạn</h4>
                        <p class="text-muted">Vui lòng tạo mã thanh toán mới để tiếp tục.</p>
                        <button class="btn btn-primary mt-2" @click="renewPayment">Tạo mã thanh toán mới</button>
                    </div>
                </template>

                <div class="alert alert-info mt-3 fs-sm" v-if="!paymentExpired">
                    <i class="fas fa-info-circle"></i> Đơn hàng sẽ được xử lý sau khi nhận được thanh toán.
                </div>
            </div>
            <div class="modal-footer" v-if="!paymentExpired">
                <button class="btn-confirm" @click="confirmPayment">TÔI ĐÃ CHUYỂN KHOẢN</button>
            </div>
        </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import { useToast } from 'vue-toastification'
import { useAuthStore } from '../stores/auth'
import { useCartStore } from '../stores/cart'

const router = useRouter()
const toast = useToast()
const authStore = useAuthStore()
const cartStore = useCartStore()

const banks = ref([])
const loading = ref(false)
const showPaymentInfo = ref(false)
const selectedBank = ref(null)
const transferContent = ref('')
const qrCodeUrl = ref('')

const orderCode = ref('')
const createdOrderId = ref(null)

const voucherCode = ref('')
const voucherError = ref('')
const discountAmount = ref(0)
const appliedVoucher = ref(null)

const paymentMethod = ref('bank')

const timeLeft = ref(180)
const paymentExpired = ref(false)
let timerInterval = null

const timerDisplay = computed(() => {
    const m = Math.floor(timeLeft.value / 60)
    const s = timeLeft.value % 60
    return `${m}:${s < 10 ? '0' + s : s}`
})

const form = ref({
    name: '',
    phone: '',
    email: '',
    address: '',
    bank_id: null
})

const isValid = computed(() => {
    if (paymentMethod.value === 'cod') {
        return form.value.name && form.value.phone && form.value.address
    }
    return form.value.name && form.value.phone && form.value.address && form.value.bank_id
})

watch(() => authStore.user, (newVal) => {
    if (newVal) {
        form.value.name = newVal.name || ''
        form.value.phone = newVal.phone || ''
        form.value.email = newVal.email || ''
        form.value.address = newVal.address || ''
    }
}, { immediate: true })

const formatPrice = (value) => {
    if (!value) return '0'
    return new Intl.NumberFormat('vi-VN').format(value)
}

const finalPrice = computed(() => {
    return cartStore.subtotal - discountAmount.value
})

let voucherTimeout = null

const checkVoucher = async () => {
    voucherError.value = ''
    appliedVoucher.value = null
    discountAmount.value = 0
    
    if (!voucherCode.value) return

    try {
        const res = await axios.post('http://127.0.0.1:8000/api/vouchers/check', {
            code: voucherCode.value
        })

        if (res.data && res.data.success) {
            appliedVoucher.value = res.data.data
            const percentage = appliedVoucher.value.discount_percentage
            discountAmount.value = (cartStore.subtotal * percentage) / 100
        }
    } catch (error) {
        console.error(error)
        if (error.response?.data?.message) {
             voucherError.value = error.response.data.message
        } else {
             voucherError.value = 'Mã giảm giá không hợp lệ'
        }
    }
}

watch(voucherCode, (newVal) => {
    voucherError.value = ''
    if (appliedVoucher.value && appliedVoucher.value.code !== newVal) {
         appliedVoucher.value = null
         discountAmount.value = 0
    }

    clearTimeout(voucherTimeout)
    
    if (!newVal) return

    voucherTimeout = setTimeout(() => {
        checkVoucher()
    }, 2000)
})

const loadData = async () => {
    loading.value = true
    try {
        if (authStore.token && !authStore.user) {
            await authStore.fetchUser()
        }

        if (authStore.user) {
            form.value.name = authStore.user.name || ''
            form.value.phone = authStore.user.phone || ''
            form.value.email = authStore.user.email || ''
            form.value.address = authStore.user.address || ''
        }

        // Load Banks
        const bankRes = await axios.get('http://127.0.0.1:8000/api/banks')
        if (bankRes.data && bankRes.data.success) {
            banks.value = bankRes.data.data
        }
        
    } catch (error) {
        console.error("Error loading data:", error)
    } finally {
        loading.value = false
    }
}

const selectBank = (bank) => {
    form.value.bank_id = bank.id
    selectedBank.value = bank
}

const closePaymentModal = () => {
    showPaymentInfo.value = false
    clearInterval(timerInterval)
}

const startTimer = () => {
    clearInterval(timerInterval)
    timeLeft.value = 180
    paymentExpired.value = false
    
    timerInterval = setInterval(() => {
        if (timeLeft.value > 0) {
            timeLeft.value--
        } else {
            paymentExpired.value = true
            clearInterval(timerInterval)
        }
    }, 1000)
}

const renewPayment = () => {
    processPayment()
}

const processPayment = async () => {
    if (!isValid.value) return
    if (cartStore.items.length === 0) {
        toast.warning("Giỏ hàng trống!")
        return
    }
    
    loading.value = true
    
    try {
        const payload = {
            name: form.value.name,
            phone: form.value.phone,
            email: form.value.email,
            address: form.value.address,
            items: cartStore.items.map(item => ({ id: item.id, quantity: item.quantity })),
            voucher_code: voucherCode.value || null,
            payment_method: paymentMethod.value,
            bank_id: paymentMethod.value === 'bank' ? form.value.bank_id : null
        }

        const res = await axios.post('http://127.0.0.1:8000/api/orders', payload)

        if (res.data && res.data.success) {
            const data = res.data.data
            orderCode.value = data.order_number
            createdOrderId.value = data.order_id
            
            // Clear cart
            cartStore.clearCart()

            if (paymentMethod.value === 'cod') {
                toast.success("Đặt hàng thành công! Chúng tôi sẽ liên hệ bạn sớm.")
                if (authStore.token) router.push('/profile?tab=orders')
                else router.push('/')
            } else {
                // Bank Transfer -> Show QR
                transferContent.value = `KH ${form.value.phone} ${orderCode.value}`.toUpperCase()
                
                let bankName = selectedBank.value.bank_name.toUpperCase()
                let bankShortName = 'VCB'
                
                if (bankName.includes('MB')) bankShortName = 'MB'
                else if (bankName.includes('VIETCOM')) bankShortName = 'VCB'
                else if (bankName.includes('VP')) bankShortName = 'VPBank'
                else if (bankName.includes('TECHCOM')) bankShortName = 'TCB'
                else if (bankName.includes('ACB')) bankShortName = 'ACB'
                else if (bankName.includes('BIDV')) bankShortName = 'BIDV'
                else if (bankName.includes('VIETIN')) bankShortName = 'ICB'
                else if (bankName.includes('TPB')) bankShortName = 'TPB'
                
                qrCodeUrl.value = `https://img.vietqr.io/image/${bankShortName}-${selectedBank.value.account_number}-compact.png?amount=${data.final_amount}&addInfo=${encodeURIComponent(transferContent.value)}&accountName=${encodeURIComponent(selectedBank.value.account_name)}`

                showPaymentInfo.value = true
                startTimer()
            }
        }
    } catch (error) {
        console.error(error)
        toast.error(error.response?.data?.message || "Lỗi khi tạo đơn hàng. Vui lòng thử lại.")
    } finally {
        loading.value = false
    }
}

const confirmPayment = async () => {
    if (!createdOrderId.value) return
    
    try {
        const res = await axios.post(`http://127.0.0.1:8000/api/orders/${createdOrderId.value}/confirm`)
        if (res.data && res.data.success) {
            toast.success("Đã ghi nhận thông báo chuyển khoản! Vui lòng chờ xác nhận.")
            
            if (authStore.token) {
                 router.push('/profile?tab=orders')
            } else {
                 router.push('/')
            }
        }
    } catch (error) {
        console.error(error)
        toast.error("Lỗi khi xác nhận. Vui lòng liên hệ CSKH.")
    }
}

onMounted(() => {
    loadData()
    cartStore.loadFromStorage()
})
</script>

<style scoped>
.checkout-page {
    padding-top: 168px;
    padding-bottom: 80px;
    background: #f8f9fa;
    min-height: 80vh;
}

.section-title {
    margin-top: 30px;
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

.checkout-form {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.form-group {
    margin-bottom: 20px;
}
.form-group label {
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    color: #555;
}
.form-control {
    height: 45px;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 0 15px;
}
textarea.form-control {
    height: auto;
    padding: 15px;
}

.payment-methods {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}
.payment-option {
    border: 2px solid #ddd;
    padding: 15px 20px;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s;
}
.payment-option:hover { border-color: #a435f0; }
.payment-option.active { border-color: #a435f0; background: #fdf5ff; }

.bank-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
}
.bank-item {
    border: 2px solid #eee;
    padding: 15px;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 15px;
    position: relative;
    transition: all 0.2s;
}
.bank-item:hover { border-color: #a435f0; }
.bank-item.active { border-color: #a435f0; background: #fdf5ff; }
.check-icon { position: absolute; top: 10px; right: 10px; color: #a435f0; }

.order-summary-card {
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    position: sticky;
    top: 120px;
}

.cart-items-list {
    max-height: 300px;
    overflow-y: auto;
}
.cart-item-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}
.cart-item-row .item-img {
    width: 60px;
    height: 60px;
}
.cart-item-row .item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
}
.cart-item-row .item-info {
    flex: 1;
}
.cart-item-row .item-info h5 {
    font-size: 14px;
    margin: 0 0 5px 0;
}
.cart-item-row .item-price {
    font-weight: bold;
    white-space: nowrap;
}

.voucher-input { margin-bottom: 20px; }
.summary-row { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 15px; }
.summary-row.total { font-size: 18px; font-weight: bold; margin-top: 15px; }
.btn-checkout {
    width: 100%;
    background: #a435f0;
    color: white;
    border: none;
    padding: 15px;
    font-weight: bold;
    border-radius: 6px;
    font-size: 16px;
}
.btn-checkout:disabled { background: #ccc; cursor: not-allowed; }

/* Modal */
.payment-modal-overlay {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.6);
    z-index: 9999;
    display: flex; align-items: center; justify-content: center;
}
.payment-modal {
    background: white;
    width: 90%; max-width: 500px;
    border-radius: 12px;
    overflow: hidden;
    animation: slideUp 0.3s ease;
}
.modal-header { padding: 15px 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
.close-btn {
    background: none;
    border: none;
    font-size: 32px;
    font-weight: bold;
    cursor: pointer;
    color: #666;
    line-height: 1;
    padding: 0 10px;
}
.close-btn:hover { color: #dc3545; }
.modal-body { padding: 20px; }
.modal-footer { padding: 15px 20px; border-top: 1px solid #eee; text-align: center; }
.btn-confirm { background: #28a745; color: white; border: none; padding: 12px 30px; border-radius: 6px; font-weight: bold; }

@keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
</style>
