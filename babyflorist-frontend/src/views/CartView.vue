<template>
  <div class="cart-page">
    <div class="container">
      <div class="breadcrumb-nav">
        <router-link to="/">Trang chủ</router-link>
        <span>/</span>
        <span>Giỏ hàng</span>
      </div>
      
      <h1 class="page-title">Giỏ hàng của bạn</h1>

      <div class="row" v-if="cartStore.items.length > 0">
        <!-- Cart Items -->
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="cart-items-container">
            <div class="cart-item" v-for="(item, index) in cartStore.items" :key="index">
              <div class="item-image">
                <router-link :to="`/products/${item.slug || item.id}`">
                  <img :src="item.image" :alt="item.name">
                </router-link>
              </div>
              <div class="item-details">
                <router-link :to="`/products/${item.slug || item.id}`" class="item-name">
                  {{ item.name }}
                </router-link>
                <span class="item-type" v-if="item.type === 'course'">Khóa học</span>
                <span class="item-type" v-else>Sản phẩm</span>
                <div class="item-price-mobile">{{ formatPrice(item.price) }} đ</div>
              </div>
              <div class="item-price">
                {{ formatPrice(item.price) }} đ
              </div>
              <div class="item-quantity">
                <div class="quantity-control">
                  <button @click="decreaseQty(index)" :disabled="item.quantity <= 1">
                    <i class="fas fa-minus"></i>
                  </button>
                  <span class="qty-value">{{ item.quantity }}</span>
                  <button @click="increaseQty(index)">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="item-subtotal">
                {{ formatPrice(item.price * item.quantity) }} đ
              </div>
              <button class="remove-btn" @click="removeItem(index)">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          </div>
          
          <div class="cart-actions">
            <router-link to="/products" class="btn-continue">
              <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
            </router-link>
            <button class="btn-clear" @click="clearCart">
              <i class="fas fa-trash"></i> Xóa giỏ hàng
            </button>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="order-summary">
            <h2>Tóm tắt đơn hàng</h2>
            
            <div class="summary-row">
              <span>Tạm tính ({{ cartStore.totalItems }} sản phẩm)</span>
              <span>{{ formatPrice(cartStore.subtotal) }} đ</span>
            </div>
            
            <hr>
            
            <div class="summary-row total">
              <span>Tổng cộng</span>
              <span class="total-price">{{ formatPrice(cartStore.subtotal) }} đ</span>
            </div>
            
            <button class="btn-checkout" @click="goToCheckout">
              <i class="fas fa-lock"></i> THANH TOÁN
            </button>
            
            <div class="payment-methods">
              <p>Chấp nhận thanh toán:</p>
              <div class="payment-icons">
                <i class="fas fa-money-bill-wave" title="Tiền mặt"></i>
                <i class="fas fa-qrcode" title="QR Code"></i>
                <i class="fas fa-university" title="Chuyển khoản"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty Cart -->
      <div v-else class="empty-cart">
        <div class="empty-cart-icon">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <h2>Giỏ hàng của bạn đang trống</h2>
        <p>Hãy khám phá các sản phẩm tuyệt vời của chúng tôi!</p>
        <router-link to="/products" class="btn-shop-now">
          <i class="fas fa-store"></i> Mua sắm ngay
        </router-link>
      </div>

    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useCartStore } from '@/stores/cart'
import { useAuthStore } from '@/stores/auth'
import { useAuthModalStore } from '@/stores/authModal'
import { useRouter } from 'vue-router'
import { useToast } from 'vue-toastification'

const cartStore = useCartStore()
const authStore = useAuthStore()
const authModalStore = useAuthModalStore()
const router = useRouter()
const toast = useToast()

onMounted(() => {
  cartStore.loadFromStorage()
})

const formatPrice = (value) => {
  if (!value) return '0'
  return new Intl.NumberFormat('vi-VN').format(value)
}

function increaseQty(index) {
  const item = cartStore.items[index]
  cartStore.updateQuantity(index, item.quantity + 1)
}

function decreaseQty(index) {
  const item = cartStore.items[index]
  if (item.quantity > 1) {
    cartStore.updateQuantity(index, item.quantity - 1)
  }
}

function removeItem(index) {
  cartStore.removeItem(index)
  toast.success('Đã xóa sản phẩm khỏi giỏ hàng')
}

function clearCart() {
  if (confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')) {
    cartStore.clearCart()
    toast.info('Đã xóa giỏ hàng')
  }
}

function goToCheckout() {
  if (!authStore.token) {
    toast.warning('Vui lòng đăng nhập để thanh toán')
    authModalStore.openLogin('/checkout')
    return
  }
  router.push('/checkout')
}
</script>

<style scoped>
.cart-page {
  padding-top: 150px;
  padding-bottom: 80px;
  background: #f8f9fa;
  min-height: 80vh;
}

