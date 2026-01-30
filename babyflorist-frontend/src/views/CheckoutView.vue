<template>
  <div class="checkout-page">
    <div class="container">
      <ul class="breadcrumb">
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/cart">Shopping Cart</router-link></li>
        <li>Checkout</li>
      </ul>
      
      <div class="checkout-content">
         <h1 class="page-title">Checkout</h1>
         
         <form @submit.prevent="placeOrder">
            <div class="row">
               <!-- Billing Details -->
               <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                  <div class="billing-details">
                     <h3>Billing Details</h3>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>First Name <span class="required">*</span></label>
                              <input type="text" class="form-control" v-model="billing.firstName" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Last Name <span class="required">*</span></label>
                              <input type="text" class="form-control" v-model="billing.lastName" required>
                           </div>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label>Company Name (Optional)</label>
                        <input type="text" class="form-control" v-model="billing.company">
                     </div>
                     
                     <div class="form-group">
                        <label>Country <span class="required">*</span></label>
                        <select class="form-control" v-model="billing.country">
                           <option value="Vietnam">Vietnam</option>
                           <option value="USA">USA</option>
                           <option value="UK">UK</option>
                        </select>
                     </div>
                     
                     <div class="form-group">
                        <label>Street Address <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="House number and street name" v-model="billing.address" required>
                     </div>

                     <div class="form-group">
                        <label>Town / City <span class="required">*</span></label>
                        <input type="text" class="form-control" v-model="billing.city" required>
                     </div>
                     
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Phone <span class="required">*</span></label>
                              <input type="tel" class="form-control" v-model="billing.phone" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Email Address <span class="required">*</span></label>
                              <input type="email" class="form-control" v-model="billing.email" required>
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <label>Order Notes (Optional)</label>
                        <textarea class="form-control" rows="4" placeholder="Notes about your order, e.g. special notes for delivery." v-model="billing.notes"></textarea>
                     </div>
                  </div>
               </div>
               
               <!-- Order Summary -->
               <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                  <div class="order-summary-box">
                     <h3>Your Order</h3>
                     <table class="shop_table">
                        <thead>
                           <tr>
                              <th class="product-name">Product</th>
                              <th class="product-total">Total</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="item in cartStore.items" :key="item.id">
                              <td class="product-name">
                                 {{ item.name }}&nbsp; <strong class="product-quantity">× {{ item.quantity }}</strong>
                              </td>
                              <td class="product-total">
                                 <span class="amount">{{ formatCurrency(item.price * item.quantity) }}</span>
                              </td>
                           </tr>
                        </tbody>
                        <tfoot>
                           <tr class="cart-subtotal">
                              <th>Subtotal</th>
                              <td><span class="amount">{{ formatCurrency(cartStore.subtotal) }}</span></td>
                           </tr>
                           <tr class="shipping">
                              <th>Shipping</th>
                              <td>Free Shipping</td>
                           </tr>
                           <tr class="order-total">
                              <th>Total</th>
                              <td><strong><span class="amount">{{ formatCurrency(cartStore.subtotal) }}</span></strong></td>
                           </tr>
                        </tfoot>
                     </table>
                     
                     <div class="payment-methods">
                        <div class="payment-option">
                           <input type="radio" id="bank" value="bank" v-model="paymentMethod">
                           <label for="bank">Direct Bank Transfer (QR Code)</label>
                           <div class="payment-desc" v-show="paymentMethod === 'bank'">
                              <p>Make your payment directly into our bank account using QR Code.</p>
                              <div v-if="banks.length > 0" class="bank-select mt-2">
                                  <label>Select Bank:</label>
                                  <select class="form-control" v-model="selectedBank">
                                      <option v-for="bank in banks" :key="bank.id" :value="bank">
                                          {{ bank.bank_short_name }} - {{ bank.account_number }}
                                      </option>
                                  </select>
                              </div>
                           </div>
                        </div>
                        <div class="payment-option">
                           <input type="radio" id="cod" value="cod" v-model="paymentMethod">
                           <label for="cod">Cash on Delivery</label>
                           <div class="payment-desc" v-show="paymentMethod === 'cod'">
                              Pay with cash upon delivery.
                           </div>
                        </div>
                     </div>
                     
                     <button type="submit" class="btn btn-place-order" :disabled="loading">
                        {{ loading ? 'PROCESSING...' : 'PLACE ORDER' }}
                     </button>
                  </div>
               </div>
            </div>
         </form>
      </div>
    </div>

    <!-- QR Payment Modal -->
    <div v-if="showPaymentModal" class="modal-overlay">
        <div class="modal-content">
            <button class="close-modal" @click="showPaymentModal = false">&times;</button>
            <h3 class="modal-title">Scan QR to Pay</h3>
            
            <div class="text-center">
                <p>Please scan the QR code below to complete payment.</p>
                <div class="qr-container">
                    <img :src="qrCodeUrl" alt="QR Code" class="qr-image" v-if="qrCodeUrl">
                </div>
                
                <div class="payment-details mt-3">
                    <p><strong>Bank:</strong> {{ selectedBank?.bank_name }}</p>
                    <p><strong>Account No:</strong> {{ selectedBank?.account_number }}</p>
                    <p><strong>Account Name:</strong> {{ selectedBank?.account_name }}</p>
                    <p><strong>Amount:</strong> <span class="text-danger">{{ finalAmount.toLocaleString() }} đ</span></p>
                    <p><strong>Content:</strong> <span class="badge bg-warning text-dark">{{ transferContent }}</span></p>
                </div>
                
                <button class="btn btn-confirm-payment mt-3" @click="confirmTransfer" :disabled="processing">
                    {{ processing ? 'Confirming...' : 'I HAVE TRANSFERRED' }}
                </button>
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from 'vue'
import { useCartStore } from '@/stores/cart'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import axios from 'axios'
import { useToast } from 'vue-toastification'

