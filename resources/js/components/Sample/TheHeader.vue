<template>
    <TheHeader :text="Math.floor(Math.rondom() * 10) % 2 === 0 ? 'even' : 'odd'" />
    <img :src="imgSrc" />
    <button class="{ red: isAttachStayle }"></button>
    <input :value="inputValue" type="text">
</template>

<script>
import TheHeader from './components/therHeader.vue'

export default {
    data() {
        return {
            isAttachStyle: false
            inputValue: 0
        },
    },
    compouted: {
        imgSrc() {
            ........
        }
    }
}
</script>

<style></style>