.breadcrumb-nav {
  margin-bottom: 20px;
  font-size: 14px;
  color: #666;
}
.breadcrumb-nav a {
  color: #666;
  text-decoration: none;
}
.breadcrumb-nav a:hover {
  color: #a435f0;
}
.breadcrumb-nav span {
  margin: 0 8px;
}

.page-title {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 30px;
  color: #333;
}

/* Cart Items */
.cart-items-container {
  background: white;
  border-radius: 12px;
  box-shadow: 0 2px 15px rgba(0,0,0,0.05);
  overflow: hidden;
}

.cart-item {
  display: flex;
  align-items: center;
  padding: 20px;
  border-bottom: 1px solid #f0f0f0;
  gap: 15px;
}
.cart-item:last-child {
  border-bottom: none;
}

.item-image {
  width: 100px;
  height: 100px;
  flex-shrink: 0;
}
.item-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 8px;
}

.item-details {
  flex: 1;
  min-width: 0;
}
.item-name {
  display: block;
  font-size: 16px;
  font-weight: 600;
  color: #333;
  text-decoration: none;
  margin-bottom: 5px;
}
.item-name:hover {
  color: #a435f0;
}
.item-type {
  font-size: 12px;
  color: #888;
  background: #f0f0f0;
  padding: 2px 8px;
  border-radius: 4px;
}
.item-price-mobile {
  display: none;
  font-weight: bold;
  margin-top: 5px;
}

.item-price {
  width: 120px;
  text-align: center;
  font-weight: 600;
  color: #333;
}

.quantity-control {
  display: flex;
  align-items: center;
  border: 1px solid #ddd;
  border-radius: 6px;
  overflow: hidden;
}
.quantity-control button {
  width: 36px;
  height: 36px;
  border: none;
  background: #f5f5f5;
  cursor: pointer;
  transition: all 0.2s;
}
.quantity-control button:hover {
  background: #a435f0;
  color: white;
}
.quantity-control button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
.qty-value {
  width: 40px;
  text-align: center;
  font-weight: bold;
}

.item-subtotal {
  width: 120px;
  text-align: center;
  font-weight: bold;
  color: #a435f0;
  font-size: 16px;
}

.remove-btn {
  width: 40px;
  height: 40px;
  border: none;
  background: #fff0f0;
  color: #dc3545;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.2s;
}
.remove-btn:hover {
  background: #dc3545;
  color: white;
}

/* Cart Actions */
.cart-actions {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
  flex-wrap: wrap;
  gap: 15px;
}

.btn-continue {
  padding: 12px 24px;
  background: white;
  color: #333;
  border: 2px solid #ddd;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.2s;
}
.btn-continue:hover {
  border-color: #a435f0;
  color: #a435f0;
}

.btn-clear {
  padding: 12px 24px;
  background: #fff0f0;
  color: #dc3545;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
}
.btn-clear:hover {
  background: #dc3545;
  color: white;
}

/* Order Summary */
.order-summary {
  background: white;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 2px 15px rgba(0,0,0,0.05);
  position: sticky;
  top: 120px;
}
.order-summary h2 {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 2px solid #f0f0f0;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 12px;
  font-size: 15px;
}
.summary-row.total {
  font-size: 18px;
  font-weight: bold;
  margin-top: 15px;
}
.total-price {
  color: #a435f0;
  font-size: 22px;
}

.btn-checkout {
  display: block;
  width: 100%;
  padding: 16px;
  background: linear-gradient(135deg, #a435f0, #8e2de2);
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  margin-top: 20px;
  transition: all 0.3s;
}
.btn-checkout:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 20px rgba(164, 53, 240, 0.4);
}

.payment-methods {
  margin-top: 20px;
  text-align: center;
}
.payment-methods p {
  font-size: 13px;
  color: #888;
  margin-bottom: 10px;
}
.payment-icons {
  display: flex;
  justify-content: center;
  gap: 15px;
}
.payment-icons i {
  font-size: 24px;
  color: #aaa;
}

/* Empty Cart */
.empty-cart {
  text-align: center;
  padding: 80px 20px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}
.empty-cart-icon {
  width: 120px;
  height: 120px;
  margin: 0 auto 30px;
  background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.empty-cart-icon i {
  font-size: 50px;
  color: #aaa;
}
.empty-cart h2 {
  font-size: 24px;
  margin-bottom: 10px;
  color: #333;
}
.empty-cart p {
  color: #666;
  margin-bottom: 30px;
}
.btn-shop-now {
  display: inline-block;
  padding: 14px 30px;
  background: linear-gradient(135deg, #a435f0, #8e2de2);
  color: white;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s;
}
.btn-shop-now:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 20px rgba(164, 53, 240, 0.4);
}

/* Responsive */
@media (max-width: 768px) {
  .cart-item {
    flex-wrap: wrap;
  }
  .item-image {
    width: 80px;
    height: 80px;
  }
  .item-price {
    display: none;
  }
  .item-price-mobile {
    display: block;
  }
  .item-subtotal {
    width: auto;
  }
  .order-summary {
    margin-top: 30px;
  }
}
</style>
