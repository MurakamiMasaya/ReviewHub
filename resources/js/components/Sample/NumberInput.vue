<template>
    <TheHeader text="My Counter" />
    <div>{{ count }}</div>
    <BaseButton :disabled="hasmaxCount" @onClick="plusOne">+</BaseButton>
    <BaseButton :disabled="hasMinCount" @onClick="minusOne">-</BaseButton>

    <NumberInput v-model.numberOnly="inputCount" max="9999" min="0" />
    <BaseButton @onClick="insertCount">insert</BaseButton>
</template>

<script>
import TheHeader from './components/TheHeader.vue';
import BaseButton from './components/BaseButton.vue';
import NumberInput from './components/NumberInput.vue';

export default {
    components: {
        TheHeader,
        BaseButton,
        NumberInput,
    },
    data() {
        return {
            count: 0,
            inputCount: 0,
        };
    },
    watch: {
        inputCount(value) {
            if(value >= 9999){
                this.inputCount = 9999;
            }
            if(value <= 0){
                this.inputCount = 0;
            }
        },
    },
    computed: {
        //countが9999以上になったらtrueを返すcomputedプロパティ
        hasMaxCount() {
            return this.count >= 9999;
        },
        //countが0以下になったらtrueを返すcomputedプロパティ
        hasMinCount() {
            return this.count <= 0
        }
    },
    methods: {
        plusOne() {
            this.count++;
        },
        minusOne() {
            this.count--;
        },
        insertCount() {
            this.count = this.inputCount;
        },
    },
};
</script>