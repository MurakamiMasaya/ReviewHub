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
        { id: 1, src: "/images/ad/cdc_bn_3syu_seminar.png", url: "http://type.jp/s/fair/e/?waad=zyjfTRw5"},
        { id: 2, src: "/images/ad/cdc_bn_3syu_seminar.png", url: "http://type.jp/s/fair/e/?waad=zyjfTRw5"},
    ];
      
    const images = [
        { id: 1, src: "/images/ad/cdc_bn_3syu_store.png", url: "http://type.jp/s/fair/e/?waad=qEZ9m9iZ"},
        { id: 2, src: "/images/ad/cdc_bn_3syu_pre.png", url: "http://type.jp/s/fair/e/?waad=vAnj5OEB"},
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