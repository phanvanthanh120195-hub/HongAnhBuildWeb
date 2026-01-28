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
                                 <span class="amount">${{ (item.price * item.quantity).toFixed(2) }}</span>
                              </td>
                           </tr>
                        </tbody>
                        <tfoot>
                           <tr class="cart-subtotal">
                              <th>Subtotal</th>
                              <td><span class="amount">${{ cartStore.totalPrice.toFixed(2) }}</span></td>
                           </tr>
                           <tr class="shipping">
                              <th>Shipping</th>
                              <td>Free Shipping</td>
                           </tr>
                           <tr class="order-total">
                              <th>Total</th>
                              <td><strong><span class="amount">${{ cartStore.totalPrice.toFixed(2) }}</span></strong></td>
                           </tr>
                        </tfoot>
                     </table>
                     
                     <div class="payment-methods">
                        <div class="payment-option">
                           <input type="radio" id="bank" value="bank" v-model="paymentMethod">
                           <label for="bank">Direct Bank Transfer</label>
                           <div class="payment-desc" v-show="paymentMethod === 'bank'">
                              Make your payment directly into our bank account. Please use your Order ID as the payment reference.
                              Your order will not be shipped until the funds have cleared in our account.
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
                     
                     <button type="submit" class="btn btn-place-order">PLACE ORDER</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useCartStore } from '@/stores/cart'
import { useRouter } from 'vue-router'

const cartStore = useCartStore()
const router = useRouter()

const billing = ref({
   firstName: '',
   lastName: '',
   company: '',
   country: 'Vietnam',
   address: '',
   city: '',
   phone: '',
   email: '',
   notes: ''
})

const paymentMethod = ref('bank')

function placeOrder() {
   if(cartStore.items.length === 0) {
      alert('Your cart is empty!')
      return
   }
   
   // Mock Order Submission
   alert('Order Placed Successfully! Thank you ' + billing.value.firstName)
   cartStore.items = [] // Clear Cart
   router.push('/')
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
</style>
