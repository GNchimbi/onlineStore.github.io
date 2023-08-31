<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    phpVersion: String,
})

const logged = ref(true)

</script>

<template>
    <Head title="Welcome" />
    
    <AuthenticatedLayout>
        <template #body-title>
            Our Products
        </template>
        <div class="mx-auto md:mx-0 max-w-xl mb-10 p-4 shadow-lg rounded-lg bg-white">
            <p><i class="bi-emoji-sunglasses"></i> Hi! <span v-if="$page.props.auth.user">{{ $page.props.auth.user.name }}</span>,</p>
            <p class="ml-4">Welcome to Our Application</p>
        </div>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div class="col-span-1">
                <img src="/img/game.png" alt="">
            </div>
            <div>
                <img src="/img/safe.png" alt="">
            </div>
            <div>
                <img src="/img/submarine.png" alt="">
            </div>
        </div>
    </AuthenticatedLayout>
</template>
