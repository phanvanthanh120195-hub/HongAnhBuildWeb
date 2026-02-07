<script setup lang="ts">
import asideLeft from './aside-left.vue';
import SearchableSelect from '~/components/common/SearchableSelect.vue';

definePageMeta({
    middleware: 'auth'
})

const { user, fetchUser } = useAuth()
const { addToast } = useToast()
const config = useRuntimeConfig()
const apiBase = config.public.apiBase

const form = reactive({
    name: '',
    phone: '',
    email: '',
    province: null,
    district: null,
    ward: null,
    address: ''
})

const loading = ref(false)
const provinces = ref([])
const districts = ref([])
const wards = ref([])

// Initialize data
onMounted(async () => {
    if (user.value) {
        form.name = user.value.name
        form.phone = user.value.phone
        form.email = user.value.email
        form.province = user.value.province
        form.district = user.value.district
        form.ward = user.value.ward
        form.address = user.value.address

        // Load initial address data if exists
        await fetchProvinces()
        if (form.province) await fetchDistricts(form.province)
        if (form.district) await fetchWards(form.district)
    }
})

// Address API calls
const fetchProvinces = async () => {
    try {
        const res: any = await $fetch(`${apiBase}/api/addresses/provinces`)
        if (res.success) provinces.value = res.data
    } catch (e) {
        console.error(e)
    }
}

const fetchDistricts = async (provinceId: any) => {
    try {
        const res: any = await $fetch(`${apiBase}/api/addresses/districts/${provinceId}`)
        if (res.success) districts.value = res.data
    } catch (e) {
        console.error(e)
    }
}

const fetchWards = async (districtId: any) => {
    try {
        const res: any = await $fetch(`${apiBase}/api/addresses/wards/${districtId}`)
        if (res.success) wards.value = res.data
    } catch (e) {
        console.error(e)
    }
}

// Watchers for cascading dropdowns
watch(() => form.province, (newVal) => {
    districts.value = []
    wards.value = []
    if (newVal) fetchDistricts(newVal)
})

watch(() => form.district, (newVal) => {
    wards.value = []
    if (newVal) fetchWards(newVal)
})

const saveProfile = async () => {
    loading.value = true
    try {
        const res: any = await $fetch(`${apiBase}/api/auth/profile`, {
            method: 'POST',
            body: form,
            headers: {
                'Authorization': `Bearer ${useCookie('auth_token').value}`
            }
        })

        if (res.success) {
            addToast('Cập nhật thông tin thành công!', 'success')
            await fetchUser() // Refresh user data
        } else {
            addToast(res.message || 'Cập nhật thất bại', 'error')
        }
    } catch (e: any) {
        addToast(e.response?._data?.message || 'Có lỗi xảy ra', 'error')
    } finally {
        loading.value = false
    }
}
</script>

<template>
    <main class="max-w-[1400px] mx-auto px-6 py-12 min-h-[60vh]">
        <div class="flex flex-col lg:flex-row gap-8">
            <asideLeft />
            <section class="w-full lg:w-3/4">
                <div
                    class="bg-white dark:bg-stone-900 rounded-2xl p-8 lg:p-10 shadow-sm border border-stone-100 dark:border-stone-800 min-w-[1000px]">
                    <div class="mb-10">
                        <h2 class="display-font text-2xl font-bold mb-6 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-primary"></span>
                            Thông tin cá nhân
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Họ và
                                    tên</label>
                                <input v-model="form.name"
                                    class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                    placeholder="Nhập họ và tên" type="text" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Số điện
                                    thoại</label>
                                <input v-model="form.phone"
                                    class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                    placeholder="Nhập số điện thoại" type="tel" />
                            </div>
                            <div class="md:col-span-2 space-y-2">
                                <label
                                    class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Email</label>
                                <input v-model="form.email"
                                    class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-100 dark:bg-stone-900 text-stone-500 cursor-not-allowed outline-none"
                                    placeholder="example@email.com" type="email" />
                            </div>
                        </div>
                    </div>
                    <hr class="border-stone-100 dark:border-stone-800 mb-10" />
                    <div class="mb-10">
                        <h2 class="display-font text-2xl font-bold mb-6 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-primary"></span>
                            Địa chỉ nhận hàng
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Tỉnh/Thành
                                    phố</label>
                                <SearchableSelect v-model="form.province" :options="provinces"
                                    placeholder="Chọn Tỉnh/Thành" />
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Quận/Huyện</label>
                                <SearchableSelect v-model="form.district" :options="districts"
                                    placeholder="Chọn Quận/Huyện" :disabled="!form.province" />
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Phường/Xã</label>
                                <SearchableSelect v-model="form.ward" :options="wards" placeholder="Chọn Phường/Xã"
                                    :disabled="!form.district" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-stone-600 dark:text-stone-400 ml-1">Địa chỉ cụ
                                thể</label>
                            <textarea v-model="form.address"
                                class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none resize-none"
                                placeholder="Số nhà, tên đường..." rows="4"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-start">
                        <button @click="saveProfile" :disabled="loading"
                            class="bg-primary hover:bg-red-800 text-white font-bold py-4 px-10 rounded-lg shadow-lg shadow-red-900/20 hover:shadow-red-900/40 transition-all active:scale-95 flex items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                            <span v-if="loading" class="material-icons-outlined animate-spin">refresh</span>
                            <span v-else class="material-icons-outlined">save</span>
                            {{ loading ? 'ĐANG LƯU...' : 'LƯU THAY ĐỔI' }}
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </main>
</template>
