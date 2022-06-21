<template>
  <carousel :items-to-show="1" :autoplay="3000" :transition="3000" :wrapAround="true" :pauseAutoplayOnHover="true">
      <slide v-if="mobileView" v-for="(image, index) in mobileImages" :key="image.id">
          <img :src="image.url"/>
      </slide>
      <slide v-else v-for="(image, index) in images" :key="image.id">
          <img :src="image.url"/>
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
      // true/false
      return mobileView.value = windowWidth.value < 768
    }

    const mobileImages = [
        { id: 1, url: "/images/header_mobile.png" },
        { id: 2, url: "/images/header_mobile.png" },
        { id: 3, url: "/images/header_mobile.png" },
        { id: 4, url: "/images/header_mobile.png" },
    ];

    const images = [
        { id: 1, url: "/images/header.png" },
        { id: 2, url: "/images/header.png" },
        { id: 3, url: "/images/header.png" },
        { id: 4, url: "/images/header.png" },
    ];

    onMounted(() => {
      window.addEventListener('resize', calculateWindowWidth)
    })

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