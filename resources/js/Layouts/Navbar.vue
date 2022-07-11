<template>
<div v-if="user">
<BreezeAuthenticatedLayout >

<slot />
</BreezeAuthenticatedLayout>
</div>
<div v-else>
<BreezeGuestLayout>
  <slot />
  </BreezeGuestLayout>
</div>
  
</template>
<script setup>

import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { computed } from 'vue';
 import { usePage } from '@inertiajs/inertia-vue3';
const user = computed(() => usePage().props.value.auth.user)
</script>
