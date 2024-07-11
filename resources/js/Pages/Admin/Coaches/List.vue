<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8">

            <!-- Coach Section Description -->
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Antrenori</h1>
                    <p class="mt-2 text-md text-gray-700">Lista antrenori club.</p>
                </div>

                <!-- Add Coach Button -->
                <div v-if="filteredCoaches.length != 0">
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <inertia-link :href="route('admin.dashboard.coaches.create')"
                            class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                            antrenor</inertia-link>
                    </div>
                </div>
            </div>

            <!-- Filter section -->
            <div v-if="filteredCoaches.length != 0" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Filter by name -->
                <div>
                    <Filter :filter="nameFilter" :value="filters.name" :onUpdateValue="updateNameFilter" />
                </div>
            </div>

            <!-- Main Coaches Section -->
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">

                            <!-- Coaches table  -->
                            <template v-if="filteredCoaches.length === 0">
                                <div class="flex flex-col items-center justify-center gap-2 p-6 text-center">
                                    <p class="text-md text-gray-500">
                                        Nu ai adăugat încă niciun antrenor. Fă clic pe butonul de mai jos pentru a
                                        adăuga primul tău antrenor și începe să construiești echipa perfectă!
                                    </p>
                                    <inertia-link :href="route('admin.dashboard.coaches.create')"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md bg-indigo-600 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                                        antrenor</inertia-link>
                                </div>
                            </template>

                            <table v-else class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-md font-semibold text-gray-900 sm:pl-6">
                                            Nume</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                            Prenume</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                            Număr de telefon</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                            Email</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                            Descriere</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Delete</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="coach in filteredCoaches " :key="coach.id">
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-md font-medium text-gray-900 sm:pl-6">
                                            {{ coach.first_name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{
                    coach.last_name
                }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{ coach.phone
                                            }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{ coach.email
                                            }}
                                        </td>
                                        <td class=" px-3 py-4 text-md text-gray-500">{{ coach.description
                                            }}</td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-md font-medium sm:pr-6">
                                            <inertia-link :href="route('admin.dashboard.coaches.show', coach) "
                                                class="text-indigo-600 hover:text-indigo-900">Editează<span
                                                    class="sr-only"></span></inertia-link>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-md font-medium sm:pr-6">
                                            <button @click="deleteCoach(coach)"
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
    name: 'Coaches/List',

    components: { AdminLayout, Filter },

    computed: {
        filteredCoaches() {
            const { name } = this.filters;
            return this.coaches.filter(coach => {
                return (!name || coach.first_name.toLowerCase().includes(name.toLowerCase()));
            });
        },

        nameFilter() {
            return {
                label: 'Filtru după nume',
                type: 'text',
                placeholder: 'Caută după nume',
            }
        },
    },

    props: {
        coaches: Array,
    },

    data() {
        return {
            filters: {
                name: '',
            }
        }
    },

    methods: {
        deleteCoach(coach) {
            if (confirm('Sunteți sigur că doriți să ștergeți acest antrenor?')) {
                this.$inertia.delete(route('admin.dashboard.coaches.destroy', coach));
            }
        },

        updateNameFilter(value) {
            this.filters.name = value;
        },
    }
}

</script>