<template>
  <div v-if="isOpen" class="auth-overlay" @click.self="close">
    <div class="auth-modal">
      <button class="close-btn" @click="close"><i class="far fa-times-circle"></i></button>

      <!-- HEADER LOGO -->
      <div class="auth-header">
        <img src="https://landing.engotheme.com/html/jenstore/demo/img/logo.png" alt="BabyFlorist" class="auth-logo">
      </div>

      <!-- LOGIN FORM -->
      <div v-if="mode === 'login'" class="auth-body">
        <h3 class="auth-title">Chào mừng đến với BabyFlorist</h3>
        <p class="auth-subtitle">Vui lòng điền thông tin đăng nhập</p>

        <form @submit.prevent="handleLogin">
          <div class="form-group">
            <label>Số điện thoại / Email</label>
            <input type="text" v-model="loginForm.identifier" class="form-control"
              placeholder="Nhập số điện thoại hoặc email" required>
          </div>

          <div class="form-group">
            <label>Mật khẩu</label>
            <div class="password-input-wrapper">
              <input :type="showLoginPassword ? 'text' : 'password'" v-model="loginForm.password" class="form-control"
                placeholder="********" required>
              <span class="toggle-password" @click="showLoginPassword = !showLoginPassword">
                {{ showLoginPassword ? '🙈' : '👁️' }}
              </span>
            </div>
          </div>

          <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>

          <div class="form-options">
            <label class="checkbox-container">
              <input type="checkbox" v-model="loginForm.rememberMe"> Ghi nhớ đăng nhập
            </label>
            <!-- Forgot password removed as requested -->
          </div>

          <button type="submit" class="btn-submit" :disabled="isLoading">
            {{ isLoading ? 'Đang xử lý...' : 'Đăng nhập' }}
          </button>
        </form>

        <div class="auth-footer">
          <p>Bạn chưa có tài khoản? <a href="#" @click.prevent="switchMode('register')">Đăng ký ngay</a></p>
        </div>
      </div>

      <!-- REGISTER FORM -->
      <div v-else class="auth-body">
        <h3 class="auth-title">Tạo tài khoản mới</h3>
        <p class="auth-subtitle">Vui lòng nhập thông tin đăng ký</p>

        <form @submit.prevent="handleRegister">
          <div class="form-group">
            <label>Họ và tên</label>
            <input type="text" v-model="registerForm.name" class="form-control" placeholder="Nhập họ tên" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" v-model="registerForm.email" class="form-control" placeholder="Nhập email" required>
          </div>
          <div class="form-group">
            <label>Số điện thoại</label>
            <input type="tel" v-model="registerForm.phone" class="form-control" placeholder="Nhập số điện thoại"
              required>
          </div>

          <div class="form-group">
            <label>Mật khẩu</label>
            <div class="password-input-wrapper">
              <input :type="showRegisterPassword ? 'text' : 'password'" v-model="registerForm.password"
                class="form-control" placeholder="********" required>
              <span class="toggle-password" @click="showRegisterPassword = !showRegisterPassword">
                {{ showRegisterPassword ? '🙈' : '👁️' }}
              </span>
            </div>
          </div>

          <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>

          <button type="submit" class="btn-submit" :disabled="isLoading">
            {{ isLoading ? 'Đang xử lý...' : 'Đăng ký' }}
          </button>
        </form>

        <div class="auth-footer">
          <p>Bạn đã có tài khoản? <a href="#" @click.prevent="switchMode('login')">Đăng nhập ngay</a></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, watch } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'

const props = defineProps({
  isOpen: Boolean,
  initialMode: {
    type: String,
    default: 'login' // 'login' or 'register'
  }
})

const emit = defineEmits(['close'])

const authStore = useAuthStore()
const router = useRouter() // Though we might just reload or change state
const mode = ref(props.initialMode)
const isLoading = ref(false)
const errorMessage = ref('')
const showLoginPassword = ref(false)
const showRegisterPassword = ref(false)
const showConfirmPassword = ref(false)

const loginForm = reactive({
  identifier: '',
  password: '',
  rememberMe: true
})

