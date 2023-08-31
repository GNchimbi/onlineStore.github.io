<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { useStore } from 'vuex';
import { ref, computed } from 'vue';

defineProps(['product'])

//properties
const store = useStore()
const quantity = ref(1)

//normal methods
const addToCart = (product) => store.dispatch('cart/addItemsToCart', product)

//computed properties
const inCart = computed(() => store.state.cart.items)


</script>
<template>
    <AuthenticatedLayout>
        <template #body-title>
            Add to Cart
        </template>
        <div class="flex space-x-6 border border-gray-500 shadow-lg">
            <img class="h-72" :src="'/storage/'+product.image" alt="">
            <div class="space-y-4">
                <p class="font-bold text-2xl mt-2">{{ product.name}} (${{product.price}})</p>
                <p class="">{{ product.description}}</p>

                <div class="flex items-center space-x-2">
                    <div class="">
                        <span class="px-2 inline-flex border border-r-0 border-gray-400 py-2 rounded-l">Quantity</span>
                        <input class="focus:border focus:border-blue-500 rounded-r" min="1" type="number" v-model="quantity">
                    </div>
                    <input @click="addToCart({id: product.id, quantity })" type="submit" value="Add to cart" class="bg-blue-600 text-white py-2 px-4 rounded-md">
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>