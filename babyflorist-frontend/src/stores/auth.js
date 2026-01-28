import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { authService } from '../services/api'

export const useAuthStore = defineStore('auth', () => {
    const user = ref(null)
    const token = ref(localStorage.getItem('token'))

    const isAuthenticated = computed(() => !!token.value)

    async function login(credentials) {
        const response = await authService.login(credentials)
        token.value = response.data.token
        user.value = response.data.user
        localStorage.setItem('token', token.value)
        return response
    }

    async function register(data) {
        const response = await authService.register(data)
        token.value = response.data.token
        user.value = response.data.user
        localStorage.setItem('token', token.value)
        return response
    }

    async function logout() {
        try {
            await authService.logout()
        } finally {
            token.value = null
            user.value = null
            localStorage.removeItem('token')
        }
    }

    async function fetchUser() {
        if (token.value && !user.value) {
            try {
                const response = await authService.getProfile()
                user.value = response.data
            } catch {
                logout()
            }
        }
    }

    return {
        user,
        token,
        isAuthenticated,
        login,
        register,
        logout,
        fetchUser
    }
})
