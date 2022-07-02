<template>
    <carousel :items-to-show="1" :autoplay="3000" :transition="3000" :wrapAround="true" :pauseAutoplayOnHover="true">
        <slide v-if="mobileWindow" v-for="image in mobileImages" :key="image.id">
            <a :href="'/contact'">
                <img :src="image.url"/>
            </a>
        </slide>
        <slide v-else v-for="image in images" :key="image.id">
            <a :href="'/contact'">
                <img :src="image.url"/>
            </a>
        </slide>
    </carousel>
</template>

<script setup>
import "vue3-carousel/dist/carousel.css";
import { defineComponent, registerRuntimeCompiler, toRefs, ref, onMounted, watch } from "vue";
import { Carousel, Pagination, Navigation, Slide } from "vue3-carousel";

    const mobileView = ref(false)
    const windowWidth = ref(0)
    if(window.innerWidth < 768){
        mobileView.value = true
    }

    const calculateWindowWidth = () => {
      windowWidth.value = window.innerWidth
      
      return mobileView.value = windowWidth.value < 768
    }

    const mobileImages = [
        { url: "/images/header-mobile.png" },
        { url: "/images/header-mobile.png" },
        { url: "/images/header-mobile.png" },
        { url: "/images/header-mobile.png" },
    ];

    const images = [
        { url: "/images/header.png" },
        { url: "/images/header.png" },
        { url: "/images/header.png" },
        { url: "/images/header.png" },
    ];
</script>
<style scoped>
.container {
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}
.carousel__slide {
  padding: 10px;
  min-height: 200px;
  width: 100%;
  color: white;
  font-size: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
}
</style>