import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthModalStore = defineStore('authModal', () => {
    const isOpen = ref(false)
    const mode = ref('login') // 'login' or 'register'
    const redirectAfterLogin = ref(null) // URL to redirect after successful login

    function openLogin(redirect = null) {
        mode.value = 'login'
        redirectAfterLogin.value = redirect
        isOpen.value = true
    }

    function openRegister(redirect = null) {
        mode.value = 'register'
        redirectAfterLogin.value = redirect
        isOpen.value = true
    }

    function close() {
        isOpen.value = false
        redirectAfterLogin.value = null
    }

    return {
        isOpen,
        mode,
        redirectAfterLogin,
        openLogin,
        openRegister,
        close
    }
})
