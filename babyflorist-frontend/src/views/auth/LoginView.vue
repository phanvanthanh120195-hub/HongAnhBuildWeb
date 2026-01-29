<template>
  <div class="auth-page">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="auth-box">
             <h1 class="auth-title">Đăng nhập</h1>
             <p class="auth-subtitle">Chào mừng quay lại! Vui lòng đăng nhập vào tài khoản của bạn.</p>

             <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>

             <form @submit.prevent="handleLogin">
                <div class="form-group">
                   <label for="identifier">Email hoặc Số điện thoại <span class="required">*</span></label>
                   <input type="text" id="identifier" v-model="identifier" class="form-control" required placeholder="example@gmail.com hoặc 0901234567">
                </div>

                <div class="form-group">
                   <label for="password">Password <span class="required">*</span></label>
                   <div class="password-input-wrapper">
                      <input :type="showPassword ? 'text' : 'password'" id="password" v-model="password" class="form-control" required placeholder="********">
                      <span class="toggle-password" @click="showPassword = !showPassword">
                         {{ showPassword ? '🙈' : '👁️' }}
                      </span>
                   </div>
                </div>

                <div class="form-actions">
                   <div class="checkbox">
                      <label>
                         <input type="checkbox" v-model="rememberMe"> Remember me
                      </label>
                   </div>
                   <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-login" :disabled="isLoading">
                   {{ isLoading ? 'Loading...' : 'LOGIN' }}
                </button>
             </form>

             <div class="auth-footer">
                <p>Chưa có tài khoản? <router-link to="/register">Đăng ký ngay</router-link></p>
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const authStore = useAuthStore()
const identifier = ref('')
const password = ref('')
const rememberMe = ref(false)
const isLoading = ref(false)
const errorMessage = ref('')
const showPassword = ref(false)

async function handleLogin() {
  isLoading.value = true
  errorMessage.value = ''
  
  try {
    await authStore.login({
      identifier: identifier.value,
      password: password.value
    })
    router.push('/')
  } catch (error) {
    errorMessage.value = error.response?.data?.message || 'Đăng nhập thất bại. Vui lòng thử lại.'
  } finally {
    isLoading.value = false
  }
}
</script>

<style scoped>
.auth-page {
  padding: 150px 0 100px;
  background-color: #f9f9f9;
}

.auth-box {
  background: white;
  padding: 40px;
  border-radius: 8px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.auth-title {
  font-family: 'Abril Fatface';
  text-align: center;
  font-size: 36px;
  margin-bottom: 10px;
}

.auth-subtitle {
  text-align: center;
  color: #666;
  margin-bottom: 30px;
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

.required {
  color: red;
}

.form-control {
  width: 100%;
  height: 45px;
  padding: 10px 15px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
}

.form-control:focus {
  border-color: black;
  outline: none;
}

.password-input-wrapper {
  position: relative;
}

.toggle-password {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  user-select: none;
  font-size: 16px;
}

.error-message {
  background: #ffebee;
  color: #c62828;
  padding: 12px;
  border-radius: 4px;
  margin-bottom: 20px;
  font-size: 14px;
}

.form-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
  font-size: 14px;
}

.forgot-password {
  color: #e18787;
  text-decoration: none;
}

.btn-login {
  width: 100%;
  height: 50px;
  background: black;
  color: white;
  border: none;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  cursor: pointer;
  transition: background 0.3s;
}

.btn-login:hover {
  background: #e18787;
}

.btn-login:disabled {
  background: #ccc;
  cursor: not-allowed;
}

.auth-footer {
  text-align: center;
  margin-top: 25px;
  font-size: 14px;
}

.auth-footer a {
  color: black;
  font-weight: bold;
  text-decoration: none;
}
.auth-footer a:hover {
  text-decoration: underline;
}
</style>
