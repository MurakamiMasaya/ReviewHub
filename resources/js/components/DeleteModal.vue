<template>
     <div class="text-center">
        <button @click="openModal" type="button" class="my-20 px-5 py-3 bg-red-600 text-white rounded-lg font-semibold w-48" :class="{ deleteReview : review }">
            {{ text }}
        </button>
    </div>

    
    <Modal :open="deleteModal" @close-modal="closeModal">
        <p class="modal_message">本当に削除しますか？</p>
        <button @click="onClickDelete" class="close_button">削除</button>
    </Modal>
</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue'
import axios from 'axios'
import Modal from './Modal.vue'

const props = defineProps<{
    text: string
    id: number
    path: string
    admin: boolean
    auth: boolean
    review: boolean
    deleteAcount: boolean
}>()

const deleteModal = ref<boolean>(false)

const onClickDelete = async() => {
    if(!props.auth){
        return
    }

    try{
        if(props.admin){
            await axios.post('/admin/' + props.path + '/delete', {
                id: props.id,
            })
            .then(function(response){
                location.href = '/admin/' + props.path;
            })
        } else {
            if(props.deleteAcount){
                await axios.post('/mypage/profile/delete', {
                    id: props.id
                })
                .then(function(response){
                         location.href = '/';
                })
            } else {
                await axios.post('/' + props.path + '/delete', {
                    id: props.id
                })
                .then(function(response){
                    if(props.review){
                        location.href = '/mypage/review';
                    } else {
                        location.href = '/mypage/' + props.path;
                    }
                })
            }
        }
    } catch(e){
        console.log('データを削除できませんでした')
        return 
    }
}

const openModal = () => {
    deleteModal.value = true
}
const closeModal = () => {
    deleteModal.value = false
}

</script>

<style scoped>
.modal_message {
    font-weight: 700;
    font-size: medium;
    color: rgb(220, 30, 30);
}
.close_button {
    margin-top: 20px;
    float: right;
    font-weight: 700;
    font-size: large;
    color: rgb(255, 255, 255);
    background-color: rgb(220, 30, 30);
    border-radius: 8px;
    width: 100px;
    height: 30px;
}
.deleteReview {
    font-weight: 700;
    font-size: small;
    color: rgb(255, 255, 255);
    background-color: rgb(220, 30, 30);
    padding: 5px 10px;
    margin: 0;
    text-align: left;
    border-radius: 4px;
    width: auto;
}

</style>