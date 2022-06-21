<template>
    <TheHeader text="My Counter" />
    <!-- <div>{{ count }}</div> -->
    <!-- v-ifの新しい使い方、配列や変数にエラーが入っていなかったら本来の表示を行う -->
    <div v-if="!validationMessageList.length">{{ count }}</div>
    <!-- v-elseからのv-forでmessageを一つずつ取り出す。:keyは一意であれば何でも良い -->
    <div v-else v-for="message in validationMessageList" :key="message">
        {{ message }}
    </div>
    <BaseButton @onClick="alertOnClick"></BaseButton>

    <input v-model="inputCount" type="number" />
    <BaseButton @onClick="insertCount">insert</BaseButton>
</template>

<script>
import TheHeader from './compnents/TherHeader.vue';
import BaseButton from './components/Basebutton.vue';

export default {
    comoponents: {
        TheHeader,
        BaseButton,
    },
    data() {
        return {
            count: 0,
            inputCount: 0,
        };
    },
    watch: {
        inputCount() {
            if(value >= 9999){
                this.inputCount = 9999;
            }
            if(value <= 0){
                this.inputCount = 0;
            }
            this.isEditing = true;
        },
    },
    computed: {
        hasMaxCount() {
            return this.count >= 9999;
        },
        hasMinCount() {
            return this.count <= 9999;
        },
        hasMaxInputCount() {
            return this.inputCount > 9999;
        },
        hasMinInputCount() {
            return this.inputCount < 0;
        },
        validationMessageList() {
            const validationList = [];
            if(this.isEditing){
                validationList.push('編集中...');
            }

            if(this.hasMaxInputCount){
                validationList.push('9999以上は入力できません');
            }

            if(this.hasMinInputCount){
                validationList.push('0以下は入力できません');
            }

            return validationList;
        }
    }
    methods: {
        alertOnClick() {
            alert(this.count);
        },
        plusOne() {
            this.count++;
        },
        minusOne() {
            this.count--;
        },
        insertCount() {
            if(this.hasMaxInputCount || this.hasMinInputCount) return;
            this.count = this.inputCount;
            this.isEditing = false;
        }
    },
};
</script>