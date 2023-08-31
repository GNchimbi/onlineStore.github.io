<script setup>
import Admin from '@/Layouts/Admin.vue';
import { Link } from '@inertiajs/inertia-vue3';

const items = defineProps(['orders'])

function quantity(items){
    var sum = 0
    items.forEach((item) => {
        sum +=item.quantity
    })
    return sum
}


console.log(items.orders)
</script>
<template>
    <Admin>
        <template #header>
            <h1 class="text-lg font-semibold"><i class="bi-speedometer2 text-2xl"></i> Admin Dashboard</h1>
        </template>
        <template #title>
            All Orders
        </template>
        <table class="min-w-full text-left">
            <thead class="border-b border-gray-600 bg-sky-900 text-white">
                <th class="py-2">Order #</th>
                <th class="py-2">Number of Items</th>
                <th class="py-2">Total price</th>
                <th class="py-2">Customer Name</th>
                <th class="py-2">Action</th>
            </thead>
            <tbody v-for="order in items.orders">
                <tr class="border-b border-black">
                    <td class="py-2">{{ order.id }}</td>
                    <td class="py-2">{{ quantity(order.items) }}</td>
                    <td class="py-2">{{ order.total }}</td>
                    <td class="py-2">{{ order.user.name }}</td>
                    <td><Link :href="route('admin.orders.show', order.id)" class="text-blue-600 underline">View Items Ordered</Link></td>
                </tr>
            </tbody>
        </table>
    </Admin>
</template>