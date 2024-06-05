<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8">

            <!-- Player Groups Section Description -->
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Grupe de vârstă</h1>
                    <p class="mt-2 text-md text-gray-700">Liste grupe și antrenori.</p>
                </div>

                <!-- Add Player Groups Button Default Values -->
                <div v-if="filteredPlayerGroups.length === 0" class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button @click=addDefaultGroups
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                        grupele inițiale</button>
                </div>

                <!-- Add Player Group Button -->
                <div v-if="filteredPlayerGroups.length != 0" class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route('admin.dashboard.groups.create')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                        grupă nouă</inertia-link>
                </div>
            </div>

            <!-- Filter section -->
            <div v-if="filteredPlayerGroups.length != 0" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Filter by name -->
                <div>
                    <Filter :filter="nameFilter" :value="filters.name" :onUpdateValue="updateNameFilter" />
                </div>
                <!-- Filter by coach -->
                <div>
                    <!-- <Filter :filter="coachFilter" :value="filters.coaches" :onUpdateValue="updateCoachFilter" /> -->
                </div>
            </div>

            <!-- Main Player Groups Section -->
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">

                            <!-- Player Groups table  -->
                            <template v-if="filteredPlayerGroups.length === 0">
                                <div class="flex flex-col items-center justify-center gap-2 p-6 text-center">
                                    <p class="text-md text-gray-500">
                                        Nu ai adăugat încă nicio grupă de vârstă. Fă clic pe butonul de mai jos pentru a
                                        adăuga prima ta grupă de vârstă și începe să structurezi echipa în funcție de
                                        categoriile de vârstă!
                                    </p>
                                    <inertia-link :href="route('admin.dashboard.groups.create')"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md bg-indigo-600 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Adaugă grupă de vârstă
                                    </inertia-link>
                                </div>
                            </template>

                            <table v-else class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-md font-semibold text-gray-900 sm:pl-6">
                                            Grupe</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                            Jucători</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                            Taxă</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                            Antrenor</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Delete</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="playerGroup in filteredPlayerGroups" :key="playerGroup.id">
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-md font-medium text-gray-900 sm:pl-6">
                                            {{ playerGroup.name }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{ playerGroup.players.length }}
                                        </td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{ playerGroup.tax }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">
                                            <ul>
                                                <li v-for="coach in playerGroup.coaches" :key="coach.id">
                                                    {{ coach.first_name }} {{ coach.last_name }}
                                                </li>
                                            </ul>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-md font-medium sm:pr-6">
                                            <inertia-link :href="route('admin.dashboard.groups.show', playerGroup)"
                                                class="text-indigo-600 hover:text-indigo-900">Editează<span
                                                    class="sr-only"></span></inertia-link>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-md font-medium sm:pr-6">
                                            <button @click="deleteGroup(playerGroup)"
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

<script setup>
const people = [
    { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
]
</script>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Filter from '../../../Components/Filter.vue';

export default {
    name: 'Admin/PlayerGroups/List',

    components: { AdminLayout, Filter },

    computed: {
        filteredPlayerGroups() {
            const { name, coach } = this.filters;
            return this.groups.filter(group => {
                return (
                    group.name.toLowerCase().includes(name.toLowerCase()) &&
                    (!coach || group.coaches.some(c => c.id === parseInt(coach)))
                );
            });
        },

        nameFilter() {
            return {
                label: 'Filtru după nume',
                type: 'text',
                id: 'filter-name',
            };
        },

        // coachFilter() {
        //     return {
        //         id: 'filter-coach',
        //         label: 'Filtru după antrenor',
        //         type: 'select',
        //         placeholder: 'Selectează un antrenor',
        //         options: this.coaches.map(coach => ({
        //             value: coach.id,
        //             label: `${coach.first_name} ${coach.last_name}`,
        //         })),
        //     };
        // },
    },

    props: {
        groups: Array,
        coaches: Array,
    },

    data() {
        return {
            filters: {
                name: '',
                coach: '',
            },
        };
    },

    methods: {
        deleteGroup(group) {

            this.$inertia.delete(route('admin.dashboard.groups.destroy', group.id));
        },

        updateNameFilter(value) {
            this.filters.name = value;
        },

        updateCoachFilter(value) {
            this.filters.coach = value;
        },

        addDefaultGroups() {
            this.$inertia.post(route('admin.dashboard.groups.create-default-groups'));
        },

    }
}


</script>