<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Chirp from '../../Components/Chirp.vue'
import { useForm, Head } from '@inertiajs/inertia-vue3';

const props = defineProps(['user']);
</script>
<template>
    <Head title="About" />
    <AuthenticatedLayout>
        <template #body-title>
            About Online Store
        </template>
        <div class="mb-4 about rounded-lg">
            <div class="text text-white flex flex-col">
                <span class="text-5xl font-bold">Online Store</span>
                <span class="text-2xl">We serve products to all</span>
            </div>
            
        </div>
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-4">
            
            <div class="bg-white shadow-lg p-4 rounded-lg">
                <h2 class="text-center font-bold text-lg ">Vision</h2>
                <div class="flex space-x-2">
                    <i class="text-3xl text-orange-600 font-bold bi-eye"></i>
                    <p class="text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Animi autem at voluptatibus sint hic, maiores in nostrum temporibus neque delectus mollitia laboriosam! Voluptate aut repudiandae fugit quam, dolore beatae aspernatur.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg p-4 rounded-lg">
                <h2 class="text-center font-bold text-lg ">Mission</h2>
                <div class="flex space-x-2">
                    <i class="text-3xl font-bold text-green-600 bi-box-arrow-in-down-right"></i>
                    <p class="text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Animi autem at voluptatibus sint hic, maiores in nostrum temporibus neque delectus mollitia laboriosam! Voluptate aut repudiandae fugit quam, dolore beatae aspernatur.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg p-4 rounded-lg">
                <h2 class="text-center font-bold text-lg ">Mission</h2>
                <div class="flex space-x-2">
                    <i class="text-3xl text-blue-600 font-bold bi-check"></i>
                    <p class="text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Animi autem at voluptatibus sint hic, maiores in nostrum temporibus neque delectus mollitia laboriosam! Voluptate aut repudiandae fugit quam, dolore beatae aspernatur.</p>
                </div>
            </div>
        </div>

       <div>{{ props.user }}</div>
        
    </AuthenticatedLayout>
</template>

<style scoped>
.about{
    background-image: url('/img/online.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    max-width: 100%;
    height: 400px;
    position: relative;
}
</style>