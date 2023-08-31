<script setup> 
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head,Link } from '@inertiajs/inertia-vue3'
import Message from '@/Components/Message.vue'
import { useStore } from 'vuex'
import {computed} from 'vue'

defineProps(['products'])

const store = useStore()

//computed
const cartProducts = computed(() => store.getters['cart/getProductsInCart'])
const cartTotal = computed(() => store.getters['cart/cartTotal'])



</script>
<template>
    <AuthenticatedLayout>
        <Head title="In Cart" />
        <template #body-title>
            Your Cart
        </template>
        
        <div v-if="cartProducts.length" class=" px-4">
            <table class="mx-auto min-w-full">
                <thead class="border-b bg-gray-800 text-white">
                    <th class="border border-slate-700 py-2 px-6">ID</th>
                    <th class="border border-slate-700 py-2 px-6">Name</th>
                    <th class="border border-slate-700 py-2 px-6">Price</th>
                    <th class="border border-slate-700 py-2 px-6">Quantity</th>
                </thead>
                <tbody v-for="product in cartProducts">
                    <tr class="text-center border-b border-gray-300">
                        <td class="py-2 px-6">{{ product.id }}</td> 
                        <td class="py-2 px-6">{{ product.name }}</td> 
                        <td class="py-2 px-6">${{ product.price }}</td>  
                        <td class="py-2 px-6">{{ product.quantity }}</td>  
                    </tr>
                </tbody>
            </table>
            <div class="flex space-x-2 mt-4 justify-end items-center">
                <p class="border border-gray-300 p-2 rounded">Total pay: <span class="px-2">${{ cartTotal }}</span></p>
                <Link :href="route('cart.purchase')" class="btn bg-green-600"><i class="bi-bag"></i> Purchase</Link>
                <Link :href="route('cart.delete')" class="btn bg-red-600"><i class="bi-trash"></i> Remove all</Link>
            </div>
        </div>
        <div v-else>
            <Message :color="'orange'">
                Sorry!, You have`nt added any product in cart yet
            </Message>
            <div class="mt-8 flex space-x-4 items-center justify-center">
                <p>Ready to add ?:</p>  
                <Link class="btn bg-blue-600" :href="route('products.index')">Choose a Product</Link>              
            </div>
        </div>
        
        
    </AuthenticatedLayout>
</template>