<script setup lang="ts">
const emit = defineEmits(['close', 'confirm'])

const props = defineProps({
    bank: {
        type: Object,
        required: true
    },
    amount: {
        type: Number,
        required: true
    },
    content: {
        type: String,
        required: true
    }
})

const timeLeft = ref('02:56')

// Format price helper
const formatPrice = (price: number) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price || 0)
}

// Generate QR Code URL
const qrCodeUrl = computed(() => {
    if (!props.bank) return ''
    // Use bank.bin or bank.short_name (e.g., VPBank, VCB). Fallback to bank_code or bank_name if needed.
    // Assuming backend provides 'bin' or 'short_name'. If not, we might need a mapping or hope 'bank_name' works if it matches VietQR ID.
    // Standard format: https://img.vietqr.io/image/<BANK_ID>-<ACCOUNT_NO>-<TEMPLATE>.png
    const bankId = props.bank.bin || props.bank.short_name || props.bank.bank_code || 'VPBank' // Fallback
    const accountNo = props.bank.account_number
    const template = 'compact'

    let url = `https://img.vietqr.io/image/${bankId}-${accountNo}-${template}.png?amount=${props.amount}&addInfo=${encodeURIComponent(props.content)}&accountName=${encodeURIComponent(props.bank.account_name)}`
    return url
})

// Simple countdown timer logic (optional, for visual effect like in HTML)
let timer: any
onMounted(() => {
    let seconds = 176 // 2m 56s
    timer = setInterval(() => {
        if (seconds > 0) {
            seconds--
            const m = Math.floor(seconds / 60).toString().padStart(2, '0')
            const s = (seconds % 60).toString().padStart(2, '0')
            timeLeft.value = `${m}:${s}`
        } else {
            clearInterval(timer)
            emit('close')
        }
    }, 1000)
})

onUnmounted(() => {
    if (timer) clearInterval(timer)
})

const copyToClipboard = async (text: string) => {
    try {
        await navigator.clipboard.writeText(text)
        // Optionally show toast/tooltip
    } catch (err) {
        console.error('Failed to copy', err)
    }
}

const isConfirming = ref(false)

const handleConfirm = () => {
    isConfirming.value = true
    emit('confirm')
}
</script>

<template>
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
        @click.self="emit('close')">
        <div
            class="bg-white dark:bg-[#1a0c0e] w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
            <div class="relative p-6 border-b border-[#e7cfd1] dark:border-[#3d2a2c] text-center">
                <h3 class="text-xl font-bold text-[#1b0d0f] dark:text-white">Quét mã để thanh toán</h3>
                <button @click="emit('close')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6 md:p-8">
                <p class="text-center text-sm text-[#9a4c52] dark:text-[#c08287] mb-5">
                    Vui lòng quét mã QR hoặc chuyển khoản theo thông tin bên dưới để hoàn tất đăng ký.
                </p>
                <div class="flex items-center justify-center space-x-2 text-primary font-medium mb-5">
                    <span class="material-symbols-outlined text-lg">schedule</span>
                    <span>Thời gian còn lại: <span class="font-bold">{{ timeLeft }}</span></span>
                </div>
                <div class="flex flex-col items-center mb-4">
                    <div class="mb-4">
                        <img :src="qrCodeUrl" alt="Mã QR Thanh Toán"
                            class="w-48 h-48 border-4 border-white dark:border-[#3d2a2c] rounded-lg shadow-sm" />
                    </div>
                </div>
                <div class="space-y-3 text-sm md:text-base mb-8">
                    <div class="flex justify-between items-center py-1">
                        <span class="text-[#9a4c52] dark:text-[#c08287]">Ngân hàng:</span>
                        <span class="font-semibold text-[#1b0d0f] dark:text-white">{{ bank?.bank_name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-[#9a4c52] dark:text-[#c08287]">Số tài khoản:</span>
                        <div class="flex items-center space-x-2">
                            <span class="font-bold text-[#1b0d0f] dark:text-white">{{ bank?.account_number }}</span>
                            <button @click="copyToClipboard(bank?.account_number)"
                                class="text-primary hover:bg-primary/10 p-1 rounded transition-colors" title="Copy">
                                <span class="material-symbols-outlined text-base">content_copy</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-[#9a4c52] dark:text-[#c08287]">Chủ tài khoản:</span>
                        <span class="font-semibold text-[#1b0d0f] dark:text-white uppercase">{{ bank?.account_name
                        }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-[#9a4c52] dark:text-[#c08287]">Số tiền:</span>
                        <span class="font-bold text-primary text-lg">{{ formatPrice(amount) }}</span>
                    </div>
                    <div
                        class="flex justify-between items-center py-2 px-3 bg-background-light dark:bg-background-dark rounded-lg">
                        <span class="text-[#9a4c52] dark:text-[#c08287] text-xs">Nội dung CK:</span>
                        <div class="flex items-center space-x-2">
                            <span class="font-mono font-bold text-[#1b0d0f] dark:text-white">{{ content }}</span>
                            <button @click="copyToClipboard(content)"
                                class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600/80 px-2 py-1 rounded text-xs flex items-center transition-colors">
                                <span class="material-symbols-outlined text-sm mr-1">content_copy</span> Copy
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Info banner -->
                <div
                    class="bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 p-4 rounded-xl mb-6">
                    <div class="flex space-x-3">
                        <span class="material-symbols-outlined text-blue-500 text-xl">info</span>
                        <p class="text-xs md:text-sm text-blue-800 dark:text-blue-300 leading-relaxed">
                            Hệ thống sẽ tự động kích hoạt khóa học sau khi nhận được thanh toán (1-5 phút).
                        </p>
                    </div>
                </div>
                <button @click="handleConfirm" :disabled="isConfirming"
                    class="w-full py-4 bg-[#0dad68] hover:bg-[#0b9c5d] active:scale-[0.98] text-white font-bold rounded-xl transition-all shadow-lg shadow-green-200 dark:shadow-none uppercase tracking-wide disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                    <span v-if="isConfirming" class="material-symbols-outlined animate-spin">progress_activity</span>
                    {{ isConfirming ? 'Đang xử lý...' : 'Tôi đã chuyển khoản' }}
                </button>
            </div>
        </div>
    </div>
</template>
