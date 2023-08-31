<script setup>
import { ref, computed } from 'vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import NavLink from '@/Components/NavLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link, usePage } from '@inertiajs/inertia-vue3'
import { useStore } from 'vuex'

const store = useStore()
const showingNavigationDropdown = ref(false)

//computed
const cart = computed(() => store.getters['cart/cartTotalQuantity'])
console.log(cart.value)
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100 sticky top-0 z-40">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">                        
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('Home.index')">
                                <ApplicationLogo class="block h-9 w-auto" />
                            </Link>
                        </div>                       

                        <div class="flex">
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:mr-10 sm:flex">
                                <NavLink :href="route('Home.index')" :active="route().current('Home.index')">
                                    Home
                                </NavLink>
                                <NavLink :href="route('products.index')" :active="route().current('products.index')">
                                    Products
                                </NavLink>
                                <NavLink :href="route('Home.about')" :active="route().current('Home.about')">
                                    About Us
                                </NavLink>
                                <NavLink class="relative" :href="route('cart.index')" :active="route().current('cart.index')">
                                    <span v-if="cart" class="rounded-full bg-red-600 text-white px-2 absolute top-1">{{ cart }}</span>
                                    <i class="bi-cart text-lg"></i>
                                </NavLink>
                            </div>
                            <div v-if=" $page.props.auth.user"  class="hidden sm:flex sm:items-center sm:ml-6">
                                <!-- Settings Dropdown -->
                                <div class="flex items-center relative">
                                    <NavLink class="pb-5 -mb-5" :href="route('myaccount.orders')" :active="route().current('myaccount.orders')">My Orders</NavLink>
                                    <Dropdown align="right" width="48">
            
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                    {{ $page.props.auth.user.name }}

                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink v-if="$page.props.auth.user.is_admin" :href="route('admin.home.index')" as="button">
                                                Adminstrator
                                            </DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                            <div v-else class="hidden sm:flex sm:items-center sm:space-x-4">
                                <Link class="pr-4 mr-2 border-r-2 border-gray-700" :href="route('login')">Login</Link>
                                <Link :href="route('register')">Register</Link>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('Home.index')" :active="route().current('Home.index')">
                            Home
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('products.index')" :active="route().current('products.index')">
                            Products
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('Home.about')" :active="route().current('Home.about')">
                            About
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div v-if=" $page.props.auth.user" class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                    <div v-else class="mt-3 flex space-x-64">
                        <ResponsiveNavLink :href="route('login')" :active="route().current('login')">
                            Login
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('register')" :active="route().current('register')">
                            Register
                        </ResponsiveNavLink>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>
        
            <!-- Page Content -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 mb-10">
                <h2 class="text-center py-2 mt-2 mb-4 font-bold text-xl"><slot name="body-title" /></h2>
                <slot />
            </main>
            <footer class="bg-blue-600 text-white">
                <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4 justify-center max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
                    <h1 class="text-lg font-bold text-center sm:text-left  sm:border-0 sm:col-span-2 md:col-span-1">Online Store</h1>
                    <div class="">
                        <h1 class="text-lg">Quick Links</h1>
                        <div class="flex flex-col px-4">
                            <a href="#">About</a>
                            <a href="#">Contact</a>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-lg" >Contacts</h1>
                        <div class="flex flex-col ml-4">
                            <a href="#"><i class="bi-telephone"></i> +255 22 2112931-4</a>
                            <a href="#"><i class="bi-phone"></i> 0755 671 682</a>
                            <a href="#"><i class="bi-envelope"></i> onlinestore@gmail.com</a>
                            <a href="#"><i class="bi-geo-alt"></i> P.o Box, Songea</a>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-lg" >Social</h1>
                        <div class="flex flex-col ml-4">
                            <a href="#"><i class="bi-github"></i> github</a>
                            <a href="#"><i class="bi-facebook"></i> facebook</a>
                            <a href="#"><i class="bi-twitter"></i> twitter</a>
                            <a href="#"><i class="bi-whatsapp"></i> whatsapp</a>
                            <a href="#"><i class="bi-linkedin"></i> linkedin</a>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-700 py-2 mb-0 text-center">
                    ©2022 onlineStore. All rights reserved
                </div>
            </footer>
        </div>
    </div>
</template>
