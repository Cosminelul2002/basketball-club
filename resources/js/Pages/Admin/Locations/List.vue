<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8">

            <!-- Locations Section Description -->
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Locații</h1>
                    <p class="mt-2 text-md text-gray-700">Listă locații.</p>
                </div>

                <!-- Add Location Button -->
                <div v-if="filteredLocations.length != 0" class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route('admin.dashboard.locations.create')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                        locație nouă</inertia-link>
                </div>
            </div>

            <!-- Filter section -->
            <div v-if="filteredLocations.length != 0" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Filter by address -->
                <div>
                    <Filter :filter="addressFilter" :value="filters.address" :onUpdateValue="updateAddressFilter" />
                </div>
                <!-- Filter by city -->
                <div>
                    <Filter :filter="cityFilter" :value="filters.city" :onUpdateValue="updateCityFilter" />
                </div>
                <!-- Filter by area -->
                <div>
                    <Filter :filter="areaFilter" :value="filters.area" :onUpdateValue="updateAreaFilter" />
                </div>
            </div>

            <!-- Main Locations Section -->
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">

                            <!-- Locations table  -->
                            <template v-if="filteredLocations.length === 0">
                                <div class="flex flex-col items-center justify-center gap-2 p-6 text-center">
                                    <p class="text-md text-gray-500">
                                        Nu ai adăugat încă nicio locație. Fă clic pe butonul de mai jos pentru a adăuga
                                        prima ta locație și începe să organizezi antrenamentele și evenimentele echipei
                                        tale!
                                    </p>
                                    <inertia-link :href="route('admin.dashboard.locations.create')"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md bg-indigo-600 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Adaugă locație
                                    </inertia-link>
                                </div>
                            </template>

                            <table v-else class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-md font-semibold text-gray-900 sm:pl-6">
                                            Adresă</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                            Sector</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                            Zonă</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Delete</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="location in filteredLocations" :key="location.id">
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-md font-medium text-gray-900 sm:pl-6">
                                            {{ location.address }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{ location.city }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{ location.area }}</td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-md font-medium sm:pr-6">
                                            <inertia-link :href="route('admin.dashboard.locations.show', location)"
                                                class="text-indigo-600 hover:text-indigo-900">Editează<span
                                                    class="sr-only"></span></inertia-link>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-md font-medium sm:pr-6">
                                            <button @click="deleteLocation(location)"
                                                class="text-red-600 hover:text-red-400">Șterge<span
                                                    class="sr-only"></span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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

    name: "Locations/List",

    components: { AdminLayout, Filter },

    computed: {
        filteredLocations() {
            const { address, city, area } = this.filters;
            return this.locations.filter(location => {
                return location.address.toLowerCase().includes(address.toLowerCase()) &&
                    location.city.toLowerCase().includes(city.toLowerCase()) &&
                    location.area.toLowerCase().includes(area.toLowerCase());
            });
        },

        addressFilter() {
            return {
                id: 'address',
                label: 'Adresă',
                type: 'text',
            };
        },

        cityFilter() {
            return {
                id: 'city',
                label: 'Sector',
                type: 'text',
            };
        },

        areaFilter() {
            return {
                id: 'area',
                label: 'Zonă',
                type: 'text',
            };
        }
    },

    props: {
        locations: Array,
    },

    data() {
        return {
            filters: {
                address: '',
                city: '',
                area: '',
            }
        }
    },

    methods: {
        deleteLocation(location) {
            if (confirm('Sunteți sigur că doriți să ștergeți această locație?')) {
                this.$inertia.delete(route('admin.dashboard.locations.destroy', location));
            }
        },

        updateAddressFilter(value) {
            this.filters.address = value;
        },

        updateCityFilter(value) {
            this.filters.city = value;
        },

        updateAreaFilter(value) {
            this.filters.area = value;
        },
    }
}

</script>