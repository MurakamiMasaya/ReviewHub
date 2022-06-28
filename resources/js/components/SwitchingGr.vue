<template>
    <div v-if="isGrState" @click="pushGr" class="gr">
        <img :src="'/images/gr-red.png'" alt="GR" />
    </div>
    <div v-else @click="pushGr" class="gr">
        <img :src="'/images/gr-gray.png'" alt="GR" />
    </div>
    <div class="count">{{ grs }}</div>

    
    <Modal :open="authModal">
        <p class="modal_message">GRを押すにはログインが必要です。</p>
        <button @click="closeAuthModal" class="close_button">閉じる</button>
    </Modal>

    <Modal :open="mailModal">
        <p class="modal_message">メールアドレスを認証してください。</p>
        <button @click="closeMailModal" class="close_button">閉じる</button>
    </Modal>
</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue'
import axios from 'axios'
import Modal from './Modal.vue'

const props = defineProps<{
    grs: number
    isGr: boolean
    id: number
    path: string
    width: string
    font: string
    auth: boolean
    mail: boolean
}>()

const isGrState = ref<boolean>(false)
const grs = ref<number>(0)
const width = ref<string>('')
const font = ref<string>('')
const marginLeft = ref<string>('')
const authModal = ref<boolean>(false)
const mailModal = ref<boolean>(false)

onMounted(() => {
    isGrState.value = props.isGr
    grs.value = props.grs
    width.value = props.width ?? '25px'
    font.value = props.font ?? '15px'
    marginLeft.value = props.font === '15px' ? '2px' : '5px'
})

const pushGr = async() => {
    if(!props.auth){
        authModal.value = true
        return
    }
    if(!props.mail){
        mailModal.value = true
        return
    }

    grs.value = isGrState.value ? grs.value -1 : grs.value +1
    isGrState.value = !isGrState.value

    //endpoint、urlをlaravelから渡せるように変更
    try{
        if(isGrState.value){
            await axios.post('/' + props.path + '/gr/' + props.id)
        } else {
            await axios.post('/' + props.path + '/gr/delete/' + props.id)   
        }
    } catch(e){
        console.log('データを更新できませんでした')
    }
}

const closeAuthModal = () => {
    authModal.value = false
}
const closeMailModal = () => {
    mailModal.value = false
}


</script>

<style scoped>
.gr {
    width: v-bind(width);
    margin-bottom: 1px;
}
.count {
    font-size: v-bind(font);
    font-weight: 700;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: v-bind(marginLeft);
}
.modal_message {
    font-weight: 700;
    font-size: medium;
    color: rgb(220, 30, 30);
}
.close_button {
    margin-top: 10px;
    float: right;
    font-weight: 700;
    font-size: small;
}

</style>