<template>
<div v-cloak class="flex items-center sm:hidden bg-red-500 px-3 z-20 relative">
    <button @click="toggleMenu" class="inline-flex items-center justify-center p-2 text-white">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path v-if="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path v-if="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<teleport to="body">
    <div v-if="open" id="overlay" class="absolute top-0 left-0  h-full w-full z-10"></div>
</teleport>

<transition name="nav">
    <div v-if="open" id="nav" class="absolute top-0 left-0 w-1/2 h-96 rounded-r-lg z-20">
        <div>
            <div class="flex justify-center items-center h-16 pl-3 sm:pl-10">
                <a :href="'/'">
                    <div class="w-36 sm:w-40">
                        <img :src="'/images/logo.png'" />
                    </div>
                </a>
            </div>
            <div class="flex flex-col items-center my-5">
                <Navigation title="企業情報" route="/company/top"></Navigation>
                <Navigation title="スクール情報" route="/school/top"></Navigation>
                <Navigation title="イベント情報" route="/event/top"></Navigation>
                <Navigation title="記事情報" route="/article/top"></Navigation>
                <Navigation title="マイページ" route="/mypage"></Navigation>
            </div>
        </div>
    </div>
</transition>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import Navigation from './Navigation.vue';

const open = ref<boolean>(false)
const toggleMenu = () => {
    open.value = !open.value
}
</script>

<style scoped>
[v-cloak] {
  display: none;
}
.nav-enter-active {
    animation: nav 0.3s ease-out;
}
.nav-leave-active {
    animation: nav 0.3s ease-out reverse;
}
#nav {
    background-color: rgb(250, 206, 206);
}
#overlay {
    background-color: rgb(109, 108, 108);
    opacity: 0.5;
}
@keyframes nav {
    from {
        opacity: 0;
        transform: translateX(-200px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

</style>