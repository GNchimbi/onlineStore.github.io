<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps(['products'])
</script>
<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-lg font-semibold"><i class="bi-speedometer2 text-2xl"></i> Admin Dashboard</h1>
        </template>
        <template #title>
            Adminstrator Privaleges
        </template>
        <div class="grid grid-cols-2 gap-4 ">
            <div class="pb-4  bg-white shadow-lg rounded-md overflow-hidden">
                <h1 class="py-2 font-semibold border-b border-gray-400 text-center bg-gray-300">Editing and Deleting Product</h1>
                <p class="mt-2 px-2">For editing and deleting any product, click products link above</p>
            </div>
            <div class="pb-4  bg-white shadow-lg rounded-md overflow-hidden">
                <h1 class="py-2 font-semibold border-b border-gray-400 text-center bg-gray-300">Listing and completing orders</h1>
                <p class="mt-2 px-2">For listing and completing any order, click orders link above</p>
            </div>
        </div>
    </AdminLayout>
</template>