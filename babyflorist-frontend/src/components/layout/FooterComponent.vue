<template>
  <footer>
    <div class="floating-contacts" :class="{ show: showContacts }">
      <a href="#" class="contact-icon btn-facebook">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#" class="contact-icon btn-zalo">
        <span class="zalo-text" style="padding-top: 0;">Zalo</span>
      </a>
      <a href="#" class="contact-icon btn-messenger">
        <i class="fab fa-facebook-messenger"></i>
      </a>
      <a href="tel:800123654" class="contact-icon btn-phone">
        <i class="fas fa-phone"></i>
      </a>
      <a href="#" class="contact-icon btn-back-to-top" id="scroll-to-top" @click.prevent="scrollToTop">
        <i class="fas fa-arrow-up"></i>
      </a>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 logo-footer">
          <router-link to="/" class="logo-bot"></router-link>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 copy">
          <span>Copyright</span><i class="far fa-copyright"></i><span class="engo">{{ currentYear }} by BabyFlorist</span>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gmail-footer">
          <span id="gmail-footer"><a href="mailto:contact@babyflorist.com">E: contact@babyflorist.com</a></span>
        </div>
      </div>
    </div>
    <div class="hidden-lg hidden-md back-to-top fade"><i class="fas fa-caret-up"></i></div>
    <div class="BG-menu"></div>
  </footer>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue'

const currentYear = computed(() => new Date().getFullYear())
const showContacts = ref(false)

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' })
}

function handleScroll() {
  showContacts.value = window.scrollY > 100
}

onMounted(() => {
  handleScroll() // Check initial position
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
.floating-contacts {
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;
}

.floating-contacts.show {
  opacity: 1;
  visibility: visible;
}
</style>
