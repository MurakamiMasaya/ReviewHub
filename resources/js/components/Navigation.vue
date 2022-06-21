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
    color: rgb(48, 48, 48);
    font-weight: bold;
    font-size: 20px;
    margin: 10px 0;
}
</style>