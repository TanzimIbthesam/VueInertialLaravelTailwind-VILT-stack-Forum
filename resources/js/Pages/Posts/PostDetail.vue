<template>
<Navbar />
  <div class="container mx-auto p-6  bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{post.data.title}}</h5>
    </a>
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{post.data.description}}</p>
    <div v-if="post.data.image">
       <img :src="`http://127.0.0.1:8000/storage/product_images/${post.data.image}`" alt="Girl in a jacket" width="500" height="600">
    </div>
    <Link

       :href="route('user.show',{user: post.data.user.slug})"
       class="text-blue-600 font-serif pointer"


    >
    Postedby-{{post.data.user.name}}
    </Link>
    <Link

       :href="route('categories.show',{category:post.data.category.slug})"
       class="text-blue-600 font-serif pointer"


    >
    Category-{{post.data.category.name}}
    </Link>
      <div v-if="$page.props.flash.message" class="bg-green-600 px-6 py-2 text-white font-serif">
        {{ $page.props.flash.message }}
      </div>
     <div class="text-black font-serif">Comments</div>

     <form v-if="user" @submit.prevent="commentSubmit" method="post">
          <div class="">
  <div class="mb-3 xl:w-96">

    <textarea
      class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
      "
      id="exampleFormControlTextarea1"
      rows="3"
      v-model="form.content"
      placeholder="Your message"
    ></textarea>
     <div class="text-red-400" v-if="form.errors.content">{{ form.errors.content }}</div>
    <input type="hidden" name="" v-model="form.post_id" id="">
    <button class="bg-blue-600 font-serif text-white border rounded-md px-6 py-1">Comment</button>
  </div>
</div>
     </form>

      <div v-for="comment in post.data.comments" :key="comment.id">
       {{comment.content}}
      {{comment.user.name}}
       <div v-if="user">

     <Link
       v-if="comment.user_id===user.id || user.id===post.data.user.id"
        @click="destroy(comment.id)"
    class="bg-red-600 font-serif text-white border rounded-md px-6 py-1">Delete</Link>
       </div>






     </div>
     <div v-if="!user">
     <Link class="text-blue-600 font-serif text-md" :href="route('login')">Login</Link>
     Dont have an account?
     <Link class="text-blue-600 font-serif text-md" :href="route('register')">Register?</Link>
     </div>


</div>

</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link, useForm,usePage } from '@inertiajs/inertia-vue3';

import { Inertia } from '@inertiajs/inertia';
import {ref,computed} from 'vue'
import Navbar from '@/Layouts/Navbar.vue';
let url=ref('http://127.0.0.1:8000/storage/product_images');
const user = computed(() => usePage().props.value.auth.user)
const props=defineProps({
    post:{
        type:Object
    },
    errors:{
        type:Object
    }
})
let form=useForm({
    content:'',
	post_id:props.post.data.id,

})
const commentSubmit=()=>{

     form.post(route('comment.store'));
     form.content='';
}
const destroy=(id)=>{

    Inertia.delete(route("comment.destroy",id));
}
</script>

<style>
</style>
