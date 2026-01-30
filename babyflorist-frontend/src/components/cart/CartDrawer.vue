<template>
  <div>
    <!-- Overlay -->
    <div v-if="isOpen" class="cart-overlay" @click="$emit('close')"></div>
    
    <!-- Drawer -->
    <div class="cart-drawer" :class="{ 'open': isOpen }">
      <div class="cart-header">
        <h3>YOUR CART <span class="cart-count-badge">{{ cartStore.totalItems }}</span></h3>
        <button class="close-btn" @click="$emit('close')">&times;</button>
      </div>
      
      <div class="cart-items" v-if="cartStore.items.length > 0">
        <div v-for="(item, index) in cartStore.items" :key="index" class="cart-item">
            <div class="item-image">
                <img :src="item.image" :alt="item.name">
            </div>
            <div class="item-details">
                <div class="item-name-row">
                    <h4>{{ item.name }}</h4>
                    <button class="remove-btn" @click="cartStore.removeItem(index)">&times;</button>
                </div>
                <div class="item-meta">
                    <span class="qty">{{ item.quantity }} &times;</span>
                    <span class="price">{{ formatCurrency(item.price) }}</span>
                </div>
            </div>
        </div>
      </div>
      
      <div v-else class="empty-cart">
        <p>Giỏ hàng của bạn đang trống</p>
        <button class="btn-shop" @click="goToShop">Mua sắm ngay</button>
      </div>
      
      <div class="cart-footer" v-if="cartStore.items.length > 0">
        <div class="subtotal">
            <span>Subtotal:</span>
            <span class="amount">{{ formatCurrency(cartStore.subtotal) }}</span>
        </div>
        
        <div class="actions">
            <button class="btn-view-cart" @click="viewCart">View Cart</button>
            <button class="btn-checkout" @click="checkout">Checkout</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useCartStore } from '@/stores/cart'
import { useAuthStore } from '@/stores/auth'
import { useAuthModalStore } from '@/stores/authModal'
import { useRouter } from 'vue-router'
import { useToast } from 'vue-toastification'

const props = defineProps({
  isOpen: Boolean
})

const emit = defineEmits(['close'])

const cartStore = useCartStore()
const authStore = useAuthStore()
const authModalStore = useAuthModalStore()
const router = useRouter()
const toast = useToast()

function formatCurrency(value) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
}

function viewCart() {
    emit('close')
    router.push('/cart')
}

function checkout() {
    emit('close')
    if (!authStore.token) {
        toast.warning('Vui lòng đăng nhập để thanh toán')
        authModalStore.openLogin('/checkout')
        return
    }
    router.push('/checkout')
}

function goToShop() {
    emit('close')
    router.push('/products')
}
</script>

<style scoped>
.cart-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 9998;
}

.cart-drawer {
    position: fixed;
    top: 0;
    right: -350px;
    width: 350px;
    height: 100vh;
    background: white;
    z-index: 9999;
    transition: right 0.3s ease;
    display: flex;
    flex-direction: column;
    box-shadow: -5px 0 15px rgba(0,0,0,0.1);
}

.cart-drawer.open {
    right: 0;
}

.cart-header {
    padding: 20px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
}

.cart-count-badge {
    background: #ff4d4d;
    color: white;
    font-size: 12px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 10px;
}

.close-btn {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    padding: 0;
    line-height: 1;
}

.cart-items {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
}

.cart-item {
    display: flex;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #f5f5f5;
}

.item-image {
    width: 70px;
    height: 70px;
    margin-right: 15px;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-details {
    flex: 1;
}

.item-name-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.item-name-row h4 {
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    width: 85%;
    line-height: 1.4;
}

.remove-btn {
    background: none;
    border: none;
    font-size: 18px;
    color: #999;
    cursor: pointer;
    padding: 0;
    line-height: 1;
}

.item-meta {
    font-size: 14px;
    color: #666;
}

.empty-cart {
    padding: 40px 20px;
    text-align: center;
    color: #888;
}

.btn-shop {
    margin-top: 15px;
    background: black;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

.cart-footer {
    padding: 20px;
    border-top: 1px solid #eee;
    background: #fff;
}

.subtotal {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 16px;
}

.actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn-view-cart, .btn-checkout {
    width: 100%;
    padding: 12px;
    text-transform: uppercase;
    font-weight: 600;
    font-size: 14px;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-view-cart {
    background: white;
    border: 1px solid #ddd;
    color: #333;
}

.btn-view-cart:hover {
    border-color: #333;
}

.btn-checkout {
    background: #8b5cf6; /* Purple color matching screenshot approximately */
    border: none;
    color: white;
}

.btn-checkout:hover {
    background: #7c3aed;
}
</style>
