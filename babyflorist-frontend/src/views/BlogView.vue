<template>
  <main class="blog-page">
    <div class="container banner">
      <figure id="banner-figure"><a href="#"><img
            src="https://landing.engotheme.com/html/jenstore/demo/img/banner-shop.jpg" class="img-responsive"
            alt="img-holiwood"></a></figure>
      <div class="text-banner">
        <h1>Tulips<br>Collection</h1>
        <p>SALE UP TO 20% OFF</p>
        <a href="#">Shop now</a>
      </div>
    </div>
    <div class="container content">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 menu-breadcrumb">
          <ul class="breadcrumb">
            <li><a href="homev3.html">Home</a></li>
            <li><a href="#">Blogs</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <form class="form-group">
            <input type="text" name="input-find" placeholder="Enter your search" class="input-lg">
            <button type="submit"><i class="fas fa-search"></i></button>
          </form>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 content-blog">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 product-blog">
            <router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }"><img
                src="https://landing.engotheme.com/html/jenstore/demo/img/blog-1.jpg" class="img-responsive"
                alt="img-holiwood"></router-link>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 title-blog">
            <h2><router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }">Choose for yourself the
                Flobal chiffon dress</router-link></h2>
            <div class="time-blog">
              <span class="time"><i class="far fa-calendar-alt"></i><span>May, 12 2018</span></span>
              <span class="time"><i class="far fa-edit"></i><span>Pixel-Creative</span></span>
            </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
            <router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }">Read more</router-link>
          </div>
          <!--  -->
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 product-blog">
            <router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }"><img
                src="https://landing.engotheme.com/html/jenstore/demo/img/blog-2.jpg" class="img-responsive"
                alt="img-holiwood"></router-link>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 title-blog">
            <h2><router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }">Choose for yourself the
                Flobal chiffon dress</router-link></h2>
            <div class="time-blog">
              <span class="time"><i class="far fa-calendar-alt"></i><span>May, 12 2018</span></span>
              <span class="time"><i class="far fa-edit"></i><span>Pixel-Creative</span></span>
            </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
            <router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }">Read more</router-link>
          </div>
          <!--  -->
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 product-blog">
            <router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }"><img
                src="https://landing.engotheme.com/html/jenstore/demo/img/blog-3.jpg" class="img-responsive"
                alt="img-holiwood"></router-link>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 title-blog">
            <h2><router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }">Choose for yourself the
                Flobal chiffon dress</router-link></h2>
            <div class="time-blog">
              <span class="time"><i class="far fa-calendar-alt"></i><span>May, 12 2018</span></span>
              <span class="time"><i class="far fa-edit"></i><span>Pixel-Creative</span></span>
            </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
            <router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }">Read more</router-link>
          </div>
          <!--  -->
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 product-blog">
            <router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }"><img
                src="https://landing.engotheme.com/html/jenstore/demo/img/blog-4.jpg" class="img-responsive"
                alt="img-holiwood"></router-link>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 title-blog">
            <h2><router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }">Choose for yourself the
                Flobal chiffon dress</router-link></h2>
            <div class="time-blog">
              <span class="time"><i class="far fa-calendar-alt"></i><span>May, 12 2018</span></span>
              <span class="time"><i class="far fa-edit"></i><span>Pixel-Creative</span></span>
            </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
            <router-link :to="{ name: 'BlogDetail', params: { slug: 'sample-post' } }">Read more</router-link>
          </div>
          <!--  -->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pagi">
            <ul class="pagination">
              <li><a href="#">01</a></li>
              <li><a href="#">02</a></li>
              <li><a href="#">03</a></li>
              <li><a href="#">04</a></li>
              <li><a href="#"><img src="https://landing.engotheme.com/html/jenstore/demo/img/Next.png"
                    class="img-responsive" alt="img-holiwood"></a></li>
            </ul>
          </div>
        </div>
        <!-- sidebar -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar">
          <div class="collapse navbar-collapse" id="mysidebar">
            <ul class="list-group list-1">
              <li class="list-group-item">Thể loại</li>
              <li class="list-group-item">
                <a href="#">NEW NOW</a>
                <ul class="panel">
                  <li><a href="#">Tuylip</a></li>
                  <li><a href="#">lavender</a></li>
                  <li><a href="#">Rose</a></li>
                </ul>
              </li>
              <li class="list-group-item">
                <a href="flower.html">FLOWER</a>
                <ul class="panel">
                  <li><a href="product-detail.html">Rose</a></li>
                  <li><a href="#">Tulips</a></li>
                  <li><a href="#">Daisy</a></li>
                  <li><a href="#">Carnation</a></li>
                  <li><a href="#">Gerbera</a></li>
                  <li><a href="#">Other</a></li>
                </ul>
              </li>
              <li class="list-group-item">
                <a href="#">PLANT</a>
                <ul class="panel">
                  <li><a href="#">Tuylip</a></li>
                  <li><a href="#">lavender</a></li>
                  <li><a href="#">Rose</a></li>
                </ul>
              </li>
              <li class="list-group-item">
                <a href="#">RING OF PROFESSION</a>
                <ul class="panel">
                  <li><a href="#">Tuylip</a></li>
                  <li><a href="#">lavender</a></li>
                  <li><a href="#">Rose</a></li>
                </ul>
              </li>
            </ul>
            <!--  -->
            <ul class="list-group list-2">
              <li class="list-group-item">RECENT POSTS</li>
              <li class="list-group-item list-item-2">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                  <a href="#"><img src="https://landing.engotheme.com/html/jenstore/demo/img/blog-4.jpg"
                      class="img-responsive" alt="img-holiwood"></a>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 title-post">
                  <a href="#">
                    <h1>Choose for yourself the most style</h1>
                  </a>
                  <p>April, 30 2018</p>
                </div>
              </li>
              <li class="list-group-item list-item-2">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                  <a href="#"><img src="https://landing.engotheme.com/html/jenstore/demo/img/blog-1.jpg"
                      class="img-responsive" alt="img-holiwood"></a>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 title-post">
                  <a href="#">
                    <h1>Choose for yourself the most style</h1>
                  </a>
                  <p>April, 30 2018</p>
                </div>
              </li>
              <li class="list-group-item list-item-2">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                  <a href="#"><img src="https://landing.engotheme.com/html/jenstore/demo/img/blog-3.jpg"
                      class="img-responsive" alt="img-holiwood"></a>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 title-post">
                  <a href="#">
                    <h1>Choose for yourself the most style</h1>
                  </a>
                  <p>April, 30 2018</p>
                </div>
              </li>
              <li class="list-group-item list-item-2">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                  <a href="#"><img src="https://landing.engotheme.com/html/jenstore/demo/img/blog-2.jpg"
                      class="img-responsive" alt="img-holiwood"></a>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 title-post">
                  <a href="#">
                    <h1>Choose for yourself the most style</h1>
                  </a>
                  <p>April, 30 2018</p>
                </div>
              </li>
            </ul>
            <!--  -->
            <div class="panel-default">
              <div class="panel-header">
                ARCHIVE
              </div>
              <div class="panel-body">
                <p>April, 30 2018</p>
                <p>Februaly, 30 2018</p>
              </div>
            </div>
            <div class="blog-tag">
              <h1>BLOG TAGS</h1>
              <a href="#">Rose</a> <a href="#">Tulips</a> <a href="#" class="active-tags">Carnation</a> <a
                href="#">Daisy</a>
              <a href="#">Gerbera</a>
            </div>
          </div>
        </div>
        <div class="navbar-header mobile-sidebar">
          <button type="button" class="navbar-toggle btn-mobile-sidebar" data-toggle="collapse"
            data-target="#mysidebar">
            <i class="fas fa-angle-left" id="icon-sidebar"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="info-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <h3>About</h3>
              <ul>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">News & Stories</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">History</a> </li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Our Studio</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Shop</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Stockists</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <h3>Customer sevices</h3>
              <ul>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Contact Us</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Trade Services</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Login/Register</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Delivery & Returns</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">FAQs</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <h3>Store</h3>
              <ul>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Shop</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Wedding</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Birthday</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Women's day</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <h3>Shop collection</h3>
              <ul>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">New Arrivals</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Hot</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Sale</a></li>
                <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Deal of the day</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 social">
            <p>CONNECT WITH US:</p>
            <a href="#" id="link-insta"></a>
            <a href="#" id="link-fb"></a>
            <a href="#" id="link-tw"></a>
            <a href="#" id="link-sky"></a>
            <h1>Newsletter</h1>
            <h2>Sign up for our mailing list to get latest updates and offers</h2>
            <form class="form-group" action="mail" method="post">
              <input type="text" name="input-mail" placeholder="Your mail here" class="input-lg">
              <button type="submit"><img src="https://landing.engotheme.com/html/jenstore/demo/img/Send.png"
                  alt="img-holiwood"></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
