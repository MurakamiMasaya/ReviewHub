<template>
    <carousel :items-to-show="1" :autoplay="3000" :transition="3000" :wrapAround="true" :pauseAutoplayOnHover="true" dir="rtl">
        <slide v-if="mobileView" v-for="image in mobileImages" :key="image.id">
            <a :href="image.url" target="_blank" rel="noopener">
                <img :src="image.src"/>
            </a>
        </slide>
        <slide v-else v-for="(image, index) in images" :key="image.id">
            <a :href="image.url" target="_blank" rel="noopener">
                <img :src="image.src"/>
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
        { id: 1, src: "/images/header-mobile.png" },
        { id: 2, src: "/images/header-mobile.png" },
        { id: 3, src: "/images/header-mobile.png" },
        { id: 4, src: "/images/header-mobile.png" },
    ];
      
    const images = [
        { id: 1, src: "/images/header.png" },
        { id: 2, src: "/images/header.png" },
        { id: 3, src: "/images/header.png" },
        { id: 4, src: "/images/header.png" },
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