import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useCartStore = defineStore('cart', () => {
    const items = ref([])
    const voucher = ref(null)

    const totalItems = computed(() => {
        return items.value.reduce((sum, item) => sum + item.quantity, 0)
    })

    const subtotal = computed(() => {
        return items.value.reduce((sum, item) => sum + (item.price * item.quantity), 0)
    })

    const discount = computed(() => {
        if (!voucher.value) return 0
        return Math.floor(subtotal.value * (voucher.value.discount_percentage / 100))
    })

    const total = computed(() => {
        return subtotal.value - discount.value
    })

    function addItem(product, quantity = 1, size = null) {
        const existingItem = items.value.find(
            item => item.id === product.id && item.size === size && item.type === 'product'
        )

        if (existingItem) {
            existingItem.quantity += quantity
        } else {
            items.value.push({
                id: product.id,
                name: product.name,
                price: product.sale_price || product.price,
                image: product.image,
                quantity,
                size,
                type: 'product'
            })
        }
        saveToStorage()
    }

    function addCourse(course) {
        const exists = items.value.find(
            item => item.id === course.id && item.type === 'course'
        )

        if (!exists) {
            items.value.push({
                id: course.id,
                name: course.name,
                price: course.sale_price || course.price,
                image: course.thumbnail,
                quantity: 1,
                type: 'course'
            })
            saveToStorage()
        }
    }

    function updateQuantity(index, quantity) {
        if (quantity <= 0) {
            removeItem(index)
        } else {
            items.value[index].quantity = quantity
            saveToStorage()
        }
    }

    function removeItem(index) {
        items.value.splice(index, 1)
        saveToStorage()
    }

    function clearCart() {
        items.value = []
        voucher.value = null
        saveToStorage()
    }

    function applyVoucher(voucherData) {
        voucher.value = voucherData
        saveToStorage()
    }

    function saveToStorage() {
        localStorage.setItem('cart', JSON.stringify(items.value))
        localStorage.setItem('voucher', JSON.stringify(voucher.value))
    }

    function loadFromStorage() {
        const savedCart = localStorage.getItem('cart')
        const savedVoucher = localStorage.getItem('voucher')
        if (savedCart) items.value = JSON.parse(savedCart)
        if (savedVoucher) voucher.value = JSON.parse(savedVoucher)
    }

    return {
        items,
        voucher,
        totalItems,
        subtotal,
        discount,
        total,
        addItem,
        addCourse,
        updateQuantity,
        removeItem,
        clearCart,
        applyVoucher,
        loadFromStorage
    }
})