const registerForm = reactive({
  name: '',
  email: '',
  phone: '',
  password: ''
})

watch(() => props.initialMode, (newMode) => {
  mode.value = newMode
})

watch(() => props.isOpen, () => {
  // Reset forms on open
  errorMessage.value = ''
  loginForm.password = ''
})

function close() {
  emit('close')
}

function switchMode(newMode) {
  mode.value = newMode
  errorMessage.value = ''
}

async function handleLogin() {
  isLoading.value = true
  errorMessage.value = ''
  try {
    await authStore.login({
      identifier: loginForm.identifier,
      password: loginForm.password
    })
    // Success
    close()
    // Ideally user state updates automatically via store
  } catch (error) {
    errorMessage.value = error.response?.data?.message || 'Đăng nhập thất bại.'
  } finally {
    isLoading.value = false
  }
}

async function handleRegister() {
  isLoading.value = true
  errorMessage.value = ''
  try {
    await authStore.register({
      name: registerForm.name,
      email: registerForm.email,
      phone: registerForm.phone,
      password: registerForm.password,
      password_confirmation: registerForm.password
    })
    close()
    // Maybe show success toast or auto login?
    // AuthStore usually sets user on register if backend returns token
  } catch (error) {
    const errors = error.response?.data?.errors
    if (errors) {
      errorMessage.value = Object.values(errors).flat().join(' ')
    } else {
      errorMessage.value = error.response?.data?.message || 'Đăng ký thất bại.'
    }
  } finally {
    isLoading.value = false
  }
}
</script>

<style scoped>
.auth-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.auth-modal {
  background: white;
  padding: 30px;
  border-radius: 12px;
  width: 520px;
  max-width: 90%;
  position: relative;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  animation: slideDown 0.3s ease;
}

@keyframes slideDown {
  from {
    transform: translateY(-20px);
    opacity: 0;
  }

  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.close-btn {
  position: absolute;
  top: 15px;
  right: 15px;
  border: none;
  background: none;
  font-size: 20px;
  color: #999;
  cursor: pointer;
}

.auth-header {
  text-align: center;
  margin-bottom: 20px;
}

.auth-logo {
  height: 70px;
  object-fit: contain;
}

.auth-title {
  text-align: center;
  font-size: 25px;
  font-weight: bold;
  margin-bottom: 5px;
  color: #333;
}

.auth-subtitle {
  text-align: center;
  color: #666;
  font-size: 16px;
  margin-bottom: 25px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  font-size: 15px;
  margin-bottom: 5px;
  color: #444;
  font-weight: 600;
}

.form-control {
  width: 100%;
  padding: 10px 15px;
  border: 1px solid #eee;
  background: #f8f9fa;
  border-radius: 6px;
  font-size: 14px;
  height: 42px;
}

.form-control:focus {
  border-color: #ff4d4d;
  background: white;
  outline: none;
}

.password-input-wrapper {
  position: relative;
}

.toggle-password {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 16px;
  color: #888;
}

.form-options {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  font-size: 13px;
}

.checkbox-container {
  display: flex;
  align-items: center;
  cursor: pointer;
}

.checkbox-container input {
  margin-right: 8px;
  margin-top: 0;
}

.btn-submit {
  width: 100%;
  padding: 12px;
  background: #ff4d4d;
  /* Red/Orange brand color from image */
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 17px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s;
}

.btn-submit:hover {
  background: #e60000;
}

.btn-submit:disabled {
  background: #ffcccc;
  cursor: not-allowed;
}

.auth-footer {
  text-align: center;
  margin-top: 20px;
  font-size: 16px;
}

.auth-footer a {
  color: #ff4d4d;
  font-weight: 600;
  text-decoration: none;
}

.error-message {
  background: #ffebee;
  color: #c62828;
  padding: 10px;
  border-radius: 4px;
  margin-bottom: 15px;
  font-size: 13px;
}

.row {
  margin-left: -10px;
  margin-right: -10px;
}

.col-xs-6 {
  padding-left: 10px;
  padding-right: 10px;
  width: 50%;
  float: left;
}
</style>
