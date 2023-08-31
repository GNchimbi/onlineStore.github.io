<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const props = defineProps(['product']);

const form = useForm({
    _method: 'put',
    name: props.product.name,
    description: props.product.description,
    price: props.product.price,
    image: null,
});


    

</script>
<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-lg font-semibold"><i class="bi-speedometer2 text-2xl"></i> Admin Dashboard</h1>
        </template>
        <template #title>
            Edit Product
        </template>
        <div class="rounded-md overflow-hidden border border-gray-400 max-w-2xl mx-auto">
            <h1 class="border-b border-gray-400 bg-transparent py-4 px-4">Edit Product</h1>
            <form class="px-2 py-2 bg-white space-y-4" @submit.prevent="form.post(route('admin.products.update', product.id))">
                <div class="grid sm:grid-cols-[100px_minmax(300px,_1fr)] sm:gap-6">
                    <label class="inline-block w-20">Name: </label>
                    <input type="text" class="rounded-md max-w-full" v-model="form.name">
                    <p v-if="form.errors.name" class="col-span-2 ml-32 text-red-600">{{ form.errors.name }}</p>
                </div>
                <div class="grid sm:grid-cols-[100px_minmax(250px,_1fr)] sm:gap-6">
                    <label class="inline-block w-20">Price: </label>
                    <input type="text" class="rounded-md" v-model="form.price">
                    <p v-if="form.errors.price" class="col-span-2 ml-32 text-red-600">{{ form.errors.price }}</p>
                </div>
                <div class="grid sm:grid-cols-[100px_minmax(250px,_1fr)] sm:gap-6">
                    <label class="inline-block w-20">Image: </label>
                    <input type="file" class="rounded-md" @input="form.image = $event.target.files[0]">
                    <p v-if="form.errors.image" class="col-span-2 ml-32 text-red-600">{{ form.errors.image }}</p>
                </div>
                <div class="grid sm:grid-cols-[100px_minmax(250px,_1fr)] sm:gap-6">
                    <label class="inline-block w-20">Description: </label>
                    <textarea name="" id="" cols="30" rows="10" class="max-h-20" v-model="form.description"></textarea>
                    <p v-if="form.errors.description" class="col-span-2 ml-32 text-red-600">{{ form.errors.description }}</p>
                </div>
                <div class="text-right">
                    <input type="submit" value="Edit" class="bg-blue-600 text-white py-2 px-4 rounded-md">
                </div>
            </form>
        </div>
    </AdminLayout>
</template>