<template>
  

  <div class="max-w-sm rounded overflow-hidden shadow-lg">
 <div class="font-bold text-xl mb-2">Name-{{user.name}}</div>
 <div v-for="post in userPosts.posts" :key="post.index">

  <div class="px-6 py-4 mb-4" >
    <div class="font-bold text-xl ">
       
        <Link :href="route('post.show',{post:post.slug})">
         <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white cursor-pointer">
             {{post.title}}</h5>
        </Link>
       
 
        
    
  </div>
  
</div>
</div>
</div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
defineProps({
    user:{
        type:Object
    },
    userPosts:{
        type:Object
    },
    
    post:{
        type:Object
    }

})
</script>

<style>
</style>