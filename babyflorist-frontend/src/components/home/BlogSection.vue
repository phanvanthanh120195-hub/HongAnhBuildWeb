<template>
  <div class="container blog">
    <h1>Latest Blogs</h1>
    <p>- Lorem Ipsum is<span class="hidden-xs"> simply dummy</span> text of the printing -</p>
    <div class="row">
      <div v-for="post in posts" :key="post.id" class="col-lg-4 col-md-4 col-sm-4 col-xs-6 product-blog">
        <router-link :to="'/blog/' + post.slug">
          <img :src="post.image" class="img-responsive" :title="post.title" :alt="post.title">
        </router-link>
        <div class="time-blog">
          <span class="time"><i class="far fa-calendar-alt"></i><span>{{ post.date }}</span></span>
          <span class="time"><i class="far fa-edit"></i><span>{{ post.author }}</span></span>
        </div>
        <h2><router-link :to="'/blog/' + post.slug">{{ post.title }}</router-link></h2>
        <p>{{ post.excerpt }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const posts = ref([
  {
    id: 1,
    title: 'Choose for yourself the Flobal chiffon dress',
    slug: 'flobal-chiffon-dress',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/blog-1.jpg',
    date: 'May, 12 2018',
    author: 'Pixel-Creative',
    excerpt: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'
  },
  {
    id: 2,
    title: 'Choose for yourself the Flobal chiffon dress',
    slug: 'flobal-chiffon-dress-2',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/blog-2.jpg',
    date: 'May, 12 2018',
    author: 'Pixel-Creative',
    excerpt: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'
  },
  {
    id: 3,
    title: 'Choose for yourself the Flobal chiffon dress',
    slug: 'flobal-chiffon-dress-3',
    image: 'https://landing.engotheme.com/html/jenstore/demo/img/blog-3.jpg',
    date: 'May, 12 2018',
    author: 'Pixel-Creative',
    excerpt: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'
  }
])
</script>
