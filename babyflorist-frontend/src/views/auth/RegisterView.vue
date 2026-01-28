<template>
  <div class="auth-page">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="auth-box">
             <h1 class="auth-title">Register</h1>
             <p class="auth-subtitle">Create new account today to reap the benefits of a personalized shopping experience.</p>

             <form @submit.prevent="handleRegister">
                <div class="form-group">
                   <label for="name">Full Name <span class="required">*</span></label>
                   <input type="text" id="name" v-model="name" class="form-control" required placeholder="John Doe">
                </div>

                <div class="form-group">
                   <label for="email">Email Address <span class="required">*</span></label>
                   <input type="email" id="email" v-model="email" class="form-control" required placeholder="example@gmail.com">
                </div>

                <div class="form-group">
                   <label for="password">Password <span class="required">*</span></label>
                   <input type="password" id="password" v-model="password" class="form-control" required placeholder="********">
                </div>
                
                <div class="form-group">
                   <label for="confirmPassword">Confirm Password <span class="required">*</span></label>
                   <input type="password" id="confirmPassword" v-model="confirmPassword" class="form-control" required placeholder="********">
                </div>
                
                <div class="privacy-policy">
                   <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="#">privacy policy</a>.</p>
                </div>

                <button type="submit" class="btn btn-register" :disabled="isLoading">
                   {{ isLoading ? 'Creating Account...' : 'REGISTER' }}
                </button>
             </form>

             <div class="auth-footer">
                <p>Already have an account? <router-link to="/login">Login here</router-link></p>
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
const name = ref('')
const email = ref('')
const password = ref('')
const confirmPassword = ref('')
const isLoading = ref(false)

function handleRegister() {
  if (password.value !== confirmPassword.value) {
     alert('Passwords do not match!')
     return
  }
  
  isLoading.value = true
  
  // Mock register api call
  setTimeout(() => {
     console.log('Register with:', name.value, email.value)
     alert('Account Created Successfully!')
     isLoading.value = false
     router.push('/login')
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
