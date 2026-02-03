<template>
    <div class="font-display text-[#181111] dark:text-white h-auto bg-no-repeat">
        <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
            <Header />
            <main class="flex flex-col">
                <slot />
            </main>
            <Footer />
        </div>
        <CartDrawer />
    </div>
</template>

<script setup lang="ts">
import CartDrawer from '~/components/common/CartDrawer.vue'
</script>
