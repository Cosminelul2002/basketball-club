<template>
    <DashboardLayout>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Adaugă produse</h1>
                    <p class="mt-2 text-sm text-gray-700">
                        Adaugă produse la categoria <strong>{{ category.name }}</strong>
                    </p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button @click="addProducts" type="button"
                        class="block rounded-md bg-indigo-600 px-3 py-1.5 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Salvează produsele
                    </button>
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
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Descriere</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Preț</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Categorie</th>
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
                                        <template v-if="product.category !== null">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ product.category.name }}
                                            </td>
                                            <!-- <inertia-link
                                                :href="route('admin.dashboard.categories.show', product.category)">{{
                                                    product.category.name }}</inertia-link> -->
                                        </template>
                                        <template v-else>
                                            <td class="whitespace nowrap px-3 py-4 text-sm text-gray-500">
                                                Fără categorie
                                            </td>
                                        </template>

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


export default {
    name: 'Admin/Products/AddProducts',

    components: { DashboardLayout },

    computed: {
        indeterminate() {
            return this.selectedProducts.length > 0 && this.selectedProducts.length < this.products.length
        }
    },

    mounted() {
        this.unselectedProducts = this.products.filter((p) => !this.selectedProducts.includes(p.name))
    },

    props: {
        category: Object,
        products: Array
    },

    data() {
        return {
            // initially selectedProducts has the products that are already in the category
            selectedProducts: this.category.products.map((p) => p.name),
            unselectedProducts: []
        }
    },

    methods: {
        addProducts() {
            this.$inertia.post(route('admin.dashboard.categories.store-products', this.category), {
                products: this.selectedProducts
            });
        }
    }
}

</script>