<template>
<Header />
<div class="flex justify-center xl:mt-16 mt-48  ">
    <div class="mb-3 xl:w-96 w-48 ">
         <select v-model="categoryvalue" class="options">
      <option selected>Select a categoryyyy</option>
 <option v-for="category in categories" :key="category.id">
 {{category.name}}
 </option>
    </select>
    </div>
<SuccessMessage />

</div>
<div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="min-w-full">
          <thead class="border-b">
            <tr>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2 text-left">
                Sl no
              </th>



            </tr>
          </thead>
          <tbody>
            <div :class="[categoryvalue ? 'none' : 'display']" v-for="post in posts.data" :key="post.index">
            <tr class="border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{post.id}}</td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                 <Link  :href="route('post.show',{post:post.slug})" >{{post.title}}</Link>
              </td>
              <td>
                 <Link
        v-if="user.role_id===1"
        @click="destroy(post.id)"
    class="bg-red-600 text-white px-4 py-1 rounded-md"


    >Delete</Link>
              </td>

            </tr>
            </div>
            <div v-if="categoryvalue" v-for="post in filteredposts" :key="post.index">
            <tr class="border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{post.id}}</td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <Link  :href="route('post.show',{post:post.slug})">{{post.title}}</Link>

              </td>
               <td>
                 <Link
               v-if="user.role_id===1"
               @click="destroy(post.id)"
               class="bg-red-600 text-white px-4 py-1 rounded-md">Delete</Link>
              </td>
             <td>

             </td>
            </tr>
            </div>

            <tr class="bg-white border-b">


            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<Link
v-for="link in posts.links"
:href="link.url"
v-html="link.label"
/>



</template>
<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Link, usePage } from '@inertiajs/inertia-vue3';


import { computed } from '@vue/reactivity';
import {ref} from 'vue';
import Header from './header.vue';
import SuccessMessage from '@/Components/SuccessMessage.vue';

const props=defineProps({
     categories:{
        type:Object
     },
     posts:{
        type:Object
     }
});
const user = computed(() => usePage().props.value.auth.user)
const categoryvalue=ref('');
const filteredposts=computed(()=>{
    //    return props.categories.filter(item=>item.name==='VueJS')
    return props.posts.data.filter(item=>item.category.name===categoryvalue.value);

})
const destroy=(id)=>{

    Inertia.delete(route("post.destroy",id));
}
</script>
<style>
.display{
    display:block;
}
.none{
    display:none;
}
</style>
