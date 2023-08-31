<script setup>
import Admin from '@/Layouts/Admin.vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['items'])


function itemsPrice(quantity, price){
    return quantity * price
}
function total(items){
    var sum = 0
    items.forEach((item) => {
        sum += itemsPrice(item.quantity, item.price)
    })
    return sum
}


</script>
<template>
    <Admin>
        <template #header>
            <h1 class="text-lg font-semibold"><i class="bi-speedometer2 text-2xl"></i> Admin Dashboard</h1>
        </template>
        <template #title>
            Order Items
        </template>
        <div v-if="props.items.length" class="p-4 space-y-6 shadow-lg bg-white rounded">
            <div v-for="item in props.items" class="flex border-b border-gray-300 pb-4">
                <img :src="'/storage/'+item.product.image" class="w-80" alt="">
                <div class="px-4">
                    <div class="grid grid-cols-5 gap-4  py-2"> 
                        <h1 class="font-semibold text-xl capitalize">{{ item.product.name }}</h1>
                        <p><span class="font-semibold">Quantity: </span>{{ item.quantity }}</p>
                        <p><span class="font-semibold">Price per Item: </span>{{ item.price }}</p>
                        <p><span class="font-semibold">Total price: </span>{{ itemsPrice(item.quantity, item.price) }}</p>
                    </div>
                    <p><span class="font-semibold">Description: </span>{{ item.product.description }}</p>
                </div>
            </div>
            <div class="flex space-x-2 mt-4 justify-end items-center">
                <Link :href="route('admin.orders.index')" class="text-blue-600"><i class="bi-arrow-left"></i> Back</Link>
                <p class="border border-gray-300 p-2 rounded">Total payed: <span class="px-2">${{ total(props.items) }}</span></p>
                <Link href="#" class="btn bg-green-600"><i class="bi-check-circle"></i> Complete Order</Link>
            </div> 
        </div>
    </Admin>
</template>