import axios from 'axios'

const api = axios.create({
    baseURL: 'http://localhost:8000/api',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
})

// Request interceptor - add auth token
api.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('token')
        if (token) {
            config.headers.Authorization = `Bearer ${token}`
        }
        return config
    },
    (error) => Promise.reject(error)
)

// Response interceptor - handle errors
api.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            localStorage.removeItem('token')
            window.location.href = '/login'
        }
        return Promise.reject(error)
    }
)

export default api

// API Services
export const categoryService = {
    getAll: () => api.get('/categories'),
    getById: (id) => api.get(`/categories/${id}`)
}

export const productService = {
    getAll: (params = {}) => api.get('/products', { params }),
    getBySlug: (slug) => api.get(`/products/${slug}`)
}

export const courseService = {
    getAll: (params = {}) => api.get('/courses', { params }),
    getBySlug: (slug) => api.get(`/courses/${slug}`)
}

export const blogService = {
    getAll: (params = {}) => api.get('/blogs', { params }),
    getBySlug: (slug) => api.get(`/blogs/${slug}`)
}

export const authService = {
    login: (credentials) => api.post('/customer/login', credentials),
    register: (data) => api.post('/customer/register', data),
    logout: () => api.post('/customer/logout'),
    getProfile: () => api.get('/customer/profile'),
    updateProfile: (data) => api.post('/customer/profile', data, {
        headers: data instanceof FormData ? { 'Content-Type': 'multipart/form-data' } : {}
    }),
    changePassword: (data) => api.post('/customer/change-password', data)
}

export const cartService = {
    get: () => api.get('/cart'),
    add: (item) => api.post('/cart', item),
    update: (itemId, quantity) => api.put(`/cart/${itemId}`, { quantity }),
    remove: (itemId) => api.delete(`/cart/${itemId}`),
    applyVoucher: (code) => api.post('/cart/voucher', { code })
}

export const orderService = {
    create: (data) => api.post('/orders', data),
    getAll: () => api.get('/orders'),
    getById: (id) => api.get(`/orders/${id}`)
}

export const reviewService = {
    getAll: (params = {}) => api.get('/reviews', { params })
}

