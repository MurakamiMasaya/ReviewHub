<template>
    <transition name="sun">
        <div @mouseover="emphasisImage" @mouseleave="initialImage" class="w-64 relative mx-auto" :class="{ animate: mouseover }">
            <img id="sun-image" :src="'/images/sun.png'">
            <!-- <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                text-5xl font-bold text-red-800">{{ totalGrs }}</div> -->
            <div class="object">{{ totalGrs }}</div>
        </div>
    </transition>
</template>

<script setup lang="ts">
import { ref } from 'vue'

type Props = {
    totalGrs: number
}
defineProps<Props>()

const mouseover = ref<boolean>(false)
const emphasisImage = () => {
    console.log('over')
    mouseover.value = true
}
const initialImage = () => {
    console.log('leave')
    mouseover.value = false
}

</script>

<style scoped>
#sun-image {
    animation: rotate-anime 10s linear infinite;
}
.object {
    position: absolute;
    font-size: 50px;
    font-weight: 800;
    color: brown;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
}
@keyframes rotate-anime {
    0% {
    transform: rotate(0);
    }
    100% {
    transform: rotate(360deg);
    }
}
.animate {
    animation: scale 0.3s ease-out forwards;
}
@keyframes scale {
    from {
        transform: scale(1);
    }
    to {
        transform: scale(1.5);
    }
    
}
</style>