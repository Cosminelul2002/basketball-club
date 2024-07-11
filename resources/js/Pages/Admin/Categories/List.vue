<template>
    <DashboardLayout>
        <template>
            <div v-if="$page.props.errors">
                <p>{{ $page.props.errors.message }}</p>
            </div>
        </template>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Categorii</h1>
                    <p class="mt-2 text-sm text-gray-700">Lista categorii.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route('admin.dashboard.categories.create')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                        categorie</inertia-link>
                </div>
            </div>

            <!-- Filter section -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Filter by name -->
                <div>
                    <Filter :filter="nameFilter" :value="filters.name" :onUpdateValue="updateNameFilter" />
                </div>
                <!-- Filter by number of products -->
                <div>
                    <Filter :filter="productsFilter" :value="filters.products" :onUpdateValue="updateProductsFilter" />
                </div>
            </div>

            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Nume</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Produse</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="category in filteredCategories" :key="category.id">
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ category.name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                        category.products.length }}
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <inertia-link :href="route('admin.dashboard.categories.show', category)"
                                                class="text-green-600 hover:text-green-300">Editează / <span
                                                    class="sr-only">, {{
                        category.name }}</span></inertia-link>
                                            <inertia-link
                                                :href="route('admin.dashboard.categories.add-products', category)"
                                                class="text-indigo-600 hover:text-indigo-900">Produse / <span
                                                    class="sr-only">, {{
                        category.name }}</span></inertia-link>
                                            <button @click="deleteCategory(category)"
                                                class="text-red-600 hover:text-red-300">Șterge<span class="sr-only">,
                                                    {{
                                                    category.name }}</span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>
import DashboardLayout from '../../../Layouts/DashboardLayout.vue';
import Filter from '../../../Components/Filter.vue';

export default {
    name: 'Admin/Categories/List',

    components: { DashboardLayout, Filter },

    computed: {
        filteredCategories() {
            const { name, products } = this.filters;
            const arrayProductsRange = products.split(',');
            return this.categories.filter(category => {
                return (!name || category.name.toLowerCase().includes(name.toLowerCase())) &&
                    (!products || (category.products.length >= parseInt(arrayProductsRange[0]) && category.products.length <= parseInt(arrayProductsRange[1])));
            });
        },

        nameFilter() {
            return {
                id: 'name',
                label: 'Filtru după nume',
                type: 'text'
            }
        },

        productsFilter() {
            return {
                id: 'products',
                label: 'Filtru după numărul de produse',
                type: 'products',
            }
        },
    },

    props: {
        categories: Array
    },

    data() {
        return {
            filters: {
                name: '',
                products: '',
            }
        }
    },

    methods: {
        deleteCategory(category) {
            this.$inertia.delete(route('admin.dashboard.categories.destroy', category));
        },

        updateNameFilter(value) {
            this.filters.name = value;
        },

        updateProductsFilter(value) {
            this.filters.products = value;
        }
    }

}
</script>