const cartStore = useCartStore()
const authStore = useAuthStore()
const router = useRouter()
const toast = useToast()

const billing = ref({
   firstName: '',
   lastName: '', // We might merge to 'name' for backend compatibility
   company: '',
   country: 'Vietnam',
   address: '',
   city: '',
   phone: '',
   email: '',
   notes: ''
})

const paymentMethod = ref('bank')
const loading = ref(false)
const processing = ref(false)

// Bank Info for QR
const banks = ref([])
const selectedBank = ref(null)
const showPaymentModal = ref(false)
const createdOrderId = ref(null)
const createdOrderNumber = ref('')
const qrCodeUrl = ref('')
const transferContent = ref('')
const finalAmount = ref(0) // To store actual amount from backend

function formatCurrency(value) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value || 0);
}

onMounted(async () => {
    // Fill from Auth
    if (authStore.user) {
        billing.value.firstName = authStore.user.name || ''
        billing.value.email = authStore.user.email || ''
        billing.value.phone = authStore.user.phone || ''
        billing.value.address = authStore.user.address || ''
        
        // Try to split name if needed, but backend expects 'name'
    }
    
    // Fetch Banks
    try {
        const res = await axios.get('http://127.0.0.1:8000/api/banks')
        if (res.data.success) {
            banks.value = res.data.data
            // Default select VPBank (id 2) or first one
            selectedBank.value = banks.value.find(b => b.id === 2) || banks.value[0]
        }
    } catch (e) {
        console.error(e)
    }
})

async function placeOrder() {
   if(cartStore.items.length === 0) {
      toast.warning('Your cart is empty!')
      return
   }
   
   loading.value = true
   
   try {
       const payload = {
           name: billing.value.firstName + (billing.value.lastName ? ' ' + billing.value.lastName : ''),
           phone: billing.value.phone,
           email: billing.value.email,
           address: billing.value.address + (billing.value.city ? ', ' + billing.value.city : ''),
           items: cartStore.items.map(item => ({ id: item.id, quantity: item.quantity })),
           notes: billing.value.notes,
           payment_method: paymentMethod.value,
           bank_id: paymentMethod.value === 'bank' ? selectedBank.value?.id : null
       }
       
       const res = await axios.post('http://127.0.0.1:8000/api/orders', payload)
       
       if (res.data && res.data.success) {
           cartStore.items = [] // Clear Cart
           
           if (paymentMethod.value === 'cod') {
               toast.success("Order placed successfully!")
               if (authStore.token) router.push('/profile?tab=orders')
               else router.push('/')
           } else {
               // Bank Transfer -> Show QR
               const data = res.data.data
               createdOrderId.value = data.order_id
               createdOrderNumber.value = data.order_number
               finalAmount.value = data.final_amount
               
               generateQR()
               showPaymentModal.value = true
           }
       }
   } catch (error) {
       console.error(error)
       toast.error(error.response?.data?.message || "Failed to place order")
   } finally {
       loading.value = false
   }
}

