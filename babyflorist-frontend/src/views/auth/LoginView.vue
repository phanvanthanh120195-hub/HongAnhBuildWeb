<template>
  <div class="auth-page">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="auth-box">
             <h1 class="auth-title">Login</h1>
             <p class="auth-subtitle">Welcome back! Please login to your account.</p>

             <form @submit.prevent="handleLogin">
                <div class="form-group">
                   <label for="email">Email Address <span class="required">*</span></label>
                   <input type="email" id="email" v-model="email" class="form-control" required placeholder="example@gmail.com">
                </div>

                <div class="form-group">
                   <label for="password">Password <span class="required">*</span></label>
                   <input type="password" id="password" v-model="password" class="form-control" required placeholder="********">
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
                <p>Don't have an account? <router-link to="/register">Register now</router-link></p>
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

const router = useRouter()
const email = ref('')
const password = ref('')
const rememberMe = ref(false)
const isLoading = ref(false)

function handleLogin() {
  isLoading.value = true
  
  // Mock login api call
  setTimeout(() => {
     console.log('Login with:', email.value, password.value)
     alert('Login Successful!')
     isLoading.value = false
     router.push('/')
  }, 1000)
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