<script setup></script>
<style scoped>
.blog-page {
  margin-top: 168px;
}

.page {
  padding: 2rem;
  text-align: center;
}

.banner {
  position: relative;
}

.banner .text-banner {
  position: absolute;
  left: 170px;
  top: 100px;
}

.banner .text-banner h1 {
  font-family: Abril Fatface;
  font-weight: 400;
  font-size: 60px;
  color: black;
  margin-bottom: 0;
}

.banner .text-banner p {
  font-family: Poppins;
  font-weight: 400;
  font-size: 30px;
  color: black;
  margin-bottom: 30px;
  color: #8f8f8f;
}

.banner .text-banner a {
  font-family: Abril Fatface;
  font-weight: 400;
  font-size: 18px;
  color: black;
  transition: all .3s ease-in-out 0.08s;
  color: white;
  padding: 10px 40px;
  background-color: black;
  border: 1px solid black;
  background-image: -webkit-linear-gradient(90deg, black 50%, transparent 50%);
  background-image: linear-gradient(90deg, black 50%, transparent 50%);
  background-size: 600px;
  background-repeat: no-repeat;
  background-position: 0%;
  -webkit-transition: background .3s ease-in-out;
  transition: background .3s ease-in-out;
}

.banner .text-banner a:hover {
  background-position: 100%;
  background-color: #fff;
  color: black;
  text-decoration: none;
}

