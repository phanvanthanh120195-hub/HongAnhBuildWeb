<template>
  <main class="about">
    <div class="banner">
      <div class="container">
        <figure id="banner-about"><a href="#"><img
              src="https://landing.engotheme.com/html/jenstore/demo/img/banner-about.jpg" class="img-responsive"
              alt="img-holiwood"></a></figure>
        <div class="title-banner">
          <h1>About Us</h1>
          <p>It is a long established fact that a reader will<br>be distracted by the readable content of a
            page when looking at its layout</p>
        </div>
      </div>

    </div>
    <div class="wellcome">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu-breadcrumb">
            <ul class="breadcrumb">
              <li><a href="homev3.html">Home</a></li>
              <li><a href="#">About</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-well">
            <div class="media">
              <div class="media-left"><a href="#"><img
                    src="https://landing.engotheme.com/html/jenstore/demo/img/avatar-feedback.png"
                    alt="img-holiwood"></a></div>
              <div class="media-body">
                <h1>WELLCOME</h1>
                <h2>Hello! I am Laura Ellie <br>Founder of Jenstore</h2>
              </div>


            </div>
            <p>Floristry can involve the cultivation of flowers as well as their arrange-ment, and to the
              business of selling them. Much of the raw material supplied for the floristry trade comes
              from the cut flowers industry<br><br>
              Florist shops are the main flower-only outlets, but supermarkets, garden supply stores also
              sell flowers</p>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 img-well">
            <figure id="img-about"><a href="#"><img
                  src="https://landing.engotheme.com/html/jenstore/demo/img/img-about.jpg" alt="img-holiwood"></a>
            </figure>
          </div>
        </div>
      </div>
    </div>
    <div class="team">

      <div class="container">
        <h1 style="text-align: center;">LỊCH SỬ HÌNH THÀNH</h1>
        <p class="history-desc">Những khoảnh khắc đáng nhớ trên hành trình của chúng tôi</p>

        <div class="gallery-grid">
          <div class="gallery-item" v-for="(img, index) in historyImages" :key="index" @click="openLightbox(index)">
            <div class="image-wrapper">
              <img :src="img.src" :alt="img.title" loading="lazy">
              <div class="hover-overlay">
                <div class="top-info">
                  <!-- Optional top info -->
                </div>
                <div class="bottom-info">
                  <span class="photo-title">{{ img.title }}</span>
                  <button class="btn-download-sm" @click.stop="downloadImage(img.src, img.title)">
                    <i class="fas fa-arrow-down"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Lightbox Modal -->
    <div v-if="lightbox.isOpen" class="lightbox-modal" @keydown.esc="closeLightbox" tabindex="0" ref="lightboxRef">
      <div class="lightbox-backdrop" @click="closeLightbox"></div>

      <button class="lightbox-close" @click="closeLightbox">
        <i class="fas fa-times"></i>
      </button>

      <button class="lightbox-nav prev" @click="prevImage" v-if="historyImages.length > 1">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="lightbox-content">
        <div class="lightbox-image-container">
          <img :src="historyImages[lightbox.currentIndex].src" class="lightbox-img" alt="Full view">
        </div>
        <div class="lightbox-header">
          <div class="user-info">
            <span class="lightbox-title">{{ historyImages[lightbox.currentIndex].title }}</span>
            <span class="lightbox-subtitle">BabyFlorist Moments</span>
          </div>
          <div class="actions">
            <button class="btn-download-lg"
              @click="downloadImage(historyImages[lightbox.currentIndex].src, historyImages[lightbox.currentIndex].title)">
              Tải xuống
            </button>
          </div>
        </div>
      </div>

      <button class="lightbox-nav next" @click="nextImage" v-if="historyImages.length > 1">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
  </main>
</template>

<script setup>
import { ref, reactive, onMounted, onUnmounted } from 'vue';

