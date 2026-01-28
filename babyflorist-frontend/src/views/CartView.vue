<template>
  <div class="cart-page">
    <div class="container">
      <ul class="breadcrumb">
        <li><router-link to="/">Home</router-link></li>
        <li>Your Shopping Cart</li>
      </ul>
      <h1 class="page-title">Shopping Cart</h1>

      <div class="row" v-if="cartStore.items.length > 0">
        <!-- Cart Items Table -->
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="cart-table-container">
            <table class="table cart-table">
              <thead>
                <tr>
                  <th class="product-remove"></th>
                  <th class="product-thumbnail">Image</th>
                  <th class="product-name">Product</th>
                  <th class="product-price">Price</th>
                  <th class="product-quantity">Quantity</th>
                  <th class="product-subtotal">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in cartStore.items" :key="item.id">
                  <td class="product-remove">
                    <a href="#" @click.prevent="removeItem(item.id)" class="remove-btn">×</a>
                  </td>
                  <td class="product-thumbnail">
                    <router-link :to="`/products/${item.slug || item.id}`">
                      <img :src="item.image" :alt="item.name" class="img-responsive">
                    </router-link>
                  </td>
                  <td class="product-name">
                    <router-link :to="`/products/${item.slug || item.id}`">{{ item.name }}</router-link>
                  </td>
                  <td class="product-price">
                    <span class="amount">${{ item.price }}</span>
                  </td>
                  <td class="product-quantity">
                    <div class="quantity-control">
                      <button @click="updateQuantity(item.id, item.quantity - 1)">-</button>
                      <input type="text" :value="item.quantity" readonly>
                      <button @click="updateQuantity(item.id, item.quantity + 1)">+</button>
                    </div>
                  </td>
                  <td class="product-subtotal">
                    <span class="amount">${{ (item.price * item.quantity).toFixed(2) }}</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="cart-actions">
             <div class="coupon-section">
                <input type="text" placeholder="Coupon code" class="input-text">
                <button class="btn btn-apply">Apply Coupon</button>
             </div>
             <button class="btn btn-update" @click="handleUpdateCart">Update Cart</button>
          </div>
        </div>

        <!-- Cart Totals -->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="cart-collaterals">
            <div class="cart-totals">
              <h2>Cart Totals</h2>
              <table class="shop_table">
                <tbody>
                  <tr class="cart-subtotal">
                    <th>Subtotal</th>
                    <td><span class="amount">${{ cartStore.totalPrice.toFixed(2) }}</span></td>
                  </tr>
                  <tr class="shipping">
                    <th>Shipping</th>
                    <td>
                      <ul class="shipping-methods">
                         <li>
                            <input type="radio" name="shipping" id="free_shipping" checked>
                            <label for="free_shipping">Free Shipping</label>
                         </li>
                         <li>
                            <input type="radio" name="shipping" id="flat_rate">
                            <label for="flat_rate">Flat Rate: $10.00</label>
                         </li>
                      </ul>
                      <p class="shipping-calculator-button">Calculate Shipping</p>
                    </td>
                  </tr>
                  <tr class="order-total">
                    <th>Total</th>
                    <td><strong><span class="amount">${{ cartStore.totalPrice.toFixed(2) }}</span></strong></td>
                  </tr>
                </tbody>
              </table>
              <div class="proceed-to-checkout">
                <router-link to="/checkout" class="btn btn-checkout">Proceed to Checkout</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty Cart Message -->
      <div v-else class="empty-cart-message">
        <i class="fas fa-shopping-basket"></i>
        <h3>Your cart is currently empty.</h3>
        <p>Return to our shop to add some beautiful items!</p>
        <router-link to="/products" class="btn btn-primary">Return to Shop</router-link>
      </div>

    </div>
  </div>
</template>

<script setup>
import { useCartStore } from '@/stores/cart'

const cartStore = useCartStore()

function updateQuantity(id, newQty) {
  if (newQty < 1) return
  cartStore.updateQuantity(id, newQty)
}

function removeItem(id) {
  if(confirm('Are you sure you want to remove this item?')) {
     cartStore.removeItem(id)
  }
}

function handleUpdateCart() {
   alert('Cart updated!')
}
</script>

<style scoped>
.cart-page {
  padding-top: 150px;
  padding-bottom: 80px;
}

.page-title {
  font-family: 'Abril Fatface';
  font-size: 36px;
  margin-bottom: 40px;
  text-align: center;
}

/* Table Styles */
.cart-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 30px;
}

.cart-table th {
  font-family: 'Abril Fatface';
  font-size: 16px;
  padding: 15px;
  border-bottom: 1px solid #ddd;
  text-align: left;
}

.cart-table td {
  padding: 20px 10px;
  border-bottom: 1px solid #eee;
  vertical-align: middle;
}

.product-thumbnail img {
  width: 80px;
  height: auto;
}

.product-name a {
  color: black;
  font-weight: bold;
  font-size: 16px;
  text-decoration: none;
}

.product-name a:hover {
  color: #e18787;
}

.remove-btn {
  color: #ff0000;
  font-weight: bold;
  font-size: 20px;
  text-decoration: none;
}

.amount {
  font-weight: bold;
  color: #333;
}

/* Quantity Control */
.quantity-control {
  border: 1px solid #ddd;
  display: inline-flex;
}

.quantity-control button {
  width: 30px;
  border: none;
  background: white;
  cursor: pointer;
}

.quantity-control input {
  width: 40px;
  border: none;
  text-align: center;
  font-weight: bold;
  outline: none;
}

/* Actions */
.cart-actions {
  display: flex;
  justify-content: space-between;
  margin-bottom: 40px;
  flex-wrap: wrap;
  gap: 15px;
}

.coupon-section { display: flex; gap: 10px; }
.input-text { padding: 10px; border: 1px solid #ddd; width: 200px; }
.btn {
  padding: 10px 20px;
  background: black;
  color: white;
  border: none;
  font-weight: bold;
  text-transform: uppercase;
  cursor: pointer;
  transition: all 0.3s;
}
.btn:hover { background: #e18787; }

/* Totals Sidebar */
.cart-totals {
  background: #f9f9f9;
  padding: 30px;
  border: 1px solid #eee;
}

.cart-totals h2 {
  font-family: 'Abril Fatface';
  margin-top: 0;
  border-bottom: 1px solid #ddd;
  padding-bottom: 15px;
  margin-bottom: 20px;
}

.shop_table { width: 100%; }
.shop_table th { text-align: left; padding: 15px 0; font-weight: bold; }
.shop_table td { text-align: right; padding: 15px 0; }
.shop_table tr { border-bottom: 1px solid #eee; }
.shop_table tr:last-child { border-bottom: none; }

.shipping-methods {
  list-style: none;
  padding: 0;
  text-align: right;
}

.btn-checkout {
  width: 100%;
  display: block;
  text-align: center;
  background: #e18787;
  color: white;
  margin-top: 20px;
  text-decoration: none;
}

.btn-checkout:hover {
  background: black;
  color: white;
}

/* Empty Cart */
.empty-cart-message {
  text-align: center;
  padding: 50px;
}
.empty-cart-message i { font-size: 60px; color: #ddd; margin-bottom: 20px; }
.empty-cart-message h3 { font-family: 'Abril Fatface'; }
.empty-cart-message .btn { margin-top: 20px; display: inline-block; text-decoration: none; }

@media (max-width: 768px) {
  .product-thumbnail, .product-price { display: none; }
  .cart-actions { flex-direction: column; }
  .coupon-section { width: 100%; }
  .input-text { width: 100%; }
}
</style>
