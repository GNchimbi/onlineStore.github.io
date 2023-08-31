<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import { Link} from '@inertiajs/inertia-vue3';
import Modal from '@/Components/Modal.vue';
import Message from '@/Components/Message.vue';
import { onMounted, ref, computed } from 'vue';

const props = defineProps(['products'])
console.log(props.products);

//fields
const showModal = ref(true)
const search = ref('')


//life cycle hook methods
onMounted(() => {
    setTimeout(() => {
        showModal.value = false
    }, 3000)
})

//computed properties




</script>
<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-lg font-semibold"><i class="bi-speedometer2 text-2xl"></i> Admin Dashboard</h1>
        </template>
        <template #title>
            <p>Manage Products</p>
        </template>
        <div class="flex justify-between items-center mb-6">
            <input type="text" v-model="search" class="rounded px-2 h-6 py-3 " placeholder="search any product...">
            <Link :href="route('admin.products.create')" as="button" type="button" class="text-green-700 rounded-md border-2 border-green-700 px-2 hover:bg-green-700 hover:text-white"><i class="bi-plus-circle"></i> Add Product</Link>
        </div>
        <table v-if="props.products.data.length" class="border border-collapse min-w-full border-slate-900">
            <thead>
                <th class="border border-slate-700 py-2 px-6">ID</th>
                <th class="border border-slate-700 py-2 px-6">Name</th>
                <th class="border border-slate-700 py-2 px-6">Edit</th>
                <th class="border border-slate-700 py-2 px-6">Delete</th>
            </thead>
            <tbody v-for="product in props.products.data">
                <tr class="text-center">
                    <td class="border border-slate-400 py-2 px-6">{{ product.id }}</td> 
                    <td class="border border-slate-400 py-2 px-6">{{ product.name }}</td> 
                    <td class="border border-slate-400 py-2 px-6"><Link :href="route('admin.products.edit',  product.id)" class="btn bg-blue-600"><i class="bi-pencil-square"></i></Link></td> 
                    <td class="border border-slate-400 py-2 px-6"><Link :href="route('admin.products.destroy', product.id)" method="delete" class="btn bg-red-600 "><i class="bi-trash"></i></Link></td> 
                </tr>
            </tbody>
        </table>
        <Message v-else :color="'orange'">
            Product Not Found
        </Message>
        <div v-for="link in props.products.links" class="inline-flex">
            <div v-if="link.url === null" class="px-4 py-1 mt-1 mr-1 text-sm leading-4 text-gray-400 border rounded" v-html="link.label"></div>
            <Link v-else :href="link.url" v-html="link.label" :class="{'text-red-600 border border-red-600': link.active}" class="inline-flex px-4 py-1 mt-6 mr-1 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"></Link>
        </div>
        
        <Modal v-if="$page.props.flash.message" :showModal="showModal" :color="'green'">
            <template #title>
                Product status
            </template>
            <template #content>
                {{ $page.props.flash.message }}
            </template>
        </Modal>
    </AdminLayout>
</template>