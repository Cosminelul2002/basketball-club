<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8">

            <!-- Section Description -->
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">{{ title }}</h1>
                    <p class="mt-2 text-md text-gray-700">{{ description }}</p>
                </div>

                <!-- Add Entity Button -->
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route(createRoute)"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Adaugă {{ entityName }}
                    </inertia-link>
                </div>
            </div>

            <!-- Filter section -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="filter in filters" :key="filter.id">
                    <Filter :filter="filter" :value="filterValues[filter.model]"
                        @update:value="updateFilter(filter.model, $event)" />
                </div>
            </div>

            <!-- Items table -->
            <div class="mt-8 overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">

                            <!-- Empty state -->
                            <template>
                                <div class="flex flex-col items-center justify-center gap-2 p-6 text-center">
                                    <p class="text-md text-gray-500">
                                        Nu ai adăugat încă niciun {{ entityName }}. Fă clic pe butonul de mai jos pentru
                                        a adăuga primul tău
                                        {{ entityName }}.
                                    </p>
                                    <inertia-link :href="createRoute"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md bg-indigo-600 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Adaugă {{ entityName }}
                                    </inertia-link>
                                </div>
                            </template>

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th v-for="column in columns" :key="column.name" scope="col"
                                            class="px-6 py-3 text-left text-md font-semibold text-gray-900">
                                            {{ column.label }}</th>
                                        <th scope="col"
                                            class="text-center px-6 py-3 text-left text-md font-semibold text-gray-900">
                                            Acțiuni
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="item in items.data" :key="item.id">
                                        <td v-for="column in columns" :key="column.name"
                                            class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                            <span v-if="column.isTemplate">{{ column.template(item) }}</span>
                                            <span v-else>{{ item[column.name] }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-md font-medium">
                                            <inertia-link :href="getEditRoute(item)"
                                                class="text-indigo-600 hover:text-indigo-900">Editează</inertia-link>
                                            <button @click="deleteItem(item)"
                                                class="ml-4 text-red-600 hover:text-red-400">Șterge</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination class="flex justify-center" :links="items.links" />
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../Layouts/AdminLayout.vue';
import Filter from '../Components/Filter.vue';
import Pagination from './Pagination.vue';
import debounce from "lodash/fp/debounce";

export default {
    name: 'GenericList',

    components: { AdminLayout, Filter, Pagination },

    watch: {
        filterValues: {
            handler: debounce(300, function () {
                console.log('debounced');
                this.$inertia.get(route(this.getRoute), {
                    filters: this.filterValues,
                }, {
                    preserveState: true,
                    replace: true,
                });
            }),
            deep: true,
        },
    },

    props: {
        items: Object,
        columns: Array,
        filters: Array,
        prevFilters: Object,
        title: String,
        description: String,
        getRoute: String,
        createRoute: String,
        entityName: String,
        editRouteName: String,
        deleteRouteName: String,
    },
    data() {
        return {
            filterValues: {
                ...this.filters.reduce((acc, filter) => {
                    acc[filter.model] = '';
                    return acc;
                }, {}), ...this.prevFilters
            }
        };
    },
    computed: {
        // filteredItems() {
        //     return this.items.filter(item => {
        //         return this.filters.every(filter => {
        //             const value = this.filterValues[filter.model];
        //             console.log(value);
        //             if (!value) return true;
        //             if (filter.type === 'select') {
        //                 return item[filter.model] === value;
        //             }
        //             console.log(item[filter.model], value);
        //             return item[filter.model].toLowerCase().includes(value.toLowerCase());
        //         });
        //     });
        // },
    },
    methods: {
        getEditRoute(item) {
            return this.route(this.editRouteName, item.id);
        },
        deleteItem(item) {
            if (confirm(`Sunteți sigur că doriți să ștergeți acest ${this.entityName}?`)) {
                this.$inertia.delete(this.route(this.deleteRouteName, item.id));
            }
        },
        updateFilter(model, newValue) {
            this.filterValues[model] = newValue;
        },
    },
};
</script>

<style scoped>
/* Add any custom styles here if necessary */
</style>