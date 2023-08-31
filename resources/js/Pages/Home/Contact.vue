<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Chirp from '../../Components/Chirp.vue'
import { useForm, Head } from '@inertiajs/inertia-vue3';

const props = defineProps(['user']);
const form = useForm({
    email: props.user?.email,
    subject: "",
    message: "",
})
</script>
<template>
    <Head title="Contact Us" />
    <AuthenticatedLayout>
        <template #body-title>
            Contact Us
        </template>
        <div class="rounded-md overflow-hidden border border-gray-400 max-w-2xl mx-auto">
            <h1 class="border-b border-gray-400 bg-transparent py-4 px-4">Leave Us A Message</h1>
            <form class="px-2 py-2 bg-white space-y-4" @submit.prevent="form.post(route('contact.store'))">
                <div class="grid sm:grid-cols-[100px_minmax(300px,_1fr)] sm:gap-6">
                    <label class="inline-block w-20">Email: </label>
                    <input type="text" class="rounded-md max-w-full" v-model="form.email">
                    <p v-if="form.errors.email" class="col-span-2 ml-32 text-red-600">{{ form.errors.email }}</p>
                </div>
                <div class="grid sm:grid-cols-[100px_minmax(250px,_1fr)] sm:gap-6">
                    <label class="inline-block w-20">Subject: </label>
                    <input type="text" class="rounded-md" v-model="form.subject">
                    <p v-if="form.errors.subject" class="col-span-2 ml-32 text-red-600">{{ form.errors.subject }}</p>
                </div>
                <div class="grid sm:grid-cols-[100px_minmax(250px,_1fr)] sm:gap-6">
                    <label class="inline-block w-20">Message: </label>

                    <textarea v-model="form.message" placeholder="Your Message..." cols="30" rows="3"></textarea>
                    <p v-if="form.errors.message" class="col-span-2 ml-32 text-red-600">{{ form.errors.message }}</p>
                </div>
                <div class="text-right">
                    <input type="submit" value="Submit" class="bg-blue-600 text-white py-2 px-4 rounded-md">
                </div>
            </form>
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