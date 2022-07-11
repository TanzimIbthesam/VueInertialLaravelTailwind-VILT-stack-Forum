<template>
  <Header />
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      Update Category
      <form @submit.prevent="handleSubmit" method="post">
       <input type="text" class="border rounded-md px-6 py-2 " v-model="form.name" id=""/>
       <div class="text-red-400" v-if="form.errors.name">{{ form.errors.name }}</div>
       <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
          Submit
         </button>
      </form>
  
 <div class="w-1/4 relative overflow-x-auto shadow-md sm:rounded-lg">
      <div class="bg-white">


   
   <div class="px-6 py-2 text-center mt-2 font-serif border rounded-md">{{category.name}}</div>

  </div>          
           
           
           
            
       
</div>
      
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import Header from '../Admin/header.vue';
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
const props=defineProps({
   
       category:{
           type:Object
       }
   
})
let form=useForm({
    id:props.category.id,
  name:props.category.name
  
})

const handleSubmit=(id)=>{
    //  Inertia.post('/users', form);
    //Much cleaner way 
    // form.post(route('posts.store'),form);
    form.put(route('categories.update',form.id));
   
}

</script>

<style>

</style>