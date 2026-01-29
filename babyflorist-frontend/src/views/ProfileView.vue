<template>
  <div class="user-profile-page">
    <div class="container">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-sm-4">
          <div class="profile-sidebar">
            <div class="user-info-summary">
              <!-- Avatar -->
              <div class="avatar-container">
                  <div class="avatar-frame" @click="triggerAvatarUpload">
                     <img v-if="localAvatar || authStore.user?.avatar" :src="localAvatar || authStore.user.avatar" alt="User Avatar" class="img-responsive">
                     <div v-else class="avatar-placeholder">
                        {{ getInitials(authStore.user?.name) }}
                     </div>
                     <div class="avatar-overlay">
                        <i class="fas fa-camera"></i>
                     </div>
                  </div>
                  <input type="file" ref="fileInput" @change="handleAvatarUpload" accept="image/*" style="display: none;">
              </div>
              
              <h4 class="user-name">{{ authStore.user?.name || 'Khách hàng' }}</h4>
              <p class="user-email">{{ authStore.user?.email }}</p>
            </div>

            <div class="profile-menu">
              <ul>
                <li :class="{ active: activeTab === 'info' }" @click="activeTab = 'info'">
                  <i class="far fa-user"></i> Thông tin cá nhân
                </li>
                <li :class="{ active: activeTab === 'password' }" @click="activeTab = 'password'">
                  <i class="fas fa-lock"></i> Đổi mật khẩu
                </li>
                <li :class="{ active: activeTab === 'orders' }" @click="activeTab = 'orders'">
                  <i class="fas fa-history"></i> Lịch sử đơn hàng
                </li>
                <li class="logout-item" @click="handleLogout">
                  <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Content -->
        <div class="col-md-9 col-sm-8">
          <div class="profile-content">
            
            <!-- Tab: Personal Info -->
            <div v-if="activeTab === 'info'" class="tab-content">
              <h3 class="tab-title">Thông tin cá nhân</h3>
              <form @submit.prevent="updateProfile">
                <div class="row">
                   <div class="col-md-6 form-group">
                      <label>Họ và tên</label>
                      <input type="text" v-model="profileForm.name" class="form-control">
                   </div>
                   <div class="col-md-6 form-group">
                      <label>Số điện thoại</label>
                      <input type="text" v-model="profileForm.phone" class="form-control">
                   </div>
                </div>
                <div class="form-group">
                   <label>Email</label>
                   <input type="email" v-model="profileForm.email" class="form-control" disabled style="background-color: #f9f9f9;">
                </div>
                
                <!-- Address Section -->
                <div class="address-section">
                    <h4 class="section-subtitle">Địa chỉ nhận hàng</h4>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Tỉnh/Thành phố</label>
                            <SearchableSelect 
                                v-model="profileForm.province" 
                                :options="locationData.provinces" 
                                placeholder="Chọn Tỉnh/Thành"
                                @change="handleProvinceChange"
                            />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Quận/Huyện</label>
                            <SearchableSelect 
                                v-model="profileForm.district" 
                                :options="locationData.districts" 
                                placeholder="Chọn Quận/Huyện"
                                :disabled="!profileForm.province"
                                @change="handleDistrictChange"
                            />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Phường/Xã</label>
                            <SearchableSelect 
                                v-model="profileForm.ward" 
                                :options="locationData.wards" 
                                placeholder="Chọn Phường/Xã"
                                :disabled="!profileForm.district"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ cụ thể</label>
                        <textarea v-model="profileForm.address" class="form-control" rows="4" placeholder="Số nhà, tên đường..."></textarea>
                    </div>
                </div>

                <button type="submit" class="btn-save">Lưu thay đổi</button>
              </form>
            </div>

            <!-- Tab: Change Password -->
            <div v-if="activeTab === 'password'" class="tab-content">
              <h3 class="tab-title">Đổi mật khẩu</h3>
              <form @submit.prevent="changePassword">
                <!-- Current Password removed as requested -->
                
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <div class="password-wrapper">
                        <input :type="showNewPassword ? 'text' : 'password'" v-model="passwordForm.new" class="form-control" required>
                        <span class="toggle-icon" @click="showNewPassword = !showNewPassword">
                             <i :class="showNewPassword ? 'far fa-eye-slash' : 'far fa-eye'"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Xác nhận mật khẩu mới</label>
                     <div class="password-wrapper">
                        <input :type="showConfirmPassword ? 'text' : 'password'" v-model="passwordForm.confirm" class="form-control" required>
                        <span class="toggle-icon" @click="showConfirmPassword = !showConfirmPassword">
                             <i :class="showConfirmPassword ? 'far fa-eye-slash' : 'far fa-eye'"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn-save">Đổi mật khẩu</button>
              </form>
            </div>
            
            <!-- Tab: Order History -->
            <div v-if="activeTab === 'orders'" class="tab-content">
              <h3 class="tab-title">Lịch sử đơn hàng</h3>
              <div v-if="orders.length > 0" class="table-responsive">
                 <table class="table">
                    <thead>
                       <tr>
                          <th>Mã đơn</th>
                          <th>Ngày đặt</th>
                          <th>Tổng tiền</th>
                          <th>Trạng thái</th>
                          <th>Thao tác</th>
                       </tr>
                    </thead>
                    <tbody>
                       <tr v-for="order in orders" :key="order.id">
                          <td>#{{ order.id }}</td>
                          <td>{{ order.date }}</td>
                          <td>{{ formatCurrency(order.total) }}</td>
                          <td><span class="badge" :class="getStatusClass(order.status)">{{ order.status }}</span></td>
                          <td><button class="btn-view">Xem</button></td>
                       </tr>
                    </tbody>
                 </table>
              </div>
              <div v-else class="empty-state">
                 <p>Bạn chưa có đơn hàng nào.</p>
                 <router-link to="/products" class="btn-action">Mua sắm ngay</router-link>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, watch, onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import axios from 'axios'
