<template>
  <Header />
 
  <div>
  <div  class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      
      <form  @submit.prevent="handleSubmit" >
       <input type="text" class="border rounded-md px-6 py-2 " v-model="form.name" id=""/>
       <div class="text-red-400" v-if="form.errors.name">{{ form.errors.name }}</div>
       <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
          Submit
         </button>
      </form>
     
 <div class="w-1/4 relative overflow-x-auto shadow-md sm:rounded-lg">
      <div class="bg-white">

<div class="overflow-x-auto border-x border-t">
    <SuccessMessage />
   <table class="table-auto w-full">
      <thead class="border-b">
         <tr class="bg-gray-100">
          
            <th class="text-left p-4 font-medium">
              Sl no
            </th>
            <th  class="text-left p-4 font-medium">
              Name
            </th>
            <th v-if="userRoleid" class="text-left p-4 font-medium">
              Action
            </th>
         </tr>
      </thead>
      <tbody>
         <tr class="border-b hover:bg-gray-50"
         v-for="category in categories.data"
                 :key="category.id"
         
          >
            <td class="p-4">
               {{category.id}}
            </td>
            <td class="p-4">
                <Link   :href="route('categories.show',{category:category.slug})">
                  
               {{category.name}}
               </Link>
            </td>
            <td class="p-4">
                <div class="flex space-x-2">
                   <Link v-if="userRoleid"
       @click="destroy(category.id)"
        
    class="bg-red-600 text-white px-4 py-1 rounded-md"
    

    >Delete</Link>
                   <Link 
        v-if="userRoleid"
        
    class="bg-blue-600 text-white px-4 py-1 rounded-md"
    :href="route('categories.edit',{category:category.slug})"

    >Edit</Link>
                </div>
               
            </td>
            
           
         </tr>
         
      </tbody>
   </table>
</div>
  </div>          
           
           
           
            
       
</div>
      
  </div>
  </div>
  
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import Header from '../Admin/header.vue';
import { computed } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import SuccessMessage from '@/Components/SuccessMessage.vue';
const user = computed(() => usePage().props.value.auth.user)
const userRoleid=computed(()=>{
   return user.value && user.value.role_id===1;

});
let form=useForm({
  name:''
  
})
defineProps({
    errors:{
        type:Object
    },
    categories:{
        type:Object
    },
    can:{
        type:Object
    }
})
const handleSubmit=()=>{
form.post(route('categories.store'));
}
const destroy=(id)=>{
 Inertia.delete(route("categories.destroy",id));
}
</script>

<style>

</style>