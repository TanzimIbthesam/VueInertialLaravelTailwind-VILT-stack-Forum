<template>
<SuccessMessage />
<div v-for="post in postsref" :key="post.idtwo">

    <div class=" px-24 py-10  bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 space-y-3">
    <Link
    :href="route('post.show',{post:post.slug})"
    >
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{post.title}}</h5>
    </Link>
    <div class="flex">

       <Link

        @click="destroy(post.id)"
    class="bg-red-600 text-white px-4 py-1 rounded-md"


    >Delete</Link>





       <Link

       :href="route('post.edit',{post:post.slug})"
    class="bg-green-600 text-white px-4 py-1 rounded-md"


    >Edit</Link>

    </div>





    </div>
</div>



</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import SuccessMessage from '@/Components/SuccessMessage.vue';
import { onMounted,ref } from 'vue';
const postsref=ref([]);

onMounted(()=>{
    axios.get('authuserposts').then(res=>{
         postsref.value=res.data
    })
})
const destroy=(id)=>{

    Inertia.delete(route("post.destroy",id));
   let i=postsref.value.map(data=>data.id).indexOf(id)
   postsref.value.splice(i,1)


}
</script>
