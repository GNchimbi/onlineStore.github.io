<script setup> 
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps(['order'])


</script>
<template>
    <AuthenticatedLayout>
        <div class="pb-6 border border-gray-300 rounded overflow-hidden">
            <h1 class="py-4 bg-gray-400 px-2">Purchase status</h1>
            <div class="text-center text-white">
                <span class="bg-green-600 rounded flex items-center mt-8 max-w-xl mx-auto p-4"><i class="bi-exclamation-circle text-white text-2xl"> </i> <span class="pl-2">Congratulations, purchase completed. Order number is {{order.order['id']}}</span></span>
            </div>
        </div>
    </AuthenticatedLayout>
</template>