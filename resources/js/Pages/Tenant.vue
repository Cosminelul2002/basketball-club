<template>

    <div class="bg-white shadow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6 md:justify-start md:space-x-10">
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <a href="/" class="flex items-center">
                        <img class="h-8 w-auto
                        sm:h-10" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                            alt="Company logo">
                    </a>
                </div>
                <div class="-mr-2 -my-2 md:hidden">
                    <button @click="mobileMenuOpen = true" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-700">
                        <span class="sr-only">Open main menu</span>
                    </button>
                </div>
                <nav class="hidden md:flex space-x-10">
                    <a v-for="item in navigation" :key="item.name" :href="item.href"
                        class="text-base font-medium text-gray-500 hover:text-gray-900">
                        {{ item.name }}
                    </a>
                </nav>
                <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                    <template v-if="!loggedIn">
                        <inertia-link :href="route('tenant.auth.register')"
                            class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                            Fă-ți un cont
                        </inertia-link>
                        <inertia-link :href="route('tenant.auth.login')"
                            class="whitespace-nowrap ml-8 text-base font-medium text-gray-500 hover:text-gray-900">
                            Intră în cont
                        </inertia-link>
                        <inertia-link :href="route('auth.logout')"
                            class="whitespace-nowrap ml-8 text-base font-medium text-gray-500 hover:text-gray-900">
                            Decontează-te de la servicii
                        </inertia-link>
                    </template>
                    <template v-else>
                        <inertia-link :href="route('tenant.' + this.$page.props.user.role[0].key + '.dashboard')"
                            class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                            Dashboard
                        </inertia-link>
                        <inertia-link :href="route('tenant.auth.logout')"
                            class="whitespace-nowrap ml-8 text-base font-medium text-gray-500 hover:text-gray-900">
                            Deconectare
                        </inertia-link>
                    </template>
                </div>
            </div>
        </div>
    </div>
    <Dialog as="div" class="fixed inset-0 z-50" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
        <DialogPanel class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
            <div class="bg-white px-4 py-2 flex justify-between items-center">
                <div>
                    <img class="h-8 w-auto
                    sm:h-10" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Company logo">
                </div>
                <div class="-mr-2">
                    <button @click="mobileMenuOpen = false" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-700">
                        <span class="sr-only">Close main menu</span>
                        <XIcon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
            </div>
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a v-for="item in navigation" :key="item.name" :href="item.href"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                    {{ item.name }}
                </a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items
                -center justify-between px-5">
                    <inertia-link :href="route('tenant.auth.register')"
                        class="text-base font-medium text-indigo-600 hover:text-indigo-900">
                        Fă-ți un cont
                    </inertia-link>
                    <inertia-link :href="route('tenant.auth.login')"
                        class="text-base font-medium text-indigo-600 hover:text-indigo-900">
                        Intră în cont
                    </inertia-link>
                </div>
            </div>
        </DialogPanel>
    </Dialog>
</template>

<script>


export default {
    components: {
        Dialog,
        DialogPanel,
    },

    beforeMount() {
        this.loggedIn = this.isLoggedIn()
    },

    data() {
        return {
            mobileMenuOpen: false,
            loggedIn: false,
        };
    },
};

</script>

<script setup>

import { Dialog, DialogPanel } from '@headlessui/vue';
</script>