.banner #banner-figure {
  overflow: hidden;
  position: relative;
  overflow: hidden;
  position: relative;
}

.banner #banner-figure::before {
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

.banner #banner-figure:hover::before {
  opacity: 1;
  -webkit-animation: shine-left .3s linear forwards;
  animation: shine-left .3s linear forwards;
  overflow: hidden;
}

.banner #banner-figure::after {
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

.banner #banner-figure:hover::after {
  opacity: 1;
  -webkit-animation: shine-right .3s linear forwards;
  animation: shine-right .3s linear forwards;
  overflow: hidden;
}

.content {
  padding: 50px 15px;
}

.content form input {
  font-family: Poppins;
  font-weight: 400;
  font-size: 14px;
  color: black;
  outline: 0;
  border: 0;
  border-radius: 0;
  box-shadow: none;
  padding-left: 20px;
  background: #ebebeb;
  width: 100%;
}

.content form input::-webkit-input-placeholder {
  font-family: Poppins;
  font-weight: 400;
  font-size: 14px;
  color: black;
}

.content form button {
  outline: 0;
  border: 0;
  background: transparent;
  color: white;
  position: absolute;
  top: 13px;
  right: 0;
}

.content form button i {
  color: black;
  font-size: 18px;
}

.content .content-blog .product-blog {
  padding: 25px 0;
}

.content .content-blog .product-blog:hover img {
  opacity: .7;
}

.content .content-blog .product-blog img {
  margin-left: 0 !important;
  transition: all .35s ease;
}

@media (min-width: 1024px) {
  .content .content-blog .product-blog img {
    width: 90%;
  }
}

.content .content-blog .title-blog h2 a {
  font-family: Abril Fatface;
  font-weight: 400;
  font-size: 24px;
  color: black;
  text-align: left;
  width: 90%;
  margin-top: -10px;
}

.content .content-blog .title-blog h2 a:hover {
  text-decoration: none;
}

.content .content-blog .title-blog p {
  font-family: Poppins;
  font-weight: 400;
  font-size: 14px;
  color: black;
  text-align: left;
  width: 90%;
  color: black;
  padding-bottom: 30px;
  line-height: 27px;
}

.content .content-blog .title-blog .time-blog {
  padding-bottom: 20px;
}

.content .content-blog .title-blog .time-blog .time {
  display: inline-block;
  padding-right: 25px;
  margin-top: 20px;
}

.content .content-blog .title-blog .time-blog .time i {
  color: grey;
  padding-right: 10px;
}

.content .content-blog .title-blog .time-blog .time span {
  font-family: Poppins;
  font-weight: 400;
  font-size: 14px;
  color: black;
  color: grey;
}

.content .content-blog .title-blog .time-blog .time:first-child {
  border-right: 1px solid lightgrey;
}

.content .content-blog .title-blog .time-blog .time:last-child {
  padding-left: 25px;
}

.content .content-blog .title-blog .time-blog .time:last-child i {
  padding-right: 5px;
}

.content .content-blog .title-blog a {
  font-family: Abril Fatface;
  font-weight: 400;
  font-size: 18px;
  color: black;
  transition: all .3s ease;
}

.content .content-blog .title-blog a:hover {
  color: pink;
  text-decoration: none;
}

.content .content-blog .pagi {
  padding-bottom: 150px;
  text-align: right;
}

.content .content-blog .pagi .pagination li {
  display: inline-block;
  margin: 2px;
}

.content .content-blog .pagi .pagination li a {
  font-family: Poppins;
  font-weight: 400;
  font-size: 14px;
  color: black;
  background: #eeeeee;
  border: 0;
  padding: 6px 10px;
  color: black;
}