const historyImages = ref([
  { src: 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?q=80&w=600&auto=format&fit=crop', title: 'Khởi đầu đam mê' },
  { src: 'https://images.unsplash.com/photo-1526047932273-341f2a7631f9?q=80&w=600&auto=format&fit=crop', title: 'Cửa hàng đầu tiên' },
  { src: 'https://images.unsplash.com/photo-1470509037663-253afd7f0f51?q=80&w=600&auto=format&fit=crop', title: 'Những bông hoa tươi nhất' },
  { src: 'https://images.unsplash.com/photo-1463936575829-25148e1db1b8?q=80&w=600&auto=format&fit=crop', title: 'Khách hàng thân thiết' },
  // { src: 'https://images.unsplash.com/photo-1582794543139-8ac92a9ab5d9?q=80&w=600&auto=format&fit=crop', title: 'Workshop cắm hoa' },
  // { src: 'https://images.unsplash.com/photo-1490750967868-58cb75063ed4?q=80&w=600&auto=format&fit=crop', title: 'Mùa xuân 2024' },
  { src: 'https://images.unsplash.com/photo-1507290439931-a861b5a38200?q=80&w=600&auto=format&fit=crop', title: 'Tận tâm phục vụ' },
  { src: 'https://images.unsplash.com/photo-1519378058457-4c29a0a2efac?q=80&w=600&auto=format&fit=crop', title: 'Đội ngũ nhân viên' },
]);

const lightbox = reactive({
  isOpen: false,
  currentIndex: 0
});

const lightboxRef = ref(null);

const openLightbox = (index) => {
  lightbox.currentIndex = index;
  lightbox.isOpen = true;
  document.body.style.overflow = 'hidden';
  // Focus lightbox for keyboard navigation
  setTimeout(() => {
    if (lightboxRef.value) lightboxRef.value.focus();
  }, 100);
};

const closeLightbox = () => {
  lightbox.isOpen = false;
  document.body.style.overflow = '';
};

const nextImage = () => {
  lightbox.currentIndex = (lightbox.currentIndex + 1) % historyImages.value.length;
};

const prevImage = () => {
  lightbox.currentIndex = (lightbox.currentIndex - 1 + historyImages.value.length) % historyImages.value.length;
};

const downloadImage = async (url, filename) => {
  try {
    const response = await fetch(url);
    const blob = await response.blob();
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = filename || 'downloaded-image';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(link.href);
  } catch (error) {
    console.error('Download failed:', error);
    window.open(url, '_blank');
  }
};

const handleKeydown = (e) => {
  if (!lightbox.isOpen) return;
  if (e.key === 'ArrowRight') nextImage();
  if (e.key === 'ArrowLeft') prevImage();
  if (e.key === 'Escape') closeLightbox();
};

onMounted(() => {
  window.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown);
});
</script>

<style scoped>
/* History Section Styles */
.about {
  position: relative;
  padding-bottom: 50px;
}

.history-desc {
  text-align: center;
  margin-bottom: 40px;
  font-size: 16px;
  color: #666;
}

.gallery-grid {
  column-count: 3;
  column-gap: 20px;
  padding: 0 10px;
}

@media (max-width: 991px) {
  .gallery-grid {
    column-count: 2;
  }
}

@media (max-width: 576px) {
  .gallery-grid {
    column-count: 1;
  }
}

.gallery-item {
  break-inside: avoid;
  margin-bottom: 20px;
  position: relative;
  cursor: zoom-in;
  border-radius: 4px;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.gallery-item:hover {
  transform: translateY(-2px);
}

.image-wrapper {
  position: relative;
}

.gallery-item img {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 4px;
}

.hover-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3);
  /* Gradient for better text visibility */
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 0.6) 100%);
  opacity: 0;
  transition: opacity 0.2s ease-in-out;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
}

.gallery-item:hover .hover-overlay {
  opacity: 1;
}

.bottom-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.photo-title {
  color: #fff;
  font-weight: 500;
  font-size: 15px;
  text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
  font-family: 'Poppins', sans-serif;
}

.btn-download-sm {
  background: #f1f1f1;
  border: 1px solid transparent;
  border-radius: 4px;
  color: #444;
  cursor: pointer;
  font-size: 14px;
  height: 32px;
  line-height: 30px;
  padding: 0 10px;
  text-align: center;
  transition: all 0.1s ease-in-out;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-download-sm:hover {
  background: #fff;
  color: #111;
}

/* Lightbox Styles */
.lightbox-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 10000;
  display: flex;
  justify-content: center;
  align-items: center;
  outline: none;
}

.lightbox-backdrop {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.9);
}

.lightbox-content {
  position: relative;
  z-index: 10001;
  display: flex;
  flex-direction: column;
  max-width: 90vw;
  max-height: 90vh;
}

.lightbox-image-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex: 1;
  overflow: hidden;
}

.lightbox-img {
  max-width: 100%;
  max-height: 80vh;
  object-fit: contain;
  border-radius: 2px;
}

.lightbox-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 0 0 0;
  color: #fff;
}

.user-info {
  display: flex;
  flex-direction: column;
}

.lightbox-title {
  font-size: 16px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
}

.lightbox-subtitle {
  font-size: 12px;
  opacity: 0.8;
}

.btn-download-lg {
  background-color: #3cb46e;
  color: #fff;
  border: 1px solid transparent;
  border-radius: 4px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  height: 32px;
  line-height: 30px;
  padding: 0 11px;
  text-align: center;
  text-decoration: none;
  transition: all .1s ease-in-out;
}

.btn-download-lg:hover {
  background-color: #37a866;
}