import SearchableSelect from '@/components/common/SearchableSelect.vue'
import { useToast } from 'vue-toastification'

const authStore = useAuthStore()
const router = useRouter()
const toast = useToast()
const activeTab = ref('info')
const fileInput = ref(null)
const localAvatar = ref(null)
const avatarFile = ref(null)

const showNewPassword = ref(false)
const showConfirmPassword = ref(false)

const profileForm = reactive({
    name: '',
    phone: '',
    email: '',
    province: '',
    district: '',
    ward: '',
    address: ''
})

const locationData = reactive({
    provinces: [],
    districts: [],
    wards: []
})

const passwordForm = reactive({
    new: '',
    confirm: ''
})

// Dummy orders
const orders = ref([
    { id: '1001', date: '29/01/2026', total: 500000, status: 'Completed' },
    { id: '1002', date: '28/01/2026', total: 1200000, status: 'Processing' },
])

onMounted(async () => {
    // Fetch Provinces
    try {
        const response = await axios.get('https://esgoo.net/api-tinhthanh/1/0.htm')
        if (response.data.error === 0) {
            locationData.provinces = response.data.data
        }
    } catch (error) {
        console.error('Error fetching provinces:', error)
    }
})

watch(() => authStore.user, async (newUser) => {
    if (newUser) {
        profileForm.name = newUser.name || ''
        profileForm.phone = newUser.phone || ''
        profileForm.email = newUser.email || ''
        profileForm.province = newUser.province || ''
        profileForm.district = newUser.district || ''
        profileForm.ward = newUser.ward || ''
        profileForm.address = newUser.address || ''
        
        // Init avatar
        if (newUser.avatar) {
            // Assuming backend is at http://localhost:8000
            localAvatar.value = `http://localhost:8000/storage/${newUser.avatar}`
        } else {
            localAvatar.value = null
        }
        
        // Cascade load options if data exists
        if (profileForm.province) {
            await handleProvinceChange(false) // Load districts, don't clear
            if (profileForm.district) {
                await handleDistrictChange(false) // Load wards, don't clear
            }
        }
    }
}, { immediate: true })

async function handleProvinceChange(reset = true) {
    if (reset) {
        profileForm.district = ''
        profileForm.ward = ''
        locationData.districts = []
        locationData.wards = []
    }
    
    if (profileForm.province) {
        try {
            const response = await axios.get(`https://esgoo.net/api-tinhthanh/2/${profileForm.province}.htm`)
            if (response.data.error === 0) {
                locationData.districts = response.data.data
            }
        } catch (error) {
            console.error('Error fetching districts:', error)
        }
    }
}

async function handleDistrictChange(reset = true) {
    if (reset) {
        profileForm.ward = ''
        locationData.wards = []
    }
    
    if (profileForm.district) {
        try {
            const response = await axios.get(`https://esgoo.net/api-tinhthanh/3/${profileForm.district}.htm`)
            if (response.data.error === 0) {
                locationData.wards = response.data.data
            }
        } catch (error) {
            console.error('Error fetching wards:', error)
        }
    }
}

function getInitials(name) {
    if (!name) return 'U'
    return name.charAt(0).toUpperCase()
}

function handleLogout() {
    authStore.logout()
    router.push('/')
}

function triggerAvatarUpload() {
    fileInput.value.click()
}

function handleAvatarUpload(event) {
    const file = event.target.files[0]
    if (file) {
        avatarFile.value = file // Store file for upload
        
        // Create preview
        const reader = new FileReader()
        reader.onload = (e) => {
            localAvatar.value = e.target.result
        }
        reader.readAsDataURL(file)
    }
}

