<template>
  <div id="app">
    <HeaderComponent />
    <main>
      <router-view />
    </main>
    <InfoFooter />
    <FooterComponent />
  </div>
</template>

<script setup>
import HeaderComponent from '@/components/layout/HeaderComponent.vue'
import InfoFooter from '@/components/layout/InfoFooter.vue'
import FooterComponent from '@/components/layout/FooterComponent.vue'
</script>
