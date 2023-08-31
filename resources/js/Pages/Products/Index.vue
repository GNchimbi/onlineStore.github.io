<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Message from '@/Components/Message.vue';
import { Head, Link } from '@inertiajs/inertia-vue3'
import { onMounted, ref, watch, computed } from 'vue'
import { useStore } from 'vuex'



//properties
const products = ref({})
const search = ref("")
const responseStatus = ref("")
const store = useStore()



//Normal methods
async function getProducts(query){
    const response = await fetch(route('products', query))
    responseStatus.value = response.ok
    const data = await response.json()
    products.value = data
}

//computed properties
const data = computed(() => store.state.products.all)
const discount = store.getters.discount
store.dispatch('getAllProducts')



//life cycle hook methods
onMounted(() => {
    getProducts(search.value)
})

watch(search, () => {
    responseStatus.value = ""
    getProducts(search.value)
})

</script>
<template>
    <Head title="Products"></Head>
    <AuthenticatedLayout>
        <template #body-title>
            Our Products
        </template>
        <input type="text" v-model="search" placeholder="search any product..." class="rounded">
        <div v-if="products.length" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div v-for="product in products" :key="product.id" class="card">
                <img :src="'/storage/'+product.image" class="h-40 w-full" alt="">
                <p class="px-4 py-2 font-bold">{{ product.name }}</p>
                <div class="flex px-4 justify-between items-center">
                    <p>${{product.price}}</p>
                    <div class="flex space-x-2 items-center">
                        <Link class=" bg-blue-500 px-4 py-1 text-white rounded-md" :href="route('products.show', product.id)"><i class="bi-cart"></i>Add to Cart</Link>
                        <Link :href="route('products.show', product.id)">Details>></Link>
                    </div>
                </div>
            </div>
        </div>
        <Message v-else-if="responseStatus === true || responseStatus === false" :color="'orange'" class="mt-2">
            Sorry!, Product(s) Not Found
        </Message>
        <div v-else class="mt-2">
            <p>Searching...</p>
        </div>          
        
    </AuthenticatedLayout>
</template>