<template>

<div v-if="open" class="backdrop"></div>

<div v-cloak class="flex items-center sm:hidden bg-red-500 px-3 relative">
    <button @click="openMenu" class="inline-flex items-center justify-center p-2 text-white">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<transition name="nav">
    <div v-if="open" id="nav" class="absolute top-0 left-0 w-3/4 h-4/6 rounded-r-lg z-20">
        <img @click="closeMenu" class="close_button" :src="'/images/close.png'" alt="閉じるボタン"/>
        <div>
            <div class="flex flex-col items-center my-5">
                <Navigation title="企業情報" route="/company/top"></Navigation>
                <Navigation title="スクール情報" route="/school/top"></Navigation>
                <Navigation title="イベント情報" route="/event/top"></Navigation>
                <Navigation title="記事情報" route="/article/top"></Navigation>
                <Navigation title="マイページ" route="/mypage"></Navigation>
            </div>
        </div>
        <div class="flex justify-center items-center h-16">
            <a :href="'/'">
                <div class="w-36 sm:w-40">
                    <img :src="'/images/logo.png'" />
                </div>
            </a>
        </div>
    </div>
</transition>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import Navigation from './Navigation.vue';

const open = ref<boolean>(false)
const openMenu = () => {
    open.value = true
}
const closeMenu = () => {
    open.value = false
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
    background-color: rgb(241, 241, 241);
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

.backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: 10;
    background-color: rgba(0, 0, 0, 0.500);
}
.close_button {
    margin: 10px 0 0 10px;
    width: 50px;
}

</style>