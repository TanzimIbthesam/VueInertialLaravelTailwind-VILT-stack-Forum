<template>
<Navbar />

  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
		<div class="max-w-md w-full space-y-8">
			<div>
				<img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
				<h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
					Sign up
				</h2>
				
			</div>
			<form v-if="post.user_id===user.id" @submit.prevent="handleSubmit"  class="mt-8 space-y-6" >
				
				<div class="rounded-md shadow-sm space-y-2">
                   
					<div>
						<label  class="sr-only">Title</label>
						<input  v-model="form.title" type="text"   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Title">
                         <div v-if="form.errors.title">{{ form.errors.title}}</div>

					</div>
					<div>
						<label  class="sr-only">Description</label>
						<input  v-model="form.description" type="text"  class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Description">
                         <div v-if="form.errors.description">{{ form.errors.description }}</div>
					</div>
                    <div>
						<label  class="sr-only">File Upload</label>
						<input   type="file" @input="form.image = $event.target.files[0]" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Description">
                         <div v-if="form.errors.image">{{ form.errors.image }}</div>
					</div>
					<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select an option</label>
                <select 
                class="bg-gray-50 border border-gray-300 
                text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 
                dark:border-gray-600 dark:placeholder-gray-400 dark:text-whit
                e dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.category_id">
                <option selected>Choose your category</option>
                <option  v-for="category in categories" 
                :key="category.id" :value="category.id">{{category.name}}</option>>
                
               </select>
				</div>

				<!--  -->

				<div>
					<button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
						<span class="absolute left-0 inset-y-0 flex items-center pl-3">
							<!-- Heroicon name: solid/lock-closed -->
							<svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="True">
								<path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
							</svg>
						</span>
						Save
					</button>
				</div>
			</form>
		</div>
	</div>
	
</template>

<script setup>

import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { onMounted,computed,ref } from "vue";
import Navbar from '@/Layouts/Navbar.vue'
// const user = ref(computed(() => usePage().props.value.auth.user))
// onMounted(()=>{
//   console.log("Hello",user.value.id);
// })
const props=defineProps({
   
       post:{
           type:Object
       },
	   categories:{
		type:Object
	   }
   
})
const user = computed(() => usePage().props.value.auth.user)
let form=useForm({
    title:props.post.title,
    description:props.post.description,
    image:props.post.image,
    id:props.post.id,
	category_id:props.post.category_id
  
})
const handleSubmit=()=>{
    //  Inertia.post('/users', form);
    //Much cleaner way 
    // form.post(route('posts.store'),form);
    form.put(route('post.update',form.id));
   
}
</script>


