<script setup lang="ts">
const { toasts, removeToast } = useToast();
</script>

<template>
    <div class="fixed top-4 right-4 z-50 flex flex-col gap-2 w-full max-w-xs sm:max-w-sm" style="pointer-events: none;">
        <TransitionGroup name="toast">
            <div v-for="toast in toasts" :key="toast.id"
                class="pointer-events-auto flex items-center p-4 rounded-lg shadow-lg border-l-4 transform transition-all duration-300"
                :class="{
                    'bg-white dark:bg-stone-800 text-stone-800 dark:text-stone-100 border-green-500': toast.type === 'success',
                    'bg-white dark:bg-stone-800 text-stone-800 dark:text-stone-100 border-red-500': toast.type === 'error',
                    'bg-white dark:bg-stone-800 text-stone-800 dark:text-stone-100 border-blue-500': toast.type === 'info',
                    'bg-white dark:bg-stone-800 text-stone-800 dark:text-stone-100 border-yellow-500': toast.type === 'warning',
                }">
                <!-- Icons -->
                <div class="mr-3">
                    <span v-if="toast.type === 'success'"
                        class="material-icons-outlined text-green-500">check_circle</span>
                    <span v-else-if="toast.type === 'error'" class="material-icons-outlined text-red-500">error</span>
                    <span v-else-if="toast.type === 'info'" class="material-icons-outlined text-blue-500">info</span>
                    <span v-else-if="toast.type === 'warning'"
                        class="material-icons-outlined text-yellow-500">warning</span>
                </div>

                <!-- Message -->
                <div class="flex-1 text-sm font-medium">
                    {{ toast.message }}
                </div>

                <!-- Close Button -->
                <button @click="removeToast(toast.id)"
                    class="ml-3 text-stone-400 hover:text-stone-600 dark:hover:text-stone-200 transition-colors">
                    <span class="material-icons-outlined text-sm">close</span>
                </button>
            </div>
        </TransitionGroup>
    </div>
</template>

<style scoped>
.toast-enter-active,
.toast-leave-active {
    transition: all 0.4s ease;
}

.toast-enter-from {
    opacity: 0;
    transform: translateX(100%);
}

.toast-leave-to {
    opacity: 0;
    transform: translateX(100%);
}
</style>
