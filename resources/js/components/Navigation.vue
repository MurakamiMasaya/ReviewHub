<script setup lang="ts">

type Props = {
    title: string
    route: string
}

defineProps<Props>()
</script>

<template>
<div id="nav-title">
    <a :href="route">
        {{ title }}
    </a>
</div>
</template>

<style scoped>
#nav-title {
    color: rgb(10, 10, 10);
    font-weight: bold;
    font-size: 17px;
    margin: 15px 0;
}
</style>