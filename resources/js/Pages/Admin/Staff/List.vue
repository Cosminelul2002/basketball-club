<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8">

            <!-- Salaries Section Description -->
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Staff</h1>
                    <p class="mt-2 text-md text-gray-700">Listă staff-ului.</p>
                </div>

                <!-- Add Salary Button -->
                <div v-if="staff.length != 0" class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route('admin.dashboard.staff.create')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                        un nou membru</inertia-link>
                </div>
            </div>

            <!-- Filter section -->
            <div v-if="!staff" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Filter by amount -->
                <div>
                    <Filter :filter="amountFilter" :value="filters.amount" :onUpdateValue="updateAmountFilter" />
                </div>
                <!-- Filter by type -->
                <div>
                    <Filter :filter="typeFilter" :value="filters.type" :onUpdateValue="updateTypeFilter" />
                </div>
                <!-- Filter by start date -->
                <div>
                    <Filter :filter="startDateFilter" :value="filters.start_date"
                        :onUpdateValue="updateStartDateFilter" />
                </div>
                <!-- Filter by end date -->
                <div>
                    <Filter :filter="endDateFilter" :value="filters.end_date" :onUpdateValue="updateEndDateFilter" />
                </div>
            </div>

            <!-- Main Locations Section -->
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">

                            <!-- Locations table  -->
                            <template v-if="staff.length === 0">
                                <div class="flex flex-col items-center justify-center gap-2 p-6 text-center">
                                    <p class="text-md text-gray-500">
                                        Nu există membrii din staff.
                                    </p>
                                    <inertia-link :href="route('admin.dashboard.staff.create')"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md bg-indigo-600 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Adaugă membru
                                    </inertia-link>
                                </div>
                            </template>

                            <table v-else class="min-w-full divide-y divide-gray-300 text-center">
                                <thead class="bg-gray-50">
                                    <tr class="">
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            Nume</th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3  text-md font-semibold text-gray-900 sm:pl-6">
                                            Prenume</th>
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            Email</th>
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            Număr de telefon</th>
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            Data naștere</th>
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            Salariu</th>
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            Role</th>
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                        <!-- <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Delete</span>
                                        </th> -->
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="person in staff" :key="person.id">
                                        <td class="py-4 px-3 text-md text-gray-500">{{ person.first_name }}</td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-md font-medium text-gray-900 sm:pl-6">
                                            {{ person.last_name }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{ person.email
                                            }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{ person.phone }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{
                    person.date_of_birth }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{
                    person.salary ? person.salary.name : 'Fără salariu' }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{
                    person.role ? person.role.name : 'Fără rol' }}</td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-md font-medium sm:pr-6">
                                            <inertia-link :href="route('admin.dashboard.staff.show', person)"
                                                class="text-indigo-600 hover:text-indigo-900">Editează / <span
                                                    class="sr-only"></span></inertia-link><button
                                                @click="deleteStaff(person)"
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


export default {
    name: "Admin/Staff/List",

    components: {
        AdminLayout
    },

    props: {
        staff: Array
    }
}

</script>