<template>
<div>
    <label>Change your name</label><br>
    <form @submit.prevent="handleSubmit">
    Your name-{{user.name}}<br>
<input type="text" v-model="form.name" class="px-6 py-1 border rounded-md mb-2" /><br>
<button class="bg-blue-600 text-white px-6 py-1 text-white font-serif">Save</button>
    </form>


</div>

</template>

<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed } from '@vue/reactivity';

const user = computed(() => usePage().props.value.auth.user)
let form=useForm({
    id:user.id,
    name:user.name
})
const handleSubmit=()=>{

    form.post(route('profile.update'));

}

</script>
