<template>
    <DashboardLayout>
        <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
            <div class="px-4 sm:px-0">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Adaugă o categorie nouă</h2>
                <p class="mt-2 text-sm text-gray-700">Completează câmpurile de mai jos pentru a adăuga o categorie
                    nouă.</p>
            </div>

            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nume
                                categorie</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" autocomplete="given-name" v-model="name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">Alege produsele pentru această
                                categorie</h1>
                            <p class="mt-2 text-sm text-gray-700">Alege produsele pe care le dorești să le adaugi în
                                această categorie.</p>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="relative">
                                    <div v-if="selectedProducts.length > 0"
                                        class="absolute left-14 top-0 flex h-12 items-center space-x-3 bg-white sm:left-12">
                                        <button type="button"
                                            class="inline-flex items-center rounded bg-white px-2 py-1 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">Bulk
                                            edit</button>
                                        <button type="button"
                                            class="inline-flex items-center rounded bg-white px-2 py-1 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">Delete
                                            all</button>
                                    </div>
                                    <table class="min-w-full table-fixed divide-y divide-gray-300">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="relative px-7 sm:w-12 sm:px-6">
                                                    <input type="checkbox"
                                                        class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                        :checked="indeterminate || selectedProducts.length === products.length"
                                                        :indeterminate="indeterminate"
                                                        @change="selectedProducts = $event.target.checked ? products.map((p) => p.name) : []" />
                                                </th>
                                                <th scope="col"
                                                    class="min-w-[12rem] py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Descriere</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Preț</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-for="product in products" :key="product.id"
                                                :class="[selectedProducts.includes(product.name) && 'bg-gray-50']">
                                                <td class="relative px-7 sm:w-12 sm:px-6">
                                                    <div v-if="selectedProducts.includes(product.name)"
                                                        class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div>
                                                    <input type="checkbox"
                                                        class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                        :value="product.name" v-model="selectedProducts" />
                                                </td>
                                                <td
                                                    :class="['whitespace-nowrap py-4 pr-3 text-sm font-medium', selectedProducts.includes(product.name) ? 'text-indigo-600' : 'text-gray-900']">
                                                    {{ product.name }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ product.description }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ product.price }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button @click="createCategory" class=" rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                        focus-visible:outline-indigo-600">Creează</button>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>
import DashboardLayout from '../../../Layouts/DashboardLayout.vue';
import { PhotoIcon, UserCircleIcon } from '@heroicons/vue/24/solid'

export default {
    name: 'Admin/Categories/Create',

    components: { DashboardLayout },

    computed: {
        indeterminate() {
            return this.selectedProducts.length > 0 && this.selectedProducts.length < this.products.length
        },


    },

    props: {
        products: Array,
    },

    data() {
        return {
            // initially selectedProducts has the products that are already in the category
            selectedProducts: [],
            selectedProductsIds: [],
            name: '',
        }
    },

    watch: {
        selectedProducts: {
            handler(newValue) {
                this.selectedProductsIds = newValue.map(name => {
                    const product = this.products.find(p => p.name === name);
                    return product ? product.id : null;
                }).filter(id => id !== null);
            },
            deep: true
        }
    },

    methods: {
        createCategory() {
            this.$inertia.post(route('admin.dashboard.categories.store'), {
                name: this.name,
                products: this.selectedProductsIds
            });
        }
    }
}

</script>