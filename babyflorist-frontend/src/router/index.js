import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { useAuthModalStore } from '@/stores/authModal'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('../views/HomeView.vue')
    },
    {
        path: '/products',
        name: 'Products',
        component: () => import('../views/ProductsView.vue')
    },
    {
        path: '/products/:slug',
        name: 'ProductDetail',
        component: () => import('../views/ProductDetailView.vue')
    },
    {
        path: '/categories/:slug',
        name: 'Category',
        component: () => import('../views/CategoryView.vue')
    },
    {
        path: '/courses',
        name: 'Courses',
        component: () => import('../views/CoursesView.vue')
    },
    {
        path: '/courses/:slug',
        name: 'CourseDetail',
        component: () => import('../views/CourseDetailView.vue')
    },
    {
        path: '/checkout/course/:slug',
        name: 'CourseCheckout',
        component: () => import('../views/CourseCheckoutView.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/blog',
        name: 'Blog',
        component: () => import('../views/BlogView.vue')
    },
    {
        path: '/blog/:slug',
        name: 'BlogDetail',
        component: () => import('../views/BlogDetailView.vue')
    },
    {
        path: '/cart',
        name: 'Cart',
        component: () => import('../views/CartView.vue')
    },
    {
        path: '/checkout',
        name: 'Checkout',
        component: () => import('../views/CartCheckoutView.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/about',
        name: 'About',
        component: () => import('../views/AboutView.vue')
    },
    {
        path: '/profile',
        name: 'Profile',
        component: () => import('../views/ProfileView.vue'),
        meta: { requiresAuth: true }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// Navigation Guard
router.beforeEach((to, from, next) => {
    const authStore = useAuthStore()
    const authModalStore = useAuthModalStore()

    if (to.meta.requiresAuth && !authStore.token) {
        // Open auth modal and redirect after login
        authModalStore.openLogin(to.fullPath)
        // Stay on current page or go to home
        if (from.name) {
            next(false)
        } else {
            next('/')
        }
    } else {
        next()
    }
})

export default router

