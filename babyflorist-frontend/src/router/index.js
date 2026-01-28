import { createRouter, createWebHistory } from 'vue-router'

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
        component: () => import('../views/CheckoutView.vue')
    },
    {
        path: '/about',
        name: 'About',
        component: () => import('../views/AboutView.vue')
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../views/auth/LoginView.vue')
    },
    {
        path: '/register',
        name: 'Register',
        component: () => import('../views/auth/RegisterView.vue')
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

export default router
