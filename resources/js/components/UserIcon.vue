<template>
    <div v-if="gender === null">
        <img :src="'/images/white-icon.png'" alt="アイコン">
    </div>
    <div v-else-if="gender === 0">
        <img :src="'/images/white-man.png'" alt="男性アイコン">
    </div>
    <div v-else="gender === 1">
        <img :src="'/images/white-woman.png'" alt="女性アイコン">
    </div>
    
</template>

<script setup lang="ts">

type Props = {
    gender: number

}

defineProps<Props>()

</script>