<template>
    <DashboardLayout>
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">Informații produs</h3>
            <p class="mt-1 max-w-2xl text-md leading-6 text-gray-500">Detalii</p>
            <dd class="flex justify-end mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <span class="ml-4 flex-shrink-0">
                    <template v-if="editing">
                        <button @click="toggleEdit"
                            class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Salvează</button>
                    </template>
                    <template v-else>
                        <button @click="toggleEdit"
                            class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Editează</button>
                    </template>

                </span>
            </dd>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Nume</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <!-- <input v-if="!editing" v-model="player.first_name" class="flex-grow border-none" readonly> -->
                        <span v-if="!editing" class="flex-grow">{{ category.name }}</span>
                        <input v-else v-model="form.editedName" class="flex-grow">
                    </dd>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Produse</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <template v-if="!editing">
                            <ul role="list" class="divide-y divide-gray-100">
                                <li v-for="product in category.products" :key="product.id"
                                    class="flex justify-between gap-x-6 py-5">
                                    <div class="flex min-w-0 gap-x-4">
                                        <!-- <img class="h-12 w-12 flex-none rounded-full bg-gray-50" :src="person.imageUrl" alt="" /> -->
                                        <div class="min-w-0 flex-auto">
                                            <p class="text-sm font-semibold leading-6 text-gray-900">{{ product.name }}</p>
                                            <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ product.description
                                            }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900">{{ person.role }}</p>
                            <p v-if="person.lastSeen" class="mt-1 text-xs leading-5 text-gray-500">
                                Last seen <time :datetime="person.lastSeenDateTime">{{ person.lastSeen }}</time>
                            </p>
                            <div v-else class="mt-1 flex items-center gap-x-1.5">
                                <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                    <div class="h-1.5 w-1.5 rounded-full bg-emerald-500" />
                                </div>
                                <p class="text-xs leading-5 text-gray-500">Online</p>
                            </div>
                        </div> -->
                                </li>
                            </ul>
                        </template>
                        <input v-else v-model="form.editedDescription" class="flex-grow">
                    </dd>
                </div>
            </dl>
        </div>
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="relative z-10" @close="open = false">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                    leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <TransitionChild as="template" enter="ease-out duration-300"
                            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                            leave-from="opacity-100 translate-y-0 sm:scale-100"
                            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel
                                class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                                <div>
                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                                        <CheckIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                                    </div>
                                    <div class="mt-3 text-center sm:mt-5">
                                        <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Salvezi
                                            modificarile ?</DialogTitle>
                                    </div>
                                </div>
                                <div class="flex flex-row gap-5 mt-5 sm:mt-6">
                                    <button
                                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        @click="updateProduct">Da</button>
                                    <button
                                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        @click="cancelUpdate">Nu</button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </DashboardLayout>
</template>

<script>

export default {
    name: 'Admin/Products/Show',

    components: { DashboardLayout },

    props: {
        category: Object,
    },

    data() {
        return {
            editing: false,
            open: false,
            form: {
                editedName: this.category.name,
                // editedDescription: this.product.description,
                // editedPrice: this.product.price,
                // editedAvailability: this.product.availability,
                // editedCategory: this.product.category.name,
            },
            updateCategory: {
                name: '',
            },
        }
    },

    methods: {
        toggleEdit() {
            this.editing = !this.editing;
            if (!this.editing) {
                // Check if any changes were made
                const changesDetected =
                    this.form.editedName !== this.category.name

                if (changesDetected) {
                    // Make a request to update the player
                    this.updateCategory.name = this.form.editedName;

                    this.open = true;
                }
            }
        },

        updateProduct() {
            this.$inertia.put(route('admin.dashboard.categories.update', this.category), this.updateCategory);
            this.open = false;
        },

        cancelUpdate() {
            this.open = false;

            // Reset the form
            this.form.editedName = this.product.name;
        }

    }
}

</script>

<script setup>
import { PaperClipIcon } from '@heroicons/vue/20/solid'
import DashboardLayout from '../../../Layouts/DashboardLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/24/outline'

</script>