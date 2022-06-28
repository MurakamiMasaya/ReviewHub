<template>
    <div v-if="open" class="backdrop"></div>
        <transition name="modal">
            <dialog open v-if="open" class="dialog">
                <slot></slot>
            </dialog>
        </transition>
</template>

<script setup lang="ts">
type Props = {
    open: boolean,
}
defineProps<Props>()

</script>

<style scoped>
.backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: 10;
    background-color: rgba(0, 0, 0, 0.500);
}
.dialog {
    position: fixed;
    top: 50vh;
    width: 70%;
    margin: 0 auto;
    box-shadow: 0 2px 8px rgba(0,0,0,0.25);
    border-radius: 12px;
    padding: 2rem;
    background-color: white;
    z-index: 100;
    border: none;
    max-width: 400px;
}
.modal-enter-active {
    animation: auth 0.3s ease-out;
}
.modal-leave-active {
    animation: auth 0.3s ease-out reverse;
}
@keyframes auth {
    from {
        opacity: 0;
        transform: translateY(-50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}
</style>