.lightbox-close {
  position: absolute;
  top: 10px;
  right: 10px;
  /* Unsplash closes usually on top left or custom */
  top: 20px;
  right: 30px;
  background: transparent;
  border: none;
  color: #fff;
  /* White close icon */
  font-size: 24px;
  cursor: pointer;
  z-index: 10002;
  opacity: 0.8;
  transition: opacity 0.2s;
}

.lightbox-close:hover {
  opacity: 1;
}

.lightbox-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: transparent;
  border: none;
  color: rgba(255, 255, 255, 0.7);
  font-size: 40px;
  cursor: pointer;
  z-index: 10002;
  padding: 20px;
  transition: color 0.2s;
}

.lightbox-nav:hover {
  color: #fff;
}

.lightbox-nav.prev {
  left: 20px;
}

.lightbox-nav.next {
  right: 20px;
}

.about {
  margin-top: 168px;
}

.banner {
  position: relative;
  padding-bottom: 50px;
}

.banner #banner-about {
  overflow: hidden;
  position: relative;
  overflow: hidden;
  position: relative;
}

.banner #banner-about::before {
  opacity: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  right: 33%;
  display: block;
  content: '';
  width: 25%;
  height: 100%;
  background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
  background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
  -webkit-transform: skewX(50deg);
  transform: skewX(50deg);
  transition: all .3s ease-in-out;
}

.banner #banner-about:hover::before {
  opacity: 1;
  -webkit-animation: shine-left .3s linear forwards;
  animation: shine-left .3s linear forwards;
  overflow: hidden;
}

.banner #banner-about::after {
  opacity: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 33%;
  display: block;
  content: '';
  width: 25%;
  height: 100%;
  background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
  background: linear-gradient(to left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
  -webkit-transform: skewX(50deg);
  transform: skewX(50deg);
  transition: all .3s ease-in-out;
}

.banner #banner-about:hover::after {
  opacity: 1;
  -webkit-animation: shine-right .3s linear forwards;
  animation: shine-right .3s linear forwards;
  overflow: hidden;
}

.banner .title-banner {
  position: absolute;
  top: 28%;
  left: 36%;
}

.banner .title-banner h1 {
  font-family: Abril Fatface;
  font-weight: 400;
  font-size: 60px;
  color: black;
  text-align: center;
  color: #fff;
}

.banner .title-banner p {
  font-family: Poppins;
  font-weight: 400;
  font-size: 14px;
  color: black;
  color: #f4f4f4;
  text-align: center;
  opacity: .8;
}

.wellcome {
  padding-bottom: 130px;
}

.wellcome .media {
  padding-bottom: 20px;
}

.wellcome .media .media-body {
  padding-left: 40px;
}

.wellcome .media .media-body h1 {
  font-family: Poppins;
  font-weight: 400;
  font-size: 18px;
  color: black;
  margin-top: 10px;
  color: #4e4e4e;
}

.wellcome .media .media-body h2 {
  font-family: Abril Fatface;
  font-weight: 400;
  font-size: 30px;
  color: black;
  margin-top: 0;
}

.wellcome p {
  font-family: Poppins;
  font-weight: 400;
  font-size: 16px;
  color: black;
  padding: 0 90px 20px 0;
}

.wellcome .social-well span {
  font-family: Poppins;
  font-weight: 600;
  font-size: 16px;
  color: black;
  padding-right: 20px;
  position: relative;
  top: -10px;
}

.wellcome .social-well a {
  display: inline-block;
  width: 35px;
  height: 35px;
  margin-right: 10px;
  opacity: .3;
  transition: all .5s ease;
}

.wellcome #img-about {
  overflow: hidden;
  position: relative;
  overflow: hidden;
  position: relative;
}

.wellcome #img-about::before {
  opacity: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  right: 33%;
  display: block;
  content: '';
  width: 25%;
  height: 100%;
  background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
  background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
  -webkit-transform: skewX(50deg);
  transform: skewX(50deg);
  transition: all .3s ease-in-out;
}

.wellcome #img-about:hover::before {
  opacity: 1;
  -webkit-animation: shine-left .3s linear forwards;
  animation: shine-left .3s linear forwards;
  overflow: hidden;
}

.wellcome #img-about::after {
  opacity: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 33%;
  display: block;
  content: '';
  width: 25%;
  height: 100%;
  background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
  background: linear-gradient(to left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
  -webkit-transform: skewX(50deg);
  transform: skewX(50deg);
  transition: all .3s ease-in-out;
}

.wellcome #img-about:hover::after {
  opacity: 1;
  -webkit-animation: shine-right .3s linear forwards;
  animation: shine-right .3s linear forwards;
  overflow: hidden;
}
</style>