function generateQR() {
    if (!selectedBank.value || !createdOrderNumber.value) return
    
    transferContent.value = `KH ${billing.value.phone} ${createdOrderNumber.value}`.toUpperCase()
    
    let bankShortName = 'VPBank' // fallback
    const bankName = selectedBank.value.bank_name.toUpperCase()
    if (bankName.includes('MB')) bankShortName = 'MB'
    else if (bankName.includes('VIETCOM')) bankShortName = 'VCB'
    else if (bankName.includes('VP')) bankShortName = 'VPBank'
    else if (bankName.includes('TECHCOM')) bankShortName = 'TCB'
    else if (bankName.includes('ACB')) bankShortName = 'ACB'
    else if (bankName.includes('BIDV')) bankShortName = 'BIDV'
    else if (bankName.includes('VIETIN')) bankShortName = 'ICB'
    else if (bankName.includes('TPB')) bankShortName = 'TPB'

    qrCodeUrl.value = `https://img.vietqr.io/image/${bankShortName}-${selectedBank.value.account_number}-compact.png?amount=${finalAmount.value}&addInfo=${encodeURIComponent(transferContent.value)}&accountName=${encodeURIComponent(selectedBank.value.account_name)}`
}

async function confirmTransfer() {
    if (!createdOrderId.value) return
    processing.value = true
    try {
        await axios.post(`http://127.0.0.1:8000/api/orders/${createdOrderId.value}/confirm`)
        toast.success("Payment confirmation sent!")
        showPaymentModal.value = false
        if (authStore.token) router.push('/profile?tab=orders')
        else window.location.reload()
    } catch (e) {
        toast.error("Error confirming payment")
    } finally {
        processing.value = false
    }
}

</script>

<style scoped>
.checkout-page {
  padding-top: 150px;
  padding-bottom: 80px;
}

.page-title {
  font-family: 'Abril Fatface';
  text-align: center;
  margin-bottom: 50px;
}

.billing-details h3, .order-summary-box h3 {
  font-family: 'Abril Fatface';
  border-bottom: 1px solid #eee;
  padding-bottom: 15px;
  margin-bottom: 25px;
  font-size: 24px;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  font-weight: 600;
  margin-bottom: 8px;
  font-size: 14px;
}

.required { color: red; }

.form-control {
  width: 100%;
  height: 45px;
  padding: 10px 15px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

textarea.form-control {
  height: auto;
}

/* Order Summary */
.order-summary-box {
  background: #f9f9f9;
  padding: 30px;
  border: 1px solid #eee;
}

.shop_table {
  width: 100%;
  margin-bottom: 30px;
}

.shop_table th {
  text-align: left;
  padding: 15px 0;
  border-bottom: 1px solid #eee;
}

.shop_table td {
  padding: 15px 0;
  border-bottom: 1px solid #eee;
}

.product-total, .shop_table tfoot td {
  text-align: right;
}

.cart-subtotal th, .shipping th, .order-total th {
  font-weight: bold;
}

.order-total span {
  font-size: 18px;
  color: #e18787;
}

/* Payment Methods */
.payment-methods {
  margin-bottom: 30px;
  border-top: 1px solid #ddd;
  padding-top: 20px;
}

.payment-option {
  margin-bottom: 15px;
}

.payment-option label {
  font-weight: bold;
  margin-left: 10px;
  cursor: pointer;
}

.payment-desc {
  background: #eee;
  padding: 10px;
  font-size: 13px;
  margin-top: 5px;
  position: relative;
}

.payment-desc::before {
  content: '';
  border: 8px solid transparent;
  border-bottom-color: #eee;
  position: absolute;
  top: -16px;
  left: 10px;
}

.btn-place-order {
  width: 100%;
  background: black;
  color: white;
  height: 50px;
  border: none;
  font-weight: bold;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.3s;
}

.btn-place-order:hover {
  background: #e18787;
}

@media (max-width: 991px) {
  .order-summary-box { margin-top: 40px; }
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
}

.modal-content {
    background: white;
    padding: 30px;
    border-radius: 12px;
    width: 400px;
    max-width: 90%;
    position: relative;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}

.close-modal {
    position: absolute;
    top: 10px;
    right: 15px;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
}

.btn-confirm-payment {
    width: 100%;
    background: #4CAF50;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}

.btn-confirm-payment:hover {
    background: #45a049;
}

.qr-image {
    max-width: 100%;
    height: auto;
}
</style>
