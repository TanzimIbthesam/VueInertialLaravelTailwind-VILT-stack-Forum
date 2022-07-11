<script setup>
import BreezeButton from '@/Components/Button.vue';

import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

import Header from './header.vue';
import SuccessMessage from '@/Components/SuccessMessage.vue';
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',

    role_id:'',
    terms:false
});
defineProps({
    'roles':{
        type:Object
    }
})

const submit = () => {
    form.post(route('admin.usersstore'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
    form='';
};
</script>

<template>
<Header />
<SuccessMessage />
<div class="container mx-auto mt-32">


        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="name" value="Name" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
            </div>
            <div class="mt-4">
                <select
                class="bg-gray-50 border border-gray-300
                text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700
                dark:border-gray-600 dark:placeholder-gray-400 dark:text-whit
                e dark:focus:ring-blue-500 dark:focus:border-blue-500"
                v-model="form.role_id"

                >
                <option selected>Choose role</option>
                <option  v-for="role in roles"
                :key="role.id" :value="role.id">{{role.name}}</option>
               ></select>
            </div>
            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </BreezeButton>
            </div>
        </form>

</div>

</template>
