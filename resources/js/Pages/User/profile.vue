<template>
<div>
    <Navbar />

    <div class=" flex justify-center items-center space-x-3 mt-6">

        <div class="border rounded-md border-gray-400 px-12 py-1 cursor-pointer" @click="changeActiveTabPosts">My Posts</div>
        <div>|</div>
        <div class="border rounded-md border-gray-400 px-12 py-1 cursor-pointer"
        @click="changeActiveTabProfile"
        >My Profile Info</div>

    </div>
<div class="flex flex-col justify-center items-center mt-6 w-full">
<div v-if="ifActiveTabPost">
         <Authuserposts />
         </div>
       <div v-if="ifActiveTabUserInfo">
       <Authuserinfo />
       </div>
</div>



</div>
</template>
<script setup>
import { ref } from 'vue';
import Authuserposts from './authuserposts.vue';
import Authuserinfo from './authuserinfo.vue';
import { computed } from '@vue/reactivity';
import Navbar from '@/Layouts/Navbar.vue';
import Show from '../Category/show.vue';


const activeTab=ref('Authuserposts');
const hello=ref('hello')

const changeActiveTabPosts=()=>{

   return activeTab.value='Authuserposts'
}
const changeActiveTabProfile=()=>{
   return activeTab.value='Authuserinfo'
}
const ifActiveTabPost=computed(()=>{
   return activeTab.value==='Authuserposts'
})
const ifActiveTabUserInfo=computed(()=>{
   return activeTab.value==='Authuserinfo'
})
const defaultTab=computed(()=>{
   return activeTab.value==='Authuserinfo'
})
</script>