.content .content-blog .pagi .pagination li a img {
  width: 50%;
  margin: auto;
  transition: all .3s ease;
}

.content .content-blog .pagi .pagination li a:hover {
  background: black;
  color: #fff;
}

.content .content-blog .pagi .pagination li:first-child a {
  border-radius: 0;
  background: black;
  color: #fff;
}

.content .content-blog .pagi .pagination li:last-child a {
  border-radius: 0;
  padding: 10px 1px;
}

.content .content-blog .pagi .pagination li:last-child a:hover {
  background: #eeeeee;
}

.content .content-blog .pagi .pagination li:last-child a:hover img {
  transform: translateX(2px);
}

.sidebar .list-group {
  padding-bottom: 30px;
}

.sidebar .list-group.list-1 {
  margin-top: 30px;
}

.sidebar .list-group .list-group-item {
  font-family: Poppins;
  font-weight: 600;
  font-size: 14px;
  color: black;
  color: #b0b0b0;
  padding: 20px;
}

.sidebar .list-group .list-group-item a:focus {
  text-decoration: none;
}

.sidebar .list-group .list-group-item:first-child {
  border-radius: 0;
  font-size: 18px;
  color: black;
}

.sidebar .list-group .list-group-item:last-child {
  border-radius: 0;
}

.sidebar #mysidebar .list-1 a {
  font-family: Poppins;
  font-weight: 600;
  font-size: 14px;
  color: black;
  color: #a8a8a8;
  text-align: left;
  outline: none;
  transition: 0.3s;
}

.sidebar #mysidebar .list-1 a:hover {
  color: black;
  text-decoration: none;
}

.sidebar #mysidebar .list-1 .accordion {
  display: inline-block;
  padding: 0;
  float: right;
  outline: 0;
  border: 0;
  background: transparent;
  color: white;
}

.sidebar #mysidebar .list-1 .accordion:after {
  content: '\002B';
  color: #777;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.sidebar #mysidebar .list-1 .accordion.active {
  color: black;
  padding-bottom: 10px;
}

.sidebar #mysidebar .list-1 .accordion.active:after {
  content: "\2212";
}

.sidebar #mysidebar .panel {
  margin: 0;
  border: 0;
  padding: 0 18px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}

.sidebar #mysidebar .panel li {
  list-style-type: none;
  margin-left: -18px;
  padding: 15px 0 5px 0;
}

.sidebar #mysidebar .panel li a {
  font-family: Poppins;
  font-weight: 400;
  font-size: 14px;
  color: black;
  color: #b0b0b0;
}

.sidebar #mysidebar .panel li a:hover {
  text-decoration: none;
  color: black;
}

.sidebar .list-2 .list-group-item h1 {
  font-family: Abril Fatface;
  font-weight: 400;
  font-size: 14px;
  color: black;
  margin-top: 0;
}

.sidebar .list-2 .list-group-item p {
  font-family: Poppins;
  font-weight: 400;
  font-size: 12px;
  color: black;
  color: #a8a8a8;
}

.sidebar .list-2 .list-group-item.list-item-2 {
  display: inline-block;
  margin-bottom: -6px;
}

.sidebar .list-2 .list-group-item.list-item-2 .col-lg-5 {
  padding: 0;
}

.sidebar .panel-default {
  background: #fff;
}

.sidebar .panel-default .panel-header {
  padding: 20px;
  border: 1px solid #ddd;
  font-family: Poppins;
  font-weight: 600;
  font-size: 18px;
  color: black;
}

.sidebar .panel-default .panel-body {
  padding: 20px;
  border: 1px solid #ddd;
  border-top: 0;
}

.sidebar .panel-default .panel-body p {
  font-family: Poppins;
  font-weight: 400;
  font-size: 14px;
  color: black;
  color: #a8a8a8;
  margin-bottom: 5px;
}

.sidebar .blog-tag h1 {
  font-family: Poppins;
  font-weight: 600;
  font-size: 18px;
  color: black;
  margin: 30px 0 20px 20px;
}

.sidebar .blog-tag a {
  background: #eeeeee;
  text-align: center;
  margin: 4px 2px 4px 0;
  display: inline-block;
  font-family: Poppins;
  font-weight: 400;
  font-size: 14px;
  color: black;
  color: black;
  padding: 10px 15px;
}

.sidebar .blog-tag a.active-tags {
  background: black;
  color: #fff;
  padding: 10px;
}

.sidebar .blog-tag a:hover {
  background: black;
  color: #fff;
  text-decoration: none;
}

/*# sourceMappingURL=style-shop.css.map */
</style>
