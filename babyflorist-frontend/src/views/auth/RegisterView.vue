<template>
  <div class="auth-page">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="auth-box">
             <h1 class="auth-title">Đăng ký</h1>
             <p class="auth-subtitle">Tạo tài khoản mới để trải nghiệm mua sắm cá nhân hóa.</p>

             <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>

             <form @submit.prevent="handleRegister">
                <div class="form-group">
                   <label for="name">Họ và tên <span class="required">*</span></label>
                   <input type="text" id="name" v-model="name" class="form-control" required placeholder="Nguyễn Văn A">
                </div>

                <div class="form-group">
                   <label for="email">Địa chỉ Email <span class="required">*</span></label>
                   <input type="email" id="email" v-model="email" class="form-control" required placeholder="example@gmail.com">
                </div>

                <div class="form-group">
                   <label for="phone">Số điện thoại <span class="required">*</span></label>
                   <input type="tel" id="phone" v-model="phone" class="form-control" required placeholder="0901234567">
                </div>

                <div class="form-group">
                   <label for="password">Mật khẩu <span class="required">*</span></label>
                   <div class="password-input-wrapper">
                      <input :type="showPassword ? 'text' : 'password'" id="password" v-model="password" class="form-control" required placeholder="********">
                      <span class="toggle-password" @click="showPassword = !showPassword">
                         {{ showPassword ? '🙈' : '👁️' }}
                      </span>
                   </div>
                </div>
                
                <div class="form-group">
                   <label for="confirmPassword">Xác nhận mật khẩu <span class="required">*</span></label>
                   <div class="password-input-wrapper">
                      <input :type="showConfirmPassword ? 'text' : 'password'" id="confirmPassword" v-model="confirmPassword" class="form-control" required placeholder="********">
                      <span class="toggle-password" @click="showConfirmPassword = !showConfirmPassword">
                         {{ showConfirmPassword ? '🙈' : '👁️' }}
                      </span>
                   </div>
                </div>
                
                <div class="privacy-policy">
                   <p>Dữ liệu cá nhân của bạn sẽ được sử dụng để hỗ trợ trải nghiệm trên website, quản lý tài khoản và các mục đích khác theo <a href="#">chính sách bảo mật</a>.</p>
                </div>

                <button type="submit" class="btn btn-register" :disabled="isLoading">
                   {{ isLoading ? 'Đang tạo tài khoản...' : 'ĐĂNG KÝ' }}
                </button>
             </form>

             <div class="auth-footer">
                <p>Đã có tài khoản? <router-link to="/login">Đăng nhập</router-link></p>
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
const name = ref('')
const email = ref('')
const phone = ref('')
const password = ref('')
const confirmPassword = ref('')
const isLoading = ref(false)
const errorMessage = ref('')
const showPassword = ref(false)
const showConfirmPassword = ref(false)

async function handleRegister() {
  if (password.value !== confirmPassword.value) {
    errorMessage.value = 'Mật khẩu xác nhận không khớp!'
    return
  }
  
  isLoading.value = true
  errorMessage.value = ''
  
  try {
    await authStore.register({
      name: name.value,
      email: email.value,
      phone: phone.value,
      password: password.value,
      password_confirmation: confirmPassword.value
    })
    router.push('/')
  } catch (error) {
    const errors = error.response?.data?.errors
    if (errors) {
      errorMessage.value = Object.values(errors).flat().join(' ')
    } else {
      errorMessage.value = error.response?.data?.message || 'Đăng ký thất bại. Vui lòng thử lại.'
    }
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
  font-size: 14px;
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

.error-message {
  background: #ffebee;
  color: #c62828;
  padding: 12px;
  border-radius: 4px;
  margin-bottom: 20px;
  font-size: 14px;
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

.privacy-policy {
   font-size: 13px;
   color: #666;
   margin-bottom: 20px;
   line-height: 1.5;
}

.btn-register {
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

.btn-register:hover {
  background: #e18787;
}

.btn-register:disabled {
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
