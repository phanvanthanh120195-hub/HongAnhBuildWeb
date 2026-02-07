<script setup lang="ts">
import asideLeft from './aside-left.vue';

definePageMeta({
    middleware: 'auth'
})

const { addToast } = useToast()
const config = useRuntimeConfig()
const apiBase = config.public.apiBase

const form = reactive({
    password: '',
    password_confirmation: ''
})

const loading = ref(false)
const showPassword = ref(false)
const showConfirmPassword = ref(false)

const handleChangePassword = async () => {
    if (form.password !== form.password_confirmation) {
        addToast('Mật khẩu xác nhận không khớp', 'error')
        return
    }

    loading.value = true
    try {
        const res: any = await $fetch(`${apiBase}/api/auth/change-password`, {
            method: 'POST',
            body: form,
            headers: {
                'Authorization': `Bearer ${useCookie('auth_token').value}`
            }
        })

        if (res.success) {
            addToast('Đổi mật khẩu thành công!', 'success')
            form.password = ''
            form.password_confirmation = ''
        } else {
            addToast(res.message || 'Đổi mật khẩu thất bại', 'error')
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
                    <div>
                        <div class="mb-10">
                            <h2 class="display-font text-3xl font-bold mb-2 flex items-center gap-3">
                                <span class="w-8 h-[2px] bg-primary"></span>
                                Đổi mật khẩu
                            </h2>
                        </div>
                        <form @submit.prevent="handleChangePassword" class="space-y-8">
                            <div class="space-y-2">
                                <label class="text-base font-semibold text-stone-600 dark:text-stone-400 ml-1">Mật khẩu
                                    mới</label>
                                <div class="relative group">
                                    <span
                                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 group-focus-within:text-primary transition-colors">lock_reset</span>
                                    <input v-model="form.password"
                                        class="w-full pl-12 pr-12 py-3.5 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                        placeholder="••••••••" :type="showPassword ? 'text' : 'password'" />
                                    <button @click="showPassword = !showPassword"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600 dark:hover:text-stone-200 transition-colors"
                                        type="button">
                                        <span class="material-symbols-outlined">{{ showPassword ? 'visibility' :
                                            'visibility_off' }}</span>
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-base font-semibold text-stone-600 dark:text-stone-400 ml-1">Xác nhận
                                    mật khẩu mới</label>
                                <div class="relative group">
                                    <span
                                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 group-focus-within:text-primary transition-colors">verified_user</span>
                                    <input v-model="form.password_confirmation"
                                        class="w-full pl-12 pr-12 py-3.5 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                        placeholder="••••••••" :type="showConfirmPassword ? 'text' : 'password'" />
                                    <button @click="showConfirmPassword = !showConfirmPassword"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600 dark:hover:text-stone-200 transition-colors"
                                        type="button">
                                        <span class="material-symbols-outlined">{{ showConfirmPassword ? 'visibility' :
                                            'visibility_off' }}</span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex justify-start pt-4">
                                <button :disabled="loading"
                                    class="bg-primary hover:bg-red-800 text-white font-bold py-4 px-10 rounded-lg shadow-lg shadow-red-900/20 hover:shadow-red-900/40 transition-all active:scale-95 flex items-center gap-3 disabled:opacity-70 disabled:cursor-not-allowed"
                                    type="submit">
                                    <span v-if="loading" class="material-symbols-outlined animate-spin">refresh</span>
                                    <span v-else class="material-symbols-outlined">update</span>
                                    {{ loading ? 'ĐANG CẬP NHẬT...' : 'CẬP NHẬT MẬT KHẨU' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
</template>
