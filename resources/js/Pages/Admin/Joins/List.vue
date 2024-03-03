<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Înscrieri</h1>
                    <p class="mt-2 text-md text-gray-700">Lista cu înscrieri noi.</p>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-md font-semibold text-gray-900 sm:pl-3">Data
                                        Înscrieri
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">Nume
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                        Prenume
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                        Vârstă
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">Număr
                                        de telefon
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">Email
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                        Aprobat
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr v-for="join in  joins " :key="joins.id" class="even:bg-gray-50">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-md font-medium text-gray-900 sm:pl-3">
                                        {{ formatDate(join.created_at) }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{ join.first_name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{ join.last_name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{ join.age }} ani</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{ join.phone }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{ join.email }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{
                                        formatBoolean(join.approved) }}</td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-md font-medium sm:pr-3">
                                        <button @click="approveJoin(join)"
                                            class="text-indigo-600 hover:text-indigo-900">Aprobă</button>
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
import moment from 'moment';
import 'moment/locale/ro';
export default {
    name: 'Joins/List',

    components: { AdminLayout },

    props: {
        joins: Array,
    },

    methods: {
        formatDate(dateString) {
            // Crearea unui obiect de tip Date
            const date = new Date(dateString);

            // Opțiunile pentru formatarea datei
            const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };

            // Formatarea datei în limba română
            const formattedDate = date.toLocaleString('ro-RO', options);

            return formattedDate;
        },

        formatBoolean(boolean) {
            if (boolean) {
                return 'Da';
            } else {
                return 'Nu';
            }
        },

        approveJoin(join) {
            this.$inertia.post(route('admin.dashboard.joins.approve', join));
        },
    }
}

</script>

<script setup>
const people = [
    { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
    // More people...
]
</script>