async function updateProfile() {
    try {
        let payload = profileForm
        
        // If avatar is selected, use FormData
        if (avatarFile.value) {
            const formData = new FormData()
            formData.append('avatar', avatarFile.value)
            formData.append('name', profileForm.name)
            formData.append('phone', profileForm.phone)
            formData.append('email', profileForm.email) 
            // Note: Email usually shouldn't be updated here if it's identity, but backend validates it.
            // Backend updateProfile uses 'name', 'phone', 'province', etc.
            if(profileForm.province) formData.append('province', profileForm.province)
            if(profileForm.district) formData.append('district', profileForm.district)
            if(profileForm.ward) formData.append('ward', profileForm.ward)
            if(profileForm.address) formData.append('address', profileForm.address)
            
            payload = formData
        }

        await authStore.updateProfile(payload)
        toast.success('Cập nhật thông tin thành công!')
    } catch (error) {
        console.error(error)
        toast.error(error.response?.data?.message || 'Có lỗi xảy ra khi cập nhật thông tin.')
    }
}

async function changePassword() {
    if (passwordForm.new !== passwordForm.confirm) {
        toast.error('Mật khẩu xác nhận không khớp!')
        return
    }
    
    try {
        await authStore.changePassword({
            password: passwordForm.new,
            password_confirmation: passwordForm.confirm
        })
        toast.success('Đổi mật khẩu thành công!')
        passwordForm.new = ''
        passwordForm.confirm = ''
    } catch (error) {
        console.error(error)
        toast.error(error.response?.data?.message || 'Có lỗi xảy ra khi đổi mật khẩu.')
    }
}

function formatCurrency(value) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
}

function getStatusClass(status) {
    if (status === 'Completed') return 'badge-success'
    if (status === 'Processing') return 'badge-warning'
    return 'badge-secondary'
}
</script>

<style scoped>
.user-profile-page {
    margin-top: 168px;
    padding: 50px 0;
    background-color: #f5f5f5;
    min-height: 80vh;
}

.profile-sidebar {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    overflow: hidden;
    margin-bottom: 20px;
}

.user-info-summary {
    padding: 30px 20px;
    text-align: center;
    border-bottom: 1px solid #eee;
    background: #fff;
}

.avatar-container {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 15px;
}

.avatar-frame {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    overflow: hidden;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    position: relative;
}

.avatar-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    font-size: 36px;
    font-weight: bold;
    color: #888;
}

.avatar-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 24px;
    opacity: 0;
    transition: opacity 0.3s;
}

.avatar-frame:hover .avatar-overlay {
    opacity: 1;
}

.user-name {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

.user-email {
    color: #777;
    font-size: 13px;
    margin-bottom: 0;
}

.profile-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.profile-menu li {
    padding: 15px 20px;
    border-bottom: 1px solid #f5f5f5;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 15px;
    color: #555;
    display: flex;
    align-items: center;
}

.profile-menu li i {
    width: 25px;
    text-align: center;
    margin-right: 10px;
    color: #888;
}

.profile-menu li:hover {
    background-color: #f9f9f9;
    color: #ff4d4d;
}

.profile-menu li.active {
    background-color: #fff0f0;
    color: #ff4d4d;
    border-left: 3px solid #ff4d4d;
}

.profile-menu li.active i {
    color: #ff4d4d;
}

.profile-menu li.logout-item {
    color: #c62828;
}

.profile-menu li.logout-item:hover {
    background-color: #ffebee;
}

/* Content Area */
.profile-content {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    min-height: 400px;
}

.tab-title {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
    color: #333;
}

.section-subtitle {
    font-size: 22px;
    font-weight: bold;
    color: #555;
    margin-top: 30px;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}

.form-group label {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    height: 45px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.form-control:focus {
    border-color: #ff4d4d;
    outline: none;
    box-shadow: none;
}

textarea.form-control {
    height: auto;
}

.btn-save {
    background: #ff4d4d;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 4px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    margin-top: 15px;
    transition: background 0.3s;
}

.btn-save:hover {
    background: #e60000;
}

/* Order Table */
.table th {
    border-top: none;
    border-bottom: 2px solid #eee;
    font-weight: 600;
    color: #333;
}

.table td {
    vertical-align: middle;
    color: #555;
}

.badge-success { background: #4caf50; }
.badge-warning { background: #ff9800; }
.badge-secondary { background: #9e9e9e; }

.btn-view {
    padding: 5px 15px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 20px;
    font-size: 12px;
    color: #555;
    transition: all 0.2s;
}

.btn-view:hover {
    border-color: #ff4d4d;
    color: #ff4d4d;
}

.empty-state {
    text-align: center;
    padding: 40px 0;
    color: #777;
}

.btn-action {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 25px;
    background: #333;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.password-wrapper {
    position: relative;
}

.toggle-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #888;
    z-index: 10;
}
</style>
