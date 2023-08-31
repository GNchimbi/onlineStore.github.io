<script setup> 
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import { Head,Link } from '@inertiajs/inertia-vue3';
import { ref, onMounted} from 'vue';
import Message from '@/Components/Message.vue';

defineProps(['orders'])




</script>
<template>
    <AuthenticatedLayout>
        <Head title="My Orders" />
        <template #header>
            <h1 class="text-lg font-semibold"><i class="bi-speedometer2 text-2xl"></i> Admin Dashboard</h1>
        </template>
        <template #body-title>
            My Orders in Online Store
        </template>
        <div v-if="orders.orders.length" class="space-y-8">
            <div class="pb-6 shadow-lg bg-white rounded" v-for="order in orders.orders">
                <h1 class="py-4 border-b-2 border-gray-400 px-2 space-x-2"><span class="border-r-2 border-gray-300 px-2 ">Order number: {{ order.id }}</span> <span>Order Date: {{ new Date(order.created_at).toLocaleString()}}</span></h1>
                <div class="py-6 px-4">
                    <div v-for="item in order.items" class="grid grid-cols-5  gap-2 border-b border-gray-300 py-6">
                        <img :src="'/storage/'+item.image" alt="">
                        <h1 class="font-semibold text-xl">{{ item.name }}</h1>
                        <p>${{item.price }}</p>
                        <p>{{ item.quantity }}</p>
                        <p>${{ item.quantity * item.price }}</p>
                    </div>
                    <div class="flex space-x-2 mt-4 justify-end items-center">
                        <p class="border border-gray-300 p-2 rounded">Total pay: <span class="px-2">{{ order.total }}</span></p>
                        <Link href="#" class="btn bg-red-600"><i class="bi-x-square"></i> Cancel</Link>
                    </div> 
                </div>
            </div>
        </div>
        <div v-else>
            <Message :color="'orange'">
                Seems to be that you have not purchased anything in our store =(.
            </Message>
            <div class="mt-6 max-w-xl mx-auto text-center space-y-2">
                <p>Ready to Go ?: It`s Pretty Easier</p>
                <p>Just choose product to purchase, add to cart and do a purchase</p>
                <div class="flex items-center space-x-4 justify-center">
                    <p>Go:</p>
                    <Link :href="route('products.index')" class="btn bg-blue-600">Choose a Product</Link>
                </div>
            </div>
        </div>
        
        <Modal v-if="$page.props.flash.message" :color="'green'" :showModal="showModal">
            <template #title>
                Purchase status
            </template>
            <template #content>
                {{ $page.props.flash.message }}
            </template>
        </Modal>
        
    </AuthenticatedLayout>
</template>