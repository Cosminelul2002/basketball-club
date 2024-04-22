<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Produse</h1>
                    <p class="mt-2 text-sm text-gray-700">Lista de produse din magazin.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route('admin.dashboard.products.create')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                        produs</inertia-link>
                </div>
            </div>

            <!-- Filter section -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Filter by name -->
                <div>
                    <Filter :filter="nameFilter" :value="filters.name" :onUpdateValue="updateNameFilter" />
                </div>
                <!-- Filter by category -->
                <div>
                    <Filter :filter="categoryFilter" :value="filters.category" :onUpdateValue="updateCategoryFilter" />
                </div>
                <!-- Filter by skill level -->
                <div>
                    <Filter :filter="priceFilter" :value="filters.price" :onUpdateValue="updatePriceFilter" />
                </div>
                <!-- Filter by year from availability -->
                <div>
                    <Filter :filter="availabilityFilter" :value="filters.availability"
                        :onUpdateValue="updateAvailabilityFilter" />
                </div>
            </div>

            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                        Nume</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Categorie</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Pret</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Descriere</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Valabil</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                        <span class="sr-only">Editează</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="product in filteredProducts" :key="product.id">
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                        {{ product.name }}</td>
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                        <template v-if="product.category !== null">
                                            <inertia-link
                                                :href="route('admin.dashboard.categories.show', product.category)">{{
                        product.category.name }}</inertia-link>
                                        </template>
                                        <template v-else>
                                            <span class="text-gray-500">Fără categorie</span>
                                        </template>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.price }}
                                        lei
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.description
                                        }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                        product.availability ?
                            'Da' : 'Nu' }}
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        <inertia-link :href="route('admin.dashboard.products.show', product)"
                                            class="text-indigo-600 hover:text-indigo-900">Editează / <span
                                                class="sr-only">,
                                                {{
                        product.name }}</span></inertia-link>
                                        <button @click="deleteProduct(product)"
                                            class="text-red-600 hover:text-red-400">Șterge<span class="sr-only">, {{
                                                product.name }}</span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Filter from '../../../Components/Filter.vue';


export default {
    name: 'Admin/Products/List',

    components: { AdminLayout, Filter },

    computed: {
        filteredProducts() {
            const { name, category, priceRange, availability } = this.filters;
            const arrayPriceRange = priceRange.split(',');
            return this.products.filter(product => {
                return (!name || product.name.toLowerCase().includes(name.toLowerCase())) &&
                    (!category || product.category.id === parseInt(category)) &&
                    (!priceRange.length || (product.price >= parseFloat(arrayPriceRange[0]) && product.price <= parseFloat(arrayPriceRange[1]))) &&
                    (!availability || product.availability === parseInt(availability));
            });
        },

        nameFilter() {
            return {
                id: 'filter-name',
                label: 'Filtru după nume',
                type: 'text',
            };
        },

        categoryFilter() {
            return {
                id: 'filter-category',
                label: 'Filtru după categorie',
                type: 'select',
                placeholder: 'Selectează o categorie',
                options: this.categories.map(category => ({
                    value: category.id,
                    label: category.name,
                })),
            };
        },

        priceFilter() {
            return {
                id: 'filter-price',
                label: 'Filtru după preț',
                type: 'price',
            };
        },

        availabilityFilter() {
            return {
                id: 'filter-availability',
                label: 'Filtru după disponibilitate',
                placeholder: 'Selectează disponibilitatea',
                type: 'select',
                options: [
                    { value: '1', label: 'Da' },
                    { value: '0', label: 'Nu' },
                ],
            };
        },
    },

    props: {
        products: Array,
        categories: Array,
    },

    data() {
        return {
            filters: {
                name: '',
                category: '',
                priceRange: '',
                availability: '',
            }
        }
    },

    methods: {
        deleteProduct(product) {
            if (confirm('Sunteți sigur că doriți să ștergeți acest produs?')) {
                this.$inertia.delete(route('admin.dashboard.products.destroy', product));
            }
        },

        updateNameFilter(value) {
            this.filters.name = value;
        },

        updateCategoryFilter(value) {
            this.filters.category = value;
        },

        updatePriceFilter(value) {
            this.filters.priceRange = value;
        },

        updateAvailabilityFilter(value) {
            this.filters.availability = value;
        },
    }
}

</script>