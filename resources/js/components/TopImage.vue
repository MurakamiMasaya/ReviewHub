<template>

<div class="top-0 right-0">
    <a :href="'/event/top'">
        <img class="top-image" :src="'/images/event.png'" alt="トップイメージ">
    </a>
</div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
// const mouseover = ref<boolean>(false)
// const emphasisImage = () => {
//     console.log('マウスが乗りました')
//     mouseover.value = true
// }
// const initialImage = () => {
//     console.log('マウスが外れました')
//     mouseover.value = false
// }
// const height = computed(() => {
//     return mouseover.value ? '300px' : '64px'
// })
</script>

<style scoped>
.top-image {
    /* height: v-bind(height); */
    height: 64px;
}
/* #overlay {
    background-color: rgb(109, 108, 108);
    opacity: 0.5;
}
.emphasisImage {
    transform: scale(1.7);
    transform-origin: 100% -30%;
} */
</style>