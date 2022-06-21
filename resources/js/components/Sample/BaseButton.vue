<template>
    <button @click="handleClick"><slot /></button>
</template>

<script>
export default {
    name: 'BaseButton',
    methods: {
        handleClick() {
            alert('Hello World!!');
            this.$emit('onClick');
        }
    }
